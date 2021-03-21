<?php
// javascript:var%20title=window.getSelection();location.href='http://127.0.0.1:8000/index.php?url='+encodeURIComponent(location.href)+'&title='+'&key=secret'
$KEY = "secret";
error_reporting(E_ERROR);
if (!file_exists('archive')) {
    mkdir('archive', 0777, true);
}
if (!empty($_GET['title']) and $_GET['key'] == $KEY) {
    $filename = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $_GET['title']);
    $filename = mb_ereg_replace("([\.]{2,})", '', $filename);
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
    <meta charset="utf-8">
    <title>箱</title>
    <meta charset="utf-8">
    <link rel="icon" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="classless.css" />
</head>

<body>
    <div class="text-center">
        <img style="display: inline; height: 2.5em;" src="favicon.png" alt="logo" />
        <h1 style="display: inline; margin-left: 0.2em; letter-spacing: 3px; color: rgb(125, 202, 210);">HAKO</h1>
    </div>
    <hr>
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
    <hr style="margin-bottom: 1em;">
    <div class="text-center">
        &copy; <?php echo date("Y"); ?>. This is <a href="https://github.com/dmpop/hako">Hako</a>
    </div>
</body>

</html>