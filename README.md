<!--
    This file is part of the "Diaporamas" Thelia 2 module.

    Copyright (c) OpenStudio
    email : dev@thelia.net
    web : http://www.thelia.net

    For the full copyright and license information, please view the LICENSE.txt
    file that was distributed with this source code.
-->

Diaporamas module v0.1.5
===

Author: [Romain Ducher](mailto://rducher@openstudio.fr)

1. Usage
---

This module enables you to insert diaporamas into descriptions. It currently works for products, categories, folders,
contents and brands.

Diaporamas are identified with short codes. Diaporama shortcodes are strings containing letters (lowercase and uppercase),
numbers, underscores and hyphens. A shortcode has to contain between 1 and 32 characters.

To insert a diaporama into a description, insert the "`[£ shortcode £]`" tag, where `shortcode` is your diaporama shortcode.
For example, writing "[£ foo £]" will insert in the description the diaporama whose shortcode is "foo". Do not forget
spaces around the shortcode or the diaporama tag will not be interpreted as a diaporama in your description.

To manage your diaporamas, log in into Thelia's back office and go to `Tools` > `Diaporamas` in Thelia's menu. There is
a list summing up existing diaporamas. For each diaporama, the ID in the database, the title and the shortcode are
displayed. In an upcoming release, you will be able to see the diaporama by clicking on its shortcode or by clicking on
the opened eye in diaporama actions.

If you want to create diaporamas, click on the '`+`' sign in the top-right corener of the Diaporama list. Write its title
in the lang precised by the flag in the title field and then write its shortcode in the corresponding field. If the
shortcode has been already used by an existing diaporama, the diaporama creation will fail. It will create an empty
diaporama, without images.

To edit a diaporama, go to the diaporamas list and click on its database ID, its title or the edit button in the
diaporama actions. Here you can manage your diaporama just like you want. There are two tabs for this:

* The first tab, called "`General`", enables you to change the shortcode or the title in the Thelia lang you want to.
Save your changes by clicking on "Save" or "Save and Close" and go back to the diaporama list by clicking on "Close". 
* The second tab, called "`Images`", enables you to manages diaporama's images. You manage them just like images for
products, categories, brands, folders or contents in Thelia.

To delete diaporamas, go to the diaporama list and click on the Trash Icon of the diaporama you want to delete.

The module uses the [SmartyFilter module](https://github.com/thelia-modules/SmartyFilter) to change shortcodes into
diaporamas. For this, the Smarty filter whose code is `diaporamas.filter.shortcodes` has to be activated. The filter
is activated automatically while activating the Diaporamas module.


2. API
---

The module provides some entities for using Diaporamas in Thelia.

### 2.1. Loops

The module provides two loops.

#### 2.1.1. Diaporama

It deals with diaporamas in general, with their general information.

Inputs:

| Argument | Description |
| -------- | ----------- |
| id | The diaporama IDs in the database, separated by commas |
| title | The diaporama title |
| shortcode | The diaporama shortcode |
| order | How to order diaporamas. Values can be `id`, `id-reverse` (order by id), `title`, `title-reverse` (order by title), or `shortcode` and `shortcode-reverse` (order by shortcode). |

Outputs:

| Variable | Description |
| -------- | ----------- |
| $ID | Diaporama ID |
| $TITLE | Diaporama title |
| $SHORTCODE | Diaporama shortcode |

#### 2.1.2. DiaporamaImage

This loops deals with diaporama images. It almost works like Thelia's Image Loop, whose reference is
[here](http://doc.thelia.net/en/documentation/loop/image.html). The difference is that you do not have to give a
`source` argument. If you give it, it will be ignored. Do not provide `category`, `product`, `folder`, `content` or
`brand` arguments too. You are dealing with diaporama images, not images for those sources. Those arguments will be
ignored if you give them too. To give a diaporama ID to the loop, write it in the `source_id` argument.

### 2.2 Models

There are classes for diaporama and diaporama images.

Diaporamas are represented by the `\Diaporamas\Model\Diaporama` class. They contain general information for diaporamas,
i.e. the database ID, the shortcode and the (i18n) title.

Diaporama images are represented by the `\Diaporamas\Model\DiaporamaImage` class. They work just like classic Thelia
images whose source would be "diaporama".

### 2.3. Forms

There are forms to create, update and delete diaporamas and to update diaporama images. See the `config.xml` file to have
information about them.

### 2.4. Services and events

| Event to dispatch (namespace `\Diaporamas\Event\`) | Event type (namespace `\Diaporamas\Event\`) | Description |
| -------------------------------------------------- | ------------------------------------------ | ----------- |
| `DiaporamaEvents::CREATE` | `DiaporamaEvent` | Creating a diaporama |
| `DiaporamaEvents::UPDATE` | `DiaporamaEvent` | Updating a diaporama |
| `DiaporamaEvents::DELETE` | `DiaporamaEvent` | Deleting a diaporama |
| `DiaporamaEvents::DIAPORAMA_HTML` | `DiaporamaHtmlEvent` | While retrieving diaporama's HTML in the back office |
| `DiaporamaEvents::DIAPORAMA_PARSE` | `DiaporamaHtmlEvent` | While parsing descriptions to insert diaporama's HTML in the back office |
| `DiaporamaEvents::DIAPORAMA_HTML_FRONT` | `DiaporamaHtmlEvent` | Same as `DiaporamaEvents::DIAPORAMA_HTML` but for front office |
| `DiaporamaEvents::DIAPORAMA_PARSE_FRONT` | `DiaporamaHtmlEvent` | Same as `DiaporamaEvents::DIAPORAMA_PARSE` but for front office |
| `DiaporamaImageEvents::CREATE` | `DiaporamaImageEvent` | Creating a diaporama image |
| `DiaporamaImageEvents::UPDATE` | `DiaporamaImageEvent` | Updating a diaporama image |
| `DiaporamaImageEvents::DELETE` | `DiaporamaImageEvent` | Deleting a diaporama image |
| `DiaporamaImageEvents::UPDATE_POSITION` | `DiaporamaImageEvent` | Updating the image position in the diaporama |
| `DiaporamaImageEvents::TOGGLE_VISIBILITY` | `DiaporamaImageEvent` | Changing image visibility in the diaporama |

### 2.5. Useful endpoints

| Endpoint | Description |
| -------- | ----------- |
| GET `/admin/module/Diaporamas/diaporama/{shortcode}/html` | HTML code for the [£ shortcode £] diaporama. For the back office. |
| GET `/admin/module/Diaporamas/diaporama/{shortcode}/data` | Data for the [£ shortcode £] diaporama. It returns general data for the diaporama and information about diaporama images too. For the back office. |
| GET `/diaporama/{shortcode}/html` | Same as "GET `/admin/module/Diaporamas/diaporama/{shortcode}/html`" but for the front office. |
| GET `/diaporama/{shortcode}/data` | Same as "GET `/admin/module/Diaporamas/diaporama/{shortcode}/data`" but for the front office. |


3. Installation
---

The Diaporamas module requires the [SmartyFilter module](https://github.com/thelia-modules/SmartyFilter). It is used to replace shortcodes with their corresponding HTML codes.
[Install it](https://github.com/thelia-modules/SmartyFilter#installation) and activate it before activating the Diaporamas module.

Install it as a Thelia module by downloading the zip archive and extracting it in ```thelia/local/modules``` or by uploading it with the backoffice (at ```/admin/modules```),
or by requiring it with Composer:

```json
"require": {
    "thelia/diaporamas-module": "~0.1.5"
}
```

Note: The module will create a `thelia/local/media/images/diaporama` folder to store diaporama images.
