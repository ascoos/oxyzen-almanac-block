<p align="center">
  <img src="https://dl.ascoos.com/images/ascoos.png" height="120" />
</p>

---

# Oxyzen Almanac Block

**Oxyzen Almanac Block** is a dynamic, extensible, and fully customizable block that displays historical “On This Day” events.  
It supports multiple layouts, themes, multilingual content, responsive design, and optional integration with the **BootLib UI Framework**.

---

## Features

- **3 Layouts**
    - `card` - vertical card
    - `vcard` - horizontal card (image left, text right)
    - `list` - event list with modal
- **Themes** using CSS `light-dark()`
- **Image support** (thumb/full)
- **Multilingual system** with ISO codes (`en`, `el`, `fr`, `zh-cn`, `zh-tw`, etc.)
- **BootLib modal integration** (optional)
- **JSON-based data** per day and month
- **Fully responsive**
- **Config-driven behavior** via `conf.php`
- Optional Ascoos OS compatibility

---

## Folder Structure

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

## Configuration (`config/conf.php`)

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

## Usage

The block is loaded through `index.php`:

```php
<section class="oxyzen-block">
    <div class="oxyzen-block-almanac <?= $layout ?>">
        <?php include "libs/{$layout}.php"; ?>
    </div>
</section>
```

You can switch layouts directly from `conf.php`.

---

## Layouts

### **card**

![Vertical Card](https://cdn.ascoos.com/images/blocks/almanac/vertical-card.png)

---

### **vcard**

![Horizontal Card](https://cdn.ascoos.com/images/blocks/almanac/horizontal-card.png)

---

### **list**

![List](https://cdn.ascoos.com/images/blocks/almanac/list-1024.png)

---

## Multilingual System

Each language file is simple:

```php
<?php
return [
    'on-this-day' => 'On this day'
];
```

Supported ISO codes include:

- `zh-cn` (Simplified Chinese)
- `zh-tw` (Traditional Chinese)
- `pt-br`
- `en-gb` → falls back to `en`

The system automatically falls back to English if a language file is missing.

---

## Date Data

Each day has its own JSON file:

```
/data/4/21/almanac.json
```

Format:

```json
{
  "04-21": [
    {
      "date": "1967-04-21",
      "image": "1967-greece-military-coup.webp",
      "event": {
        "el": "Greek text...",
        "en": "English text..."
      }
    }
  ]
}
```

---

## Themes

Themes are stored in:

```
/themes/{theme}/theme.css
```

Using CSS `light-dark()`:

```css
:root {
    --al-bg: light-dark(#ffffff, #111111);
    --al-fg: light-dark(#111111, #f5f5f5);
}
```

---

## BootLib Modal Integration

If `bootlib = true`, then:

- BootLib CSS/JS is automatically loaded
- The modal becomes:

```html
<a data-blib-modal="modal-1">Open</a>

<div id="modal-1" class="blib-modal">
    <div class="blib-modal-content">
        ...
    </div>
</div>
```

No custom JavaScript is required.

---

## Responsive Layouts

- `card` → 100% width on mobile  
- `vcard` → becomes vertical on small screens  
- `list` → smaller thumbnails & compact rows  

All responsive rules are defined in the theme.

---

## Future Enhancements

- Auto‑generator for all days of the year  
- Admin panel for event management  
- API endpoint for external use  
- Dark/Light theme switching  

---

## License

AGL-F License - Ascoos General License (Free).

---

## Contributing

Pull requests are welcome.  
For major changes, please open an issue first.

---

## Author

**Drogidis Christos**  

ASCOOS OS Creator  

https://www.ascoos.com
