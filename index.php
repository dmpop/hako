<?php
error_reporting(E_ERROR);
include('config.php');
// javascript:var%20title=window.getSelection();location.href='http://127.0.0.1:8000/index.php?url='+encodeURIComponent(location.href)+'&title='+'&password=password'
if (!file_exists('archive')) {
    mkdir('archive', 0755, true);
}
if (!empty($_GET['title']) and $_GET['password'] == $password) {
    $file_name = preg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $_GET['title']);
    $file_name = preg_replace("([\.]{2,})", '', $file_name);
    $file_name = str_replace(" ", "_", $file_name);
    shell_exec('./monolith ' . $_GET['url'] . ' --isolate --output archive/' . $file_name . '.html');
    $f = fopen("archive/" . $file_name . ".txt", "a");
    fwrite($f, $_GET['title'] . "\n");
    fwrite($f, $_GET['url'] . "\n");
    fclose($f);
}
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
        </div>
        <div class="text-center">
            <button style="margin-bottom: 1em;" onclick="location.href='add.php'">Add</button>
        </div>
        <hr style="margin-bottom: 2em;">
        <?php
        $file_list = glob('archive/*.html');
        foreach ($file_list as $file_name) {
            $array = explode("\n", file_get_contents('archive/' . basename($file_name, ".html") . '.txt', true));
            $title = $array[0];
            $url = $array[1];
            if (!empty($url)) {
                echo "<p><a style='margin-right: 0.3em; vertical-align: middle;' href='$file_name' target='_blank'>" . $title . "</a> <strong><a style='margin-left: 0.5em; margin-right: 0.5em;' href='$url'><img style='vertical-align: middle;' src='svg/external-link.svg' height=14 alt='Open original link' title='Open original link' /></a></strong><a href='delete.php?file=" . basename($file_name) . "'><img style='vertical-align: middle;' src='svg/delete.svg' height=14 alt='Delete archive' title='Delete archive' /></a></strong></p>";
            } else {
                echo "<p><a href='$file_name'>" . basename(str_replace("_", " ", $file_name), ".html") . "</a></p>";
            }
        }
        ?>
        <hr>
        <div class="text-center" style="margin-bottom: .5em;">
            <?php echo $footer; ?>
        </div>
    </div>
</body>

</html>