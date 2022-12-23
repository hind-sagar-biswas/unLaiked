<h3>POST SOMETHING: </h3>
<form action="<?= $INC . 'post.inc.php' ?>" method="post">
    <p>Posting as: <?= (isset($_SESSION['user_id'])) ? $_SESSION['username'] : 'none'; ?></p>
    <textarea name="post-content" id="post-content" cols="30" rows="10" required></textarea>
    <button type="submit" name="create-post" id="create-post" value="create-post">POST</button>
</form>