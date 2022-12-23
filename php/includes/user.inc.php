<?php
require __DIR__ . '/../../config.php';

if(isset($_POST['login'])) {
    if ($DEBUG) var_dump($_POST);
    
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['user_id'] = $_POST['user-id'];
    redirect_to("root");
}

if(isset($_POST['add-user'])) {
    if ($DEBUG) var_dump($_POST);

    $user = $unlaik->add_new_user($_POST['username'], $_POST['email'], $_POST['password']);
    if($user !== False) redirect_to("root", "uid=" . $user['id']);
}
