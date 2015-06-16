yii2-mailbox
============
Simple Mailbox For Yii 2.0

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist hscstudio/yii2-mailbox "1.0"
```

or add

```
"hscstudio/yii2-mailbox": "1.0"
```

to the require section of your `composer.json` file.


Database migration

import from [mailbox.sql](migrations/mailbox.sql)

or

```
yii migrate --migrationPath=@hscstudio\mailbox\migrations
```

Usage
-----

Instantly, only access 
```
index.php?r=mailbox
```