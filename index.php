<?php
declare(strict_types=1);

$aos_oxyzen_block_almanac_conf = include_once("config/conf.php");
$aos_uses = $aos_oxyzen_block_almanac_conf['aos'];
$user_lang = mb_strtolower($aos_oxyzen_block_almanac_conf['lang']);
$layout = $aos_oxyzen_block_almanac_conf['layout'];
$theme = $aos_oxyzen_block_almanac_conf['theme'];
$img_path = $aos_oxyzen_block_almanac_conf['img_path'];
$img_url = $aos_oxyzen_block_almanac_conf['img_url'];
$showImage = $aos_oxyzen_block_almanac_conf['image'];
$count = $aos_oxyzen_block_almanac_conf['count'];

$today = date("m-d");

// BootLib
$bootlib_uses = $aos_oxyzen_block_almanac_conf['bootlib'];
$box_class = ($aos_oxyzen_block_almanac_conf['box_class'] !== '') ? $aos_oxyzen_block_almanac_conf['box_class'] : 'box';
$title_class = ($aos_oxyzen_block_almanac_conf['title_class'] !== '') ? $aos_oxyzen_block_almanac_conf['title_class'] : 'title';

require_once "libs/functions.php";

if ( (PHP_VERSION_ID >= 80400) && $aos_uses && defined('ASCOOS_OS_RUN')) {
    global $utf8;
    $objLang = ASCOOS\OS\Kernel\Languages\TLanguageHandler();
    $langISO = $utf8->strtolower($objLang->getBrowserLanguage());
    $objLang->Free();
} 
elseif ($user_lang !== '') {
    $langISO = normalize_lang($user_lang);
} 
else {
    $langISO = normalize_lang(detectBrowserLang());
}

$filename = str_replace("\\", "/", __DIR__ . "/langs/" . $langISO . ".php");

if (!file_exists($filename)) {
    $langISO = 'en';
    $filename = __DIR__ . "/langs/en.php";
}
$lang = include_once($filename);

if ($aos_uses) {
    echo '<link rel="stylesheet" href="/themes/blocks/fronts/almanac/'.$theme.'/theme.css">'."\n";
} else {
    echo '<link rel="stylesheet" href="/themes/blocks/fronts/almanac/'.$theme.'/theme.css">'."\n";
//    echo '<link rel="stylesheet" href="themes/'.$theme.'/theme.css">'."\n";
}

$dataFile = __DIR__ . "/data/" . date('n') . "/" . date('j') . "/almanac.json";
$history = json_decode(file_get_contents($dataFile), true);

$dataLang = (array_key_exists($langISO, $history[$today][0]['event'])) ? $langISO : 'en';
?>
<div class="oxyzen-block-almanac <?= $layout ?>">
    <?php 
        if (!isset($history[$today])) {
            echo $lang['no-events'];
        } else {
            include "libs/{$layout}.php"; 
        }
    ?>
</div>