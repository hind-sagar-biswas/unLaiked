<?php
session_start();

// META DATA
$VERSION = "v1.1";
$AUTHOR = "Hind Sagar Biswas";
$YEAR = "2022";

// DEBUG mode
$DEBUG = True;
$DEEP_DEBUG = False;
$DEBUG_MODE = 2; // 1 = cmd PHP server ; 2 = XAMPP server

// BASE info
if($DEBUG_MODE == 1) $BASE_URI = 'http://localhost:8000/';
if($DEBUG_MODE == 2) $BASE_URI = 'http://localhost:8888/unLaiked/';

$BASE_DIR = __DIR__ . '/';
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
$REQ_URI = $_SERVER['REQUEST_URI'];
$METHOD = $_SERVER['REQUEST_METHOD'];

// BACKUP PAGE TITLE
$PAGE_TITLE = 'unLaiked v1.0';

// PHP files directories
$CLASS = $BASE_DIR . 'php/classes/';
$INC = $BASE_URI . 'php/includes/';

// TEMPLATES
$FORM = $BASE_DIR . 'templates/forms/';
$HTML = $BASE_DIR . 'templates/includes/';

// STATIC files directories
$CSS = $BASE_URI . 'assets/css/';
$JS = $BASE_URI . 'assets/js/';
$IMG = $BASE_URI . 'assets/images/';

// DATABASE Connection detailes based on $DEBUG mode
$DB = ($DEBUG) ? ['host' => 'localhost', 'user' => 'root', 'pass' => '', 'name' => 'logger'] : ['host' => 'localhost', 'user' => 'root', 'pass' => '', 'name' => 'logger'];

// SITE URL MAPPING
$URLS = [
    "root" => ''
];

// ROUTING FUNCTION
function redirect_to(string $target, string $query = ''): void
{ 
    if(!empty($query)) $query = '?' . $query;
    if(!$GLOBALS['DEEP_DEBUG']) header("Location: " . $GLOBALS['BASE_URI'] . $GLOBALS['URLS'][$target] . $query);
    echo "<br>$query<br>";
    die('died');
}

// For direct access redirects:
if ($_SERVER['SCRIPT_NAME'] == '/config.php') redirect_to('/');

// INCLUDE required files
require $CLASS . 'contr.class.php';
require $CLASS . 'dbh.class.php';
require $CLASS . 'users.class.php';
require $CLASS . 'post.class.php';
require $CLASS . 'unlaik.class.php';

// INITIATE classes
$unlaik = new Unlaik($DEBUG);

// SCRIPTS & STYLESHEETS
$STYLESHEETS = [
    "style"
];
$SCRIPTS = [];
