yii2-mailbox
============
Simple Mailbox For Yii 2.0

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist hscstudio/yii2-mailbox "*"
```

or add

```
"hscstudio/yii2-mailbox": "*"
```

to the require section of your `composer.json` file.


Database migration

```
yii migrate --migrationPath=@hscstudio\mailbox\migrations
```

Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \hscstudio\mailbox\AutoloadExample::widget(); ?>```