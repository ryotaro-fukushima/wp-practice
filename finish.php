<?php
/* Template Name: 完了画面 */
session_start();
get_header();

// デバッグ用出力
echo "<h3>デバッグ情報</h3>";
echo "<pre>";
echo "REQUEST_METHOD: " . $_SERVER["REQUEST_METHOD"] . "\n";
echo "Current URL: " . $_SERVER["REQUEST_URI"] . "\n";
print_r($_POST);
echo "</pre>";

// 一時的にリダイレクトを無効化（デバッグのため）
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "<p style='color:red;'>エラー: POSTリクエストではありません。</p>";
    exit; // リダイレクトせずに終了
}

// 送信処理（メール送信）
$to = get_option('admin_email'); // WordPress管理者メール
$subject = "お問い合わせフォームからのメッセージ";
$headers = "From: {$_POST['email']}\r\nReply-To: {$_POST['email']}\r\n";
$body = "お名前: {$_POST['name']}\nメール: {$_POST['email']}\n\n{$_POST['message']}";

wp_mail($to, $subject, $body, $headers);

// セッションデータの削除
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
