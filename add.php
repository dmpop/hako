<?php
error_reporting(E_ERROR);
include('config.php');
?>

<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $theme; ?>">
<!-- Author: Dmitri Popov, dmpop@cameracode.coffee
         License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/lit.css" />
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <div class="c">
        <div style="text-align: center;">
            <div style="margin-top: 1em; margin-bottom: 1em;">
                <img style="display: inline; height: 3em; vertical-align: middle; margin-right: 0.5em;" src="favicon.svg" alt="logo" />
                <h1><?php echo $title; ?></h1>
            </div>
        </div>
        <div class="card w-100">
            <form action="index.php" method="GET">
                <label for="url">URL:</label>
                <input class="card w-100" type='text' name='url' value="<?php echo htmlspecialchars($_GET['url'], ENT_QUOTES, 'UTF-8'); ?>">
                <label for="title">Title:</label>
                <input class="card w-100" type='text' name='title' value="<?php echo htmlspecialchars($_GET['title'], ENT_QUOTES, 'UTF-8'); ?>">
                <label for="password">Password:</label>
                <input class="card w-100" type='password' name='password' value=''>
                <div style="text-align: center;">
                    <button class="btn primary" type="submit" name="add">Add</button>
                    <a class="btn" style="margin-top: 1.5em; margin-bottom: 1.5em;" href="index.php">Back</a>
                </div>
            </form>
        </div>
        <div class="card w-100">
            <div style="text-align: center;">
                <?php echo $footer; ?>
            </div>
</body>

</html>
