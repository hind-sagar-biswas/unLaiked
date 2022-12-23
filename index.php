<?php
require './config.php';

$STYLESHEETS = [
    "style"
];

// HEADER
require $HTML . 'header.php';

// BODY ?>

<main>
    <div id="feed">
        <?php require $HTML . 'feed.php'; ?>
    </div>
    <div id="sidebar">
        <?php require $FORM . 'login.php'; ?>
        <?php require $FORM . 'addUser.php'; ?>
        <?php require $FORM . 'post.php'; ?>
        <?php if (isset($_GET['m'])) echo '<div id="message-box"><i>' . $_GET['m'] . '</i></div>';  ?>
    </div>
</main>


<?php 
// FOOTER
require $HTML . 'footer.php';
