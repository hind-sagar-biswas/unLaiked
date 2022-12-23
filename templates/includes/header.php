<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $PAGE_TITLE ?></title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <?php foreach ($STYLESHEETS as $sheet) : ?>
        <link rel="stylesheet" href="<?= $CSS . $sheet ?>.css">
    <?php endforeach; ?>
</head>

<body>