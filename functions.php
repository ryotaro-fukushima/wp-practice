<?php
ob_start();

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
        // 送信データのバリデーション
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);

        // **確認画面に遷移する処理**
        if (isset($_POST['confirm'])) {
            // `confirm.php` に遷移
            include(get_template_directory() . '/confirm.php');
            exit;
        }

        // **メール送信処理 (完了画面へ)**
        if (isset($_POST['send'])) {
            $to = 'ryotaro.fukushima@prum.jp';
            $subject = "お問い合わせフォーム: $name 様";
            $headers = ['From: WordPress <no-reply@xs614444.xsrv.jp>'];
            $body = "お名前: $name\nメールアドレス: $email\n\n$message";

            if (wp_mail($to, $subject, $body, $headers)) {
                // 🔥 `wp_safe_redirect()` を削除して、直接 `finish.php` に移動
                include(get_template_directory() . '/finish.php');
                exit;
            } else {
                echo '<p>メール送信に失敗しました。</p>';
                global $phpmailer;
                echo '<pre>';
                print_r($phpmailer);
                echo '</pre>';
            }
        }
    }
});


add_action('init', function() {
    add_rewrite_rule('^finish/?$', 'index.php?finish=1', 'top');
});

add_filter('query_vars', function($query_vars) {
    $query_vars[] = 'finish';
    return $query_vars;
});

add_action('template_include', function($template) {
    if (get_query_var('finish') == 1) {
        return get_template_directory() . '/finish.php';
    }
    return $template;
});

function disable_script_errors() {
    echo '<script>
        document.querySelector("form").addEventListener("submit", function(event) {
            console.log("フォーム送信:", event);
        });
    </script>';
}
add_action("wp_footer", "disable_script_errors");
