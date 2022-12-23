<h3>ADD A USER: </h3>
<form action="<?= $INC . 'user.inc.php' ?>" method="post">
    <input type="text" name="username" id="username" required>
    <input type="email" name="email" id="email" required>
    <input type="hidden" name="password" id="password" value="none">
    <button type="submit" name="add-user" id="add-user" value="add-user">ADD</button>
</form>