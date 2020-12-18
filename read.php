<html lang="en">

<head>
    <meta charset="utf-8">
    <title>箱 Read</title>
    <meta charset="utf-8">
    <link rel="icon" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="water.css" />
</head>

<body>
            <?php
            require_once 'Readability.php';
            $url = $_GET['url'];
            $html = file_get_contents($url);

            // Note: PHP Readability expects UTF-8 encoded content.
            // If your content is not UTF-8 encoded, convert it 
            // first before passing it to PHP Readability. 
            // Both iconv() and mb_convert_encoding() can do this.

            // If we've got Tidy, let's clean up input.
            // This step is highly recommended - PHP's default HTML parser
            // often doesn't do a great job and results in strange output.
            if (function_exists('tidy_parse_string')) {
                $tidy = tidy_parse_string($html, array(), 'UTF8');
                $tidy->cleanRepair();
                $html = $tidy->value;
            }

            // give it to Readability
            $readability = new Readability($html, $url);
            // print debug output? 
            // useful to compare against Arc90's original JS version - 
            // simply click the bookmarklet with FireBug's console window open
            $readability->debug = false;
            // convert links to footnotes?
            $readability->convertLinksToFootnotes = false;
            // process it
            $result = $readability->init();
            // does it look like we found what we wanted?
            if ($result) {
                echo "<h1 class='uk-heading-line uk-text-center'><span>";
                echo $readability->getTitle()->textContent, "<span></h1>";
                $content = $readability->getContent()->innerHTML;
                // if we've got Tidy, let's clean it up for output
                if (function_exists('tidy_parse_string')) {
                    $tidy = tidy_parse_string($content, array('indent' => true, 'show-body-only' => true), 'UTF8');
                    $tidy->cleanRepair();
                    $content = $tidy->value;
                }
                echo $content;
            } else {
                echo "Something went wrong. :-(";
            }
            ?>
            <a href="index.php">Back</a>
</body>

</html>