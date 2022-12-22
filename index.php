<?php
require './config.php';

// HEADER
require $HTML . 'header.php';

// BODY
if (isset($_GET['m'])) echo '<i>' . $_GET['m'] . '</i><br/>'; // echo out message


require $FORM . 'addUser.php';
require $FORM . 'post.php';

require $HTML . 'feed.php';

// FOOTER
require $HTML . 'footer.php';
