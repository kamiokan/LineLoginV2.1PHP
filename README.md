# PHPでウェブアプリにLINEログインを組み込む準備

OpenID ConnectプロトコルをサポートしたLINEログインv2.1で、アクセストークンを取得して対象ユーザーIDを取得するまでをPHPで書いてみました。

## 使い方

1.LINEディベロッパーズでチャンネルを作成し、チャネルID、チャネルシークレットを取得してください。

2.LINEディベロッパーズの [アプリ設定] - [リダイレクト設定] でCallback URLを指定します。

3.config.php の YOUR_CLIENT_ID, YOUR_CLIENT_SECRET, YOUR_REDIRECT_URI を置き換えてください。

4.index.php, config.php, callback.php を https:// でアクセスできる所にアップロードしてください。

5.https://example.com/index.php にアクセスし、LINEアカウントでログインし、許可するとユーザーIDが取得できます。

## 参考情報

LINE developers公式URL

https://developers.line.me/ja/docs/line-login/web/integrate-line-login/


参考URL:できる限り簡単にPHPで「Google OpenID Connect」を使ってみる

https://pg.kdtk.net/421


上記参考URL、超絶わかりやすく、実装の流れを~~ほぼパクリ~~参考にさせていただきました。

ありがとうございます。


### Author

nobuhiro kamioka

