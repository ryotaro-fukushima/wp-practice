<?php
// CSSを読み込む
function enqueue_custom_styles() {
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');



// メニューをサポートする
function mytheme_setup() {
    register_nav_menus(array(
        'primary' => 'メインメニュー',
    ));
}
add_action('after_setup_theme', 'mytheme_setup');

// add_action('phpmailer_init', function($phpmailer) {
//     $phpmailer->isSMTP();
//     $phpmailer->Host = '127.0.0.1'; // Mailpitのホスト
//     $phpmailer->Port = 1025;        // Mailpitのポート
//     $phpmailer->SMTPAuth = false;  // 認証不要
// });

add_action('template_redirect', function() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // データの処理（例: メール送信）
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);
        
        // wp_mailによるメール送信処理（例）
        $to = 'ryotaro.fukushima@prum.jp'; // 送信先メールアドレス
        $subject = "お問い合わせフォーム: $name 様";
        $headers = ['From: WordPress <no-reply@xs614444.xsrv.jp>'];
        $body = "お名前: $name\nメールアドレス: $email\n\n$message";
        
        if (wp_mail($to, $subject, $body, $headers)) {
            // リダイレクトを追加
            wp_safe_redirect(home_url('/contact/?success=1')); // リダイレクト先を指定
            exit;
        } else {
            echo '<p>メール送信に失敗しました。</p>';
            global $phpmailer;
            echo '<pre>';
            print_r($phpmailer);
            echo '</pre>';
        }
    }
});

