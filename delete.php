<?php
//error_reporting(E_ERROR);
include('config.php');
$file = $_GET['file'];
?>

<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $theme; ?>">
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
            <h1 style="display: inline; vertical-align: middle; letter-spacing: 3px; color: #e28aa7ff"><?php echo $title; ?></h1>
            <hr style="margin-bottom: 2em;">
            <form action=" " method="POST">
                <label for="password">Password:</label>
                <input type='password' name='password' value=''>
                <button type="submit" name="delete">Delete</button>
            </form>
        </div>
        <?php
        if (isset($_POST['delete']) && ($_POST['password'] == $password)) {
            unlink('archive/' . $file);
            unlink('archive/' . basename($file, ".html") . '.txt');
            header('Location: index.php');
        }
        ?>
        <div class="text-center" style="margin-bottom: .5em;">
            <?php echo $footer; ?>
        </div>
    </div>
    <div class="text-center">
    </div>
</body>

</html>