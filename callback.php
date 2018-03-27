<?php
require_once('./config.php');

if (!session_id()) {
    session_start();
}

$code = $_GET['code'];
echo '$code= ' . $code . '<br /><br />';

$state = $_GET['state'];
echo '$state= ' . $state . '<br /><br />';

$session_state = $_SESSION['_line_state'];
unset($_SESSION['_line_state']);
if ($session_state !== $state) {
    echo 'アクセスエラー';
    exit;
}

//**************
// 各種値の設定
//**************
$base_url = "https://api.line.me/oauth2/v2.1/token";
$client_id = CLIENT_ID;
$client_secret = CLIENT_SECRET;
$redirect_uri = REDIRECT_URI;

$url = "https://api.line.me/oauth2/v2.1/token";

//----------------------------------------
// POSTパラメータの作成
//----------------------------------------
$query = "";
$query .= "grant_type=" . urlencode("authorization_code") . "&";
$query .= "code=" . urlencode($code) . "&";
$query .= "redirect_uri=" . urlencode($redirect_uri) . "&";
$query .= "client_id=" . urlencode($client_id) . "&";
$query .= "client_secret=" . urlencode($client_secret) . "&";

//--------------------
// HTTPヘッダーの設定
//--------------------
$header = array(
    "Content-Type: application/x-www-form-urlencoded",
    "Content-Length: " . strlen($query),
);

//--------------------------------
// コンテキスト（各種情報）の設定
//--------------------------------
$context = array(
    "http" => array(
        "method"        => "POST",
        "header"        => implode("\r\n", $header),
        "content"       => $query,
        "ignore_errors" => true,
    ),
);

//---------------------
// id token を取得する
//---------------------
$res_json = file_get_contents($url, false, stream_context_create($context));

//----------------------------------
// 取得するデータを展開して表示する
//----------------------------------

// 取得したjsonデータをオブジェクト化
$res = json_decode($res_json);
echo '$res= ';
print_r($res); // LINEから取得したデータの表示
echo '<br /><br />';

// エラーを取得
if (isset($res->error)) {
    echo 'ログインエラーが発生しました。<br />';
    echo "error: " . $res->error . '<br />';
    echo $res->error_description;
    exit;
}

//id_token(JWT)を分解
$val = explode(".", $res->id_token);
echo '$val= ';
print_r($val);
echo '<br /><br />';

//2番目がデータ部分(PAYLOAD)なのでbase64でデコード
$data_json = base64_decode($val[1]);
echo '$data_json= ';
print_r($data_json);
echo '<br /><br />';

//bsae64でデコードしたjsonをオブジェクト化
$data = json_decode($data_json);
echo '$data= ';
print_r($data);
echo '<br /><br />';

//取得したデータを表示
print("[sub]:[" . $data->sub . "][対象ユーザーの識別子]<br />\n");
