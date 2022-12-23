<?php
require __DIR__ . '/../../config.php';
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) redirect_to('root');



if ($DEBUG) var_dump($_GET);

if (isset($_GET['l']) || isset($_GET['p'])) {
    if($_GET['l'] == 1) $reaction = 'like';
    else if($_GET['l'] == 0) $reaction = 'dislike';
    else redirect_to('root', 'm=Invalid%20reaction');

    $postId = $_GET['p'];

    if ($unlaik->alter_react($postId, $_SESSION['user_id'], $reaction)) redirect_to('root', 'm=Successful');
    redirect_to('root', 'm=Failed');
} else redirect_to('root');
