<?php
declare(strict_types=1);

global $conf, $langISO, $lang, $history;

$img_path = $conf['img_path'];

$today = date("m-d");

if (!isset($history[$today])) {
    echo "Δεν υπάρχουν γεγονότα για σήμερα.";
    exit;
}

$events = $history[$today];
$event = $events[array_rand($events)];

if (key_exists($langISO, $event['event'])) {
    $lines = explode("\n\n", $event['event'][$langISO]);
} else {
    $lines = explode("\n\n", $event['event']['en']);
}

echo "<div class=\"card\">";
echo "<h3>{$lang['on-this-day']} ({$event['date']})</h3>";
echo "<p><img alt=\"{$lines[0]}\" src=\"{$img_path}/{$event['image']}\"></p>";

foreach ($lines as $line) {
    echo "<p>{$line}</p>";
}
echo "</div>";
?>