<?php

function detectBrowserLang()
{
    if (!isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        return 'en';
    }

    return mb_strtolower(str_replace('_', '-', $_SERVER['HTTP_ACCEPT_LANGUAGE']));
}


function normalize_lang($lang)
{
    $lang = mb_strtolower(str_replace('_', '-', $lang));

    // Πλήρεις κωδικοί που θέλουμε να υποστηρίζουμε
    $supported = [
        'af', 'ar', 'bg', 'bn', 'cs', 'da', 'de', 'el', 'en', 'es-mx', 'es',
        'et', 'fa', 'fi', 'fr', 'he', 'hi', 'hr', 'hu', 'hy', 'id', 'it', 'ja',
        'ko', 'lt', 'lv', 'ms', 'nl', 'nn', 'no', 'pl', 'pt', 'pt-br', 'ro', 'ru',
        'se', 'sk', 'sv', 'sw', 'th', 'tl', 'tr', 'uk', 'ur', 'vi', 'zh-cn', 'zh-hand',
        'zh-hk', 'zh-tw', 'zh'
    ];

    // Αν ο browser δώσει κάτι σαν zh-Hans-CN → το κάνουμε zh-cn
    if (preg_match('/^zh/i', $lang)) {
        if (mb_strpos($lang, 'tw') !== false) return 'zh-tw';
        if (mb_strpos($lang, 'cn') !== false) return 'zh-cn';
        return 'zh-cn'; // default Chinese
    }

    // Αν υπάρχει ακριβής αντιστοιχία
    if (in_array($lang, $supported)) {
        return $lang;
    }

    // Αν δώσει π.χ. en-us → κόβουμε στο en
    $short = mb_substr($lang, 0, 2);
    if (in_array($short, $supported)) {
        return $short;
    }

    // Fallback
    return 'en';
}
?>