<?php
declare(strict_types=1);

global $conf, $box_class, $title_class, $history, $lang, $langISO;

$img_path = $conf['img_path'];
$showImage = $conf['image'];
$count = $conf['count'];

$today = date("m-d");

if (!isset($history[$today])) {
    echo "Δεν υπάρχουν γεγονότα για σήμερα.";
    exit;
}

$events = array_slice($history[$today], 0, $count);
?>
<section class="<?= $box_class ?>">
    <h1 class="<?= $title_class ?>"><?= $lang['on-this-day'] ?></h1>
    <table class="almanac-list">
        <?php foreach ($events as $i => $event): ?>
            <?php
                if (key_exists($langISO, $event['event'])) {
                    $lines = explode("\n\n", $event['event'][$langISO]);
                } else {
                    $lines = explode("\n\n", $event['event']['en']);
                }
                $year = mb_substr($event['date'], 0, 4);
                $text = strip_tags($lines[0]);
                $short = mb_substr($text, 0, 100) . "...";
            ?>
            <tr class="almanac-row" data-modal="modal-<?= $i ?>">
                <?php if ($showImage): ?>
                    <td class="thumb">
                        <img src="<?= $img_path ?>/<?= $event['image'] ?>" alt="">
                    </td>
                <?php endif; ?>

                <td class="year"><?= $year ?></td>
                <td class="text">
                    <span class="open-modal"><?= $short ?></span>
                </td>
            </tr>

            <!-- Modal -->
            <div id="modal-<?= $i ?>" class="almanac-modal">
                <div class="modal-content">
                    <span class="close">&times;</span>

                    <h3><?= $lang['on-this-day'] ?> (<?= $event['date'] ?>)</h3>

                    <?php if ($showImage): ?>
                        <p><img src="<?= $img_path ?>/<?= $event['image'] ?>"></p>
                    <?php endif; ?>

                    <?php
                    foreach ($lines as $line) {
                        echo "<p>{$line}</p>";
                    }
                    ?>
                </div>
            </div>

        <?php endforeach; ?>
    </table>
</section>

<script src="https://cdn.ascoos.com/vendors/js/jquery.min.js?ver=4.0.0"></script>
<script>
$(function() {

    $(".almanac-row").on("click", function() {
        $("#" + $(this).data("modal")).fadeIn(200);
    });

    $(".almanac-modal .close").on("click", function() {
        $(this).closest(".almanac-modal").fadeOut(200);
    });

    $(".almanac-modal").on("click", function(e) {
        if ($(e.target).is(".almanac-modal")) {
            $(this).fadeOut(200);
        }
    });

});
</script>

