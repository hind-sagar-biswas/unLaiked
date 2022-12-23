<h3>LOGIN AS: </h3>

<form action="<?= $INC . 'user.inc.php' ?>" method="post">
    <input type="number" name="user-id" id="user-id" placeholder="user id" required>
    <input type="text" name="username" id="username" placeholder="username" required>
    <button type="submit" name="login" id="login" value="login">LOGIN</button>
</form>