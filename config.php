<?php
// 直接アクセスを拒否する
if (array_shift(get_included_files()) !== __FILE__) {
    define("CLIENT_ID", YOUR_CLIENT_ID);
    define("CLIENT_SECRET", YOUR_CLIENT_SECRET);
    define("REDIRECT_URI", YOUR_REDIRECT_URI);
} else {
    echo 'Access Denied';
}
