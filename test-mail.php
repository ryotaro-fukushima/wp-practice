<?php
// WordPressのロード
require_once '/Users/fukushimaryotaro/Local Sites/wp-practice/app/public/wp-load.php';

$to = 'test@example.com';
$subject = 'PHPメールテスト';
$message = 'これはMailpitを使用したテストメールです。';
$headers = [
    'From: WordPress <mailhog@flywheel.local>'
];

if (wp_mail($to, $subject, $message, $headers)) {
    echo 'メール送信成功！';
} else {
    echo 'メール送信失敗...';
    global $phpmailer;
    if (isset($phpmailer)) {
        echo '<pre>';
        print_r($phpmailer);
        echo '</pre>';
    }
}
