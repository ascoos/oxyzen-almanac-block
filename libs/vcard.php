<?php
declare(strict_types=1);

global $langISO, $lang, $history,  $img_url, $img_path, $today, $dataLang;


if (!isset($history[$today])) {
    echo $lang['no-events'];
} else {

    $events = $history[$today];
    $event = $events[array_rand($events)];
    $lines = explode("\n\n", $event['event'][$dataLang]);

    $image = (file_exists($img_path . "/" . $event['image'])) ? $img_url . "/" . $event['image'] : $img_url . '/image-not-available.webp';

    echo "<div class=\"vcard-item\">";
    echo "<div class=\"vcard-image\">";
    echo "<img src='{$image}' alt='{$lines[0]}'>";
    echo "</div>";

    echo "<div class='vcard-content'>";
    echo "<h3>{$lang['like-today']} ({$event['date']})</h3>";
    foreach ($lines as $line) {
        echo "<p>{$line}</p>";
    }
    echo "</div>";
    echo "</div>";
}
?>