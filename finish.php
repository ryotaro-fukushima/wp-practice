<?php
/* Template Name: 完了画面 */
session_start();
get_header();

// デバッグ用出力
echo "<h3>デバッグ情報</h3>";
echo "<pre>";
echo "REQUEST_METHOD: " . $_SERVER["REQUEST_METHOD"] . "\n";
print_r($_POST);
echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    wp_redirect(home_url('/contact'));
    exit;
}

// セッションデータの取得
$name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
$email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
$message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

// POSTデータが取得できているか確認
if (empty($name) || empty($email) || empty($message)) {
    echo "<p>エラー: 必須データが不足しています。リダイレクトせずに表示します。</p>";
    exit;
}

// 送信処理（メール送信）
$to = get_option('admin_email'); // WordPress管理者メール
$subject = "お問い合わせフォームからのメッセージ";
$headers = "From: $email\r\nReply-To: $email\r\n";
$body = "お名前: $name\nメール: $email\n\n$message";

wp_mail($to, $subject, $body, $headers);

// **セッションデータを削除**
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['message']);
session_destroy(); // セッションを完全に破棄
?>

<main>
    <section>
        <h2>送信完了</h2>
        <p>お問い合わせありがとうございました。<br>担当者よりご連絡させていただきます。</p>
        <a href="<?php echo home_url('/'); ?>">トップページへ戻る</a>
    </section>
</main>

<?php get_footer(); ?>
