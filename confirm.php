<?php
/* Template Name: 確認画面 */
session_start();
get_header();

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST['confirm'])) {
    wp_redirect(home_url('/contact?error=1'));
    exit;
}

// 受け取ったデータをサニタイズし、セッションに保存
$_SESSION['name'] = sanitize_text_field($_POST['name']);
$_SESSION['email'] = sanitize_email($_POST['email']);
$_SESSION['message'] = sanitize_textarea_field($_POST['message']);

// セッションデータを変数に格納
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$message = $_SESSION['message'];

// 入力値のバリデーション
if (empty($name) || empty($email) || empty($message)) {
    wp_redirect(home_url('/contact?error=1'));
    exit;
}
?>

<main>
    <section>
        <h2>確認画面</h2>
        <form action="<?php echo esc_url(home_url('/finish')); ?>" method="post">
            <p><strong>お名前:</strong> <?php echo esc_html($name); ?></p>
            <p><strong>メールアドレス:</strong> <?php echo esc_html($email); ?></p>
            <p><strong>お問い合わせ内容:</strong></p>
            <p><?php echo nl2br(esc_html($message)); ?></p>

            <input type="hidden" name="send" value="1">
            <input type="hidden" name="name" value="<?php echo esc_attr($name); ?>">
            <input type="hidden" name="email" value="<?php echo esc_attr($email); ?>">
            <input type="hidden" name="message" value="<?php echo esc_textarea($message); ?>">
            <button type="submit">送信する</button>
        </form>

        <form action="<?php echo esc_url(home_url('/contact')); ?>" method="post">
            <input type="hidden" name="name" value="<?php echo esc_attr($name); ?>">
            <input type="hidden" name="email" value="<?php echo esc_attr($email); ?>">
            <input type="hidden" name="message" value="<?php echo esc_textarea($message); ?>">
            <button type="submit">戻る</button>
        </form>
    </section>
</main>

<?php get_footer(); ?>
