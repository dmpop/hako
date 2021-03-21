<?php
error_reporting(E_ERROR);
?>

<html lang="en">
<!-- Author: Dmitri Popov, dmpop@linux.com
         License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
    <meta charset="utf-8">
    <title><?php echo $title ?></title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="classless.css" />
</head>

<body>
    <div class="text-center">
        <img style="display: inline; height: 3em;" src="favicon.png" alt="logo" />
        <h1 style="margin-left: 0.2em; margin-top: 0em; letter-spacing: 3px; color: rgb(125, 202, 210);">HAKO</h1>
        <hr style="margin-bottom: 2em;">
    </div>
    <form action="index.php" method="GET">
        <label for="url">URL:</label>
        <input type='text' name='url' value="<?php echo $_GET['url']; ?>">
        <label for="title">Title:</label>
        <input type='text' name='title' value="<?php echo $_GET['title']; ?>">
        <label for="password">Secret key:</label>
        <input type='password' name='key' value=''>
        <button type="submit" name="add">Add</button>
        <button style="margin-top: 1.5em; margin-bottom: 1.5em;" onclick='window.location.href = "index.php"'>Back</button>
    </form>
    </div>
    </div>
</body>

</html>