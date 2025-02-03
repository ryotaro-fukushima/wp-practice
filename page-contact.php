<?php
/* Template Name: お問い合わせ */
get_header();
?>

<main>
    <section>
        <h2><?php the_title(); ?></h2>
        <form action="<?php echo esc_url(home_url('/contact/')); ?>" method="post">
            <p>
                <label for="name">お名前 (必須)</label><br>
                <input type="text" id="name" name="name" placeholder="名前" required>
            </p>
            <p>
                <label for="email">メールアドレス (必須)</label><br>
                <input type="email" id="email" name="email" placeholder="メールアドレス" required>
            </p>
            <p>
                <label for="message">お問い合わせ内容</label><br>
                <textarea id="message" name="message" placeholder="お問い合わせ内容" required></textarea>
            </p>
            <button type="submit">送信</button>
        </form>
    </section>
</main>

<?php get_footer(); ?>
