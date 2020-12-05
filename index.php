<?php
// javascript:var%20title=window.getSelection();location.href='http://127.0.0.1:8000/index.php?url='+encodeURIComponent(location.href)+'&title='+escape(title)
error_reporting(E_ERROR);
if (!file_exists('archive')) {
    mkdir('archive', 0777, true);
}
if (!empty($_GET['title'])) {
    $filename = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $_GET['title']);
    $filename = mb_ereg_replace("([\.]{2,})", '', $filename);
    $filename = str_replace(" ", "_", $filename);
    shell_exec('monolith ' . $_GET['url'] . ' --isolate --output archive/' . $filename . '.html');
}
?>

<html lang="en">

<!-- Author: Dmitri Popov, dmpop@linux.com
         License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
    <meta charset="utf-8">
    <title>Hako</title>
    <meta charset="utf-8">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🗃️</text></svg>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.7/dist/css/uikit.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.7/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.7/dist/js/uikit-icons.min.js"></script>
</head>

<body>
    <div class="uk-container uk-margin-small-top">
        <div class="uk-card uk-card-default uk-card-body">
            <h1 class="uk-heading-line uk-text-center"><span>Hako</span></h1>
            <?php
            $fileList = glob('archive/*');
            //Loop through the array that glob returned.
            foreach ($fileList as $filename) {
                //Simply print them out onto the screen.
                echo "<a href='$filename'>" . basename(str_replace("_", " ", $filename), ".html") . "</a><br>";
            }
            ?>
            <hr style="margin-bottom: 1em;">
            &copy; <?php echo date("Y"); ?>. This is <a href="https://github.com/dmpop/hako">Hako</a>
        </div>
    </div>
</body>

</html>