# 📅 Oxyzen Almanac Block

Το **Oxyzen Almanac Block** είναι ένα δυναμικό, επεκτάσιμο και πλήρως παραμετροποιήσιμο block που εμφανίζει ιστορικά γεγονότα “Σαν Σήμερα”.  
Υποστηρίζει πολλαπλά layouts, themes, πολυγλωσσικό περιεχόμενο, responsive σχεδίαση και προαιρετική ενσωμάτωση με το **BootLib UI Framework**.

---

## ✨ Χαρακτηριστικά

- 📌 **3 Layouts**
  - `card` — κάθετη κάρτα
  - `vcard` — οριζόντια κάρτα (εικόνα αριστερά, κείμενο δεξιά)
  - `list` — λίστα γεγονότων με modal
- 🎨 **Themes** με χρήση CSS `light-dark()`
- 🖼️ **Υποστήριξη εικόνων** (thumb/full)
- 🌍 **Πολυγλωσσικό σύστημα** με ISO codes (`en`, `el`, `fr`, `zh-cn`, `zh-tw`, κ.λπ.)
- 🧩 **BootLib modal integration** (προαιρετικό)
- 📁 **JSON-based data** ανά ημέρα και μήνα
- 📱 **Πλήρως responsive**
- ⚙️ **Config-driven συμπεριφορά** μέσω `conf.php`
- 🔧 Συμβατό με Ascoos OS (προαιρετικά)

---

## 📂 Δομή Φακέλων

```
/config
    conf.php
/data
    /4
        /20
            almanac.json
        /21
            almanac.json
        ...
/langs
    en.php
    el.php
    fr.php
    zh-cn.php
    zh-tw.php
/libs
    card.php
    vcard.php
    list.php
/themes
    /default
        theme.css
index.php
README.md
```

---

## ⚙️ Ρυθμίσεις (`config/conf.php`)

```php
return [
    'aos'        => false,     // Ascoos OS integration
    'lang'       => 'en',      // Default language
    'layout'     => 'card',    // card, vcard, list
    'theme'      => 'default', // theme folder
    'image'      => true,      // show images
    'img_path'   => 'images/blocks/almanac',
    'title'      => true,
    'date'       => true,
    'count'      => 5,         // for list layout
    'bootlib'    => false,     // enable BootLib UI
    'box_class'  => 'box',     // BootLib container class
    'title_class'=> 'title'    // BootLib title class
];
```

---

## 🧩 Χρήση

Το block φορτώνεται μέσω του `index.php`:

```php
<section class="oxyzen-block">
    <div class="oxyzen-block-almanac <?= $layout ?>">
        <?php include "libs/{$layout}.php"; ?>
    </div>
</section>
```

Αλλάζεις layout απλά από το `conf.php`.

## 📌 Layouts

### **card**

![Vertical Card](https://cdn.ascoos.com/images/blocks/almanac/vertical-card.png)

---

### **vcard**

![Horizontal Card](https://cdn.ascoos.com/images/blocks/almanac/horizontal-card.png)

---

### **list**

![List](https://cdn.ascoos.com/images/blocks/almanac/list.png)

---

## 🌍 Πολυγλωσσικό Σύστημα

Κάθε αρχείο γλώσσας είναι απλό:

```php
<?php
return [
    'on-this-day' => 'On this day'
];
```

Υποστηρίζονται πλήρεις ISO κωδικοί:

- `zh-cn` (Simplified Chinese)
- `zh-tw` (Traditional Chinese)
- `pt-br`
- `en-gb` → fallback σε `en`

Το σύστημα κάνει αυτόματο fallback σε `en` αν λείπει αρχείο.

---

## 🖼️ Δεδομένα Ημερομηνιών

Κάθε ημέρα έχει το δικό της JSON:

```
/data/4/21/almanac.json
```

Μορφή:

```json
{
  "04-21": [
    {
      "date": "1967-04-21",
      "image": "1967-greece-military-coup.webp",
      "event": {
        "el": "Κείμενο στα ελληνικά...",
        "en": "Text in English..."
      }
    }
  ]
}
```

---

## 🎨 Themes

Τα themes βρίσκονται στο:

```
/themes/{theme}/theme.css
```

Χρησιμοποιούν CSS `light-dark()`:

```css
:root {
    --al-bg: light-dark(#ffffff, #111111);
    --al-fg: light-dark(#111111, #f5f5f5);
}
```

---

## 🧩 BootLib Modal Integration

Αν `bootlib = true`, τότε:

- φορτώνεται αυτόματα το BootLib CSS/JS
- το modal γίνεται:

```html
<a data-blib-modal="modal-1">Open</a>

<div id="modal-1" class="blib-modal">
    <div class="blib-modal-content">
        ...
    </div>
</div>
```

Δεν χρειάζεται custom JavaScript.

---

## 📱 Responsive Layouts

- `card` → 100% width σε mobile  
- `vcard` → γίνεται κάθετη σε μικρές οθόνες  
- `list` → μικρότερα thumbs & compact rows  

Όλα τα responsive rules βρίσκονται στο theme.

---

## 🛠️ Μελλοντικές Επεκτάσεις

- Auto‑generator για όλες τις ημέρες του έτους  
- Admin panel για εισαγωγή γεγονότων  
- API endpoint για εξωτερική χρήση  
- Dark/Light theme switching  

---

## 📜 Άδεια

AGL-F License — Ascoos Genereal License (Free).

---

## 🤝 Συνεισφορά

Pull requests είναι ευπρόσδεκτα.  
Για μεγάλες αλλαγές, άνοιξε πρώτα ένα issue.

---

## ⭐ Αν σου άρεσε το project

Μπορείς να του δώσεις ένα ⭐ στο GitHub!