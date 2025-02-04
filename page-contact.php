<?php
/* Template Name: お問い合わせ */
session_start(); // セッションを開始
get_header();
?>

<main>
    <section>
        <h2><?php the_title(); ?></h2>

        <?php if (isset($_GET['error'])): ?>
            <p style="color: red;">入力内容に誤りがあります。もう一度ご確認ください。</p>
        <?php endif; ?>

        <form action="<?php echo esc_url(home_url('/confirm')); ?>" method="post">
            <p>
                <label for="name">お名前 (必須)</label><br>
                <input type="text" id="name" name="name"
                    value="<?php echo isset($_SESSION['name']) ? esc_attr($_SESSION['name']) : ''; ?>"
                    required>
            </p>
            <p>
                <label for="email">メールアドレス (必須)</label><br>
                <input type="email" id="email" name="email"
                    value="<?php echo isset($_SESSION['email']) ? esc_attr($_SESSION['email']) : ''; ?>"
                    required>
            </p>
            <p>
                <label for="message">お問い合わせ内容</label><br>
                <textarea id="message" name="message" required><?php echo isset($_SESSION['message']) ? esc_textarea($_SESSION['message']) : ''; ?></textarea>
            </p>
            <input type="hidden" name="confirm" value="1">
            <button type="submit">確認画面へ</button>
        </form>
    </section>
</main>

<?php get_footer(); ?>
