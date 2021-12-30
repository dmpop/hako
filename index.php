<?php
error_reporting(E_ERROR);
// javascript:var%20title=window.getSelection();location.href='http://127.0.0.1:8000/index.php?url='+encodeURIComponent(location.href)+'&title='+'&password=password'
$theme = "light";
$title = "Hako";
$footer = "I really 🧡 <a href='https://www.paypal.com/paypalme/dmpop'>coffee</a>";
$password = "password";
if (!file_exists('archive')) {
    mkdir('archive', 0777, true);
}
if (!empty($_GET['title']) and $_GET['password'] == $password) {
    $filename = preg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $_GET['title']);
    $filename = preg_replace("([\.]{2,})", '', $filename);
    $filename = str_replace(" ", "_", $filename);
    shell_exec('./monolith ' . $_GET['url'] . ' --isolate --output archive/' . $filename . '.html');
    $f = fopen("archive/" . $filename . ".txt", "a");
    fwrite($f, $_GET['title'] . "\n");
    fwrite($f, $_GET['url'] . "\n");
    fclose($f);
}
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
        <?php
        $fileList = glob('archive/*.html');
        foreach ($fileList as $filename) {
            $array = explode("\n", file_get_contents('archive/' . basename($filename, ".html") . '.txt', true));
            $title = $array[0];
            $url = $array[1];
            if (!empty($url)) {
                echo "<p><a href='$filename'>" . $title . "</a> <strong><a style='margin-left: 0.5em; margin-right: 0.5em;' href='$url'><img src='external-link.svg' /></a></strong><a href='read.php?url=$url'><img src='file-text.svg' /></a></strong></p>";
            } else {
                echo "<p><a href='$filename'>" . basename(str_replace("_", " ", $filename), ".html") . "</a></p>";
            }
        }
        ?>
        <hr>
        <div class="text-center">
            <button style="margin-bottom: 1em;" onclick="location.href='add.php'">Add</button>
        </div>
    </div>
    <div class="text-center">
        <?php echo $footer; ?>
    </div>
</body>

</html>