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
        'af', 'ak', 'am', 'ar', 'as', 'az',
        'be', 'bg', 'bm', 'bn', 'bo', 'br', 'bs', 
        'ca', 'ce', 'cs', 'cy',  
        'da', 'de', 
        'ee', 'el', 'en', 'es-mx', 'es', 'et', 'eu', 
        'fa', 'ff', 'fi', 'fo', 'fr', 
        'ga', 'gd', 'gl', 'gu',
        'ha', 'he', 'hi', 'hr', 'hu', 'hy', 
        'id', 'ig', 'ii', 'is', 'it', 
        'ja',
        'ka', 'ki', 'kk', 'kl', 'km', 'kn', 'ko', 'ks', 'ky',
        'lb', 'lg', 'ln', 'lo', 'lt', 'lv', 
        'mg', 'mk', 'ml', 'mn', 'mr', 'ms', 'mt', 'my',
        'nb', 'nd', 'ne', 'nl', 'nn', 'no', 
        'om', 'or', 'os',
        'pa', 'pl', 'ps', 'pt', 'pt-br', 
        'qu',
        'rm', 'rn', 'ro', 'ru', 'rw',
        'se', 'sg', 'si', 'sk', 'sn', 'so', 'sq', 'sr', 'sv', 'sw', 
        'ta', 'te', 'tg', 'th', 'tl', 'ti', 'to', 'tr', 
        'ug', 'uk', 'ur', 'uz',
        'vi', 
        'wo',
        'zh-cn', 'zh-hand', 'zh-hans', 'zh-hk', 'zh-tw', 'zh', 'zu'             
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