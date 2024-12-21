<?php
/* Template Name: お問い合わ */
get_header(); ?>

<main>
    <form action="http://wp-practice.local/contact/" method="post">
        <input type="text" id="name" name="name" placeholder="名前" required>
        <input type="email" id="email" name="email" placeholder="メールアドレス" required>
        <textarea id="message" name="message" placeholder="お問い合わせ内容" required></textarea>
        <button type="submit">送信</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        echo '<p>フォーム送信成功</p>';
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
    }
    ?>
</main>

<?php get_footer(); ?>
