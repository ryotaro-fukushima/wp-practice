<?php
/* Template Name: 完了画面 */
session_start();
get_header();

// `POST` 以外のリクエストは `contact.php` にリダイレクト
if ($_SERVER["REQUEST_METHOD"] !== "POST" && !isset($_POST['send'])) {
    wp_redirect(home_url('/contact'));
    exit;
}

// 送信処理
$to = get_option('admin_email');
$subject = "お問い合わせフォームからのメッセージ";
$headers = "From: {$_POST['email']}\r\nReply-To: {$_POST['email']}\r\n";
$body = "お名前: {$_POST['name']}\nメール: {$_POST['email']}\n\n{$_POST['message']}";

wp_mail($to, $subject, $body, $headers);

// **セッションデータを削除**
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['message']);
session_destroy();
?>

<!-- GA4 計測スクリプト -->
<script>
window.onload = function() {
    gtag('event', 'form_complete', {
        'event_category': 'contact',
        'event_label': 'finish_page'
    });
};
</script>

<main>
    <section>
        <h2>送信完了</h2>
        <p>お問い合わせありがとうございました。<br>担当者よりご連絡させていただきます。</p>
        <a href="<?php echo home_url('/'); ?>">トップページへ戻る</a>
    </section>
</main>

<?php get_footer(); ?>
