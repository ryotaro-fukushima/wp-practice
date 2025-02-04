<?php
/* Template Name: 確認画面 */
get_header();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    wp_redirect(home_url('/contact/'));
    exit;
}

$name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
$email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
$message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

if (empty($name) || empty($email) || empty($message)) {
    wp_redirect(home_url('/contact/'));
    exit;
}
?>

<main>
    <section>
        <h2>確認画面</h2>
        <form action="<?php echo esc_url(home_url('/finish/')); ?>" method="post">
            <p><strong>お名前:</strong> <?php echo esc_html($name); ?></p>
            <p><strong>メールアドレス:</strong> <?php echo esc_html($email); ?></p>
            <p><strong>お問い合わせ内容:</strong></p>
            <p><?php echo nl2br(esc_html($message)); ?></p>

            <input type="hidden" name="name" value="<?php echo esc_attr($name); ?>">
            <input type="hidden" name="email" value="<?php echo esc_attr($email); ?>">
            <input type="hidden" name="message" value="<?php echo esc_textarea($message); ?>">

            <button type="submit">送信する</button>
        </form>
        <form action="<?php echo esc_url(home_url('/contact/')); ?>" method="post">
            <input type="hidden" name="name" value="<?php echo esc_attr($name); ?>">
            <input type="hidden" name="email" value="<?php echo esc_attr($email); ?>">
            <input type="hidden" name="message" value="<?php echo esc_textarea($message); ?>">
            <button type="submit">戻る</button>
        </form>
    </section>
</main>

<?php get_footer(); ?>
