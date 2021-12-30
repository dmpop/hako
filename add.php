<?php
error_reporting(E_ERROR);
$theme = "light";
$title = "Hako";
$footer = "I really 🧡 <a href='https://www.paypal.com/paypalme/dmpop'>coffee</a>";
$password = "secret";
?>

<html lang="en">
<!-- Author: Dmitri Popov, dmpop@linux.com
         License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/classless.css" />
    <link rel="stylesheet" href="css/themes.css" />
</head>

<body>
    <div class="card">
        <div class="text-center" style="margin-top: 1em; margin-bottom: 1em;">
            <img style="display: inline; height: 2.5em; vertical-align: middle;" src="favicon.svg" alt="logo" />
            <h1 style="display: inline; margin-top: 0em; vertical-align: middle; letter-spacing: 3px;"><?php echo $title; ?></h1>
        </div>
        <hr style="margin-bottom: 2em;">
        <form action="index.php" method="GET">
            <label for="url">URL:</label>
            <input type='text' name='url' value="<?php echo $_GET['url']; ?>">
            <label for="title">Title:</label>
            <input type='text' name='title' value="<?php echo $_GET['title']; ?>">
            <label for="password">Password:</label>
            <input type='password' name='password' value=''>
            <div class="text-center">
                <button type="submit" name="add">Add</button>
                <button style="margin-top: 1.5em; margin-bottom: 1.5em;" onclick='window.location.href = "index.php"'>Back</button>
            </div>
        </form>
    </div>
    <div class="text-center">
        <?php echo $footer; ?>
    </div>
</body>

</html>