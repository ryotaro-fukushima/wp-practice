<?php
/* Template Name: 完了画面 */
get_header();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    wp_redirect(home_url('/contact'));
    exit;
}

$name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
$email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
$message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

// 送信処理（メール送信）
$to = get_option('admin_email'); // WordPress管理者メール
$subject = "お問い合わせフォームからのメッセージ";
$headers = "From: $email\r\nReply-To: $email\r\n";
$body = "お名前: $name\nメール: $email\n\n$message";

wp_mail($to, $subject, $body, $headers);
?>

<main>
    <section>
        <h2>送信完了</h2>
        <p>お問い合わせありがとうございました。<br>担当者よりご連絡させていただきます。</p>
        <a href="<?php echo home_url('/'); ?>">トップページへ戻る</a>
    </section>
</main>

<?php get_footer(); ?>
