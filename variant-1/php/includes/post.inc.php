<?php
require __DIR__ . '/../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if($DEBUG) var_dump($_POST);

    

}
else redirect_to('root');
