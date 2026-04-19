<?php
declare(strict_types=1);

$conf = include_once("config/conf.php");
$user_lang = mb_strtolower($conf['lang']);
$layout = $conf['layout'];
$theme = $conf['theme'];

if ($conf['bootlib']) {
    echo '<link rel="stylesheet" href="https://cdn.ascoos.com/bootlib/css/bootlib.min.css">';
    $box_class = ($conf['box_class'] !== '') ? $conf['box_class'] : 'box';
    $title_class = ($conf['title_class'] !== '') ? $conf['title_class'] : 'title';
}

require_once "libs/functions.php";

if ($user_lang !== '') {
    $langISO = normalize_lang($user_lang);
} else {
    $langISO = normalize_lang(detectBrowserLang());
}

$filename = __DIR__ . "/langs/" . $langISO . ".php";

if (!file_exists($filename)) {
    $langISO = 'en';
    $filename = __DIR__ . "/langs/en.php";
}
$lang = include_once($filename);

echo '<link rel="stylesheet" href="themes/'.$theme.'/theme.css">'."\n";

$dataFile = __DIR__ . "/data/" . date('n') . "/" . date('j') . "/almanac.json";
$history = json_decode(file_get_contents($dataFile), true);
?>


<div class="oxyzen-block-almanac <?= $layout ?>">
    <?php include "libs/{$layout}.php"; ?>
</div>    