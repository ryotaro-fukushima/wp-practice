<?php
/* Template Name: お問い合わせ */
get_header();
?>

<main>
    <section>
        <h2><?php the_title(); ?></h2>
        <form action="<?php echo esc_url(home_url('/confirm/')); ?>" method="post">
            <p>
                <label for="name">お名前 (必須)</label><br>
                <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? esc_attr($_POST['name']) : ''; ?>" required>
            </p>
            <p>
                <label for="email">メールアドレス (必須)</label><br>
                <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>" required>
            </p>
            <p>
                <label for="message">お問い合わせ内容</label><br>
                <textarea id="message" name="message" required><?php echo isset($_POST['message']) ? esc_textarea($_POST['message']) : ''; ?></textarea>
            </p>
            <button type="submit">確認画面へ</button>
        </form>
    </section>
</main>

<?php get_footer(); ?>
