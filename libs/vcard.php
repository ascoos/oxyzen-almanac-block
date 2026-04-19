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
$event = $events[array_rand($events,1)];

if (key_exists($langISO, $event['event'])) {
    $lines = explode("\n\n", $event['event'][$langISO]);
} else {
    $lines = explode("\n\n", $event['event']['en']);
}
?>
<div class="vcard-item">
    <div class="vcard-image">
        <img src="<?= $img_path ?>/<?= $event['image'] ?>" alt="<?= $lines[0] ?>">
    </div>

    <div class="vcard-content">
        <h3><?= $lang['on-this-day'] ?> (<?= $event['date'] ?>)</h3>
        <?php
        foreach ($lines as $line) {
            echo "<p>{$line}</p>";
        }
        ?>
    </div>
</div>
