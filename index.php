<?php
require_once('./config.php');

if (!session_id()) {
    session_start();
}

$base_url = "https://access.line.me/oauth2/v2.1/authorize";
$client_id = CLIENT_ID;
$redirect_uri = REDIRECT_URI;

$_SESSION['_line_state'] = sha1(time());

$query = "";
$query .= "response_type=" . urlencode("code") . "&";
$query .= "client_id=" . urlencode($client_id) . "&";
$query .= "redirect_uri=" . urlencode($redirect_uri) . "&";
$query .= "state=" . urlencode($_SESSION['_line_state']) . "&";
$query .= "scope=" . urlencode("openid") . "&";

$url = $base_url . '?' . $query;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=10.0, user-scalable=yes">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container" style="margin: 10px 0;">
    <div class="panel panel-default">
        <div class="panel-heading">
            LINEログインv2.1テスト
        </div>
        <div class="panel-body">
            <p>ログインしてください。</p>
            <a href="<?php echo $url; ?>">
                <img src="img/btn_login_base.png">
            </a>
        </div>
    </div>
</div>
</body>
</html>
