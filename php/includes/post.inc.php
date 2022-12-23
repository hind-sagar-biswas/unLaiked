<?php
require __DIR__ . '/../../config.php';
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) redirect_to('root');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if($DEBUG) var_dump($_POST);

    if (isset($_POST['create-post'])) {
        if ($unlaik->add_new_post($_SESSION['user_id'], $_POST['post-content'])) redirect_to('root', 'm=Successful');
         redirect_to('root', 'm=Failed');
    }
}
else redirect_to('root');
