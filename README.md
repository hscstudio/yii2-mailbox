yii2-mailbox
============
Simple Mailbox For Yii 2.0

[![Latest Stable Version](https://poser.pugx.org/hscstudio/yii2-mailbox/v/stable)](https://packagist.org/packages/hscstudio/yii2-mailbox) [![Total Downloads](https://poser.pugx.org/hscstudio/yii2-mailbox/downloads)](https://packagist.org/packages/hscstudio/yii2-mailbox) [![Latest Unstable Version](https://poser.pugx.org/hscstudio/yii2-mailbox/v/unstable)](https://packagist.org/packages/hscstudio/yii2-mailbox) [![License](https://poser.pugx.org/hscstudio/yii2-mailbox/license)](https://packagist.org/packages/hscstudio/yii2-mailbox)

## Installation

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


## Database migration

import from [mailbox.sql](migrations/mailbox.sql)

or

```
yii migrate --migrationPath=@hscstudio\mailbox\migrations
```

## Usage

Instantly, only access 
```
index.php?r=mailbox
```

## Customize View

we can customize the view by copying the default view `@hscstudio/mailbox/views/default` to `@app/views/mailbox` and then add the following config.

```	
'modules' => [
	'mailbox' => [		
		'view' => '@app/views/mailbox',			
	],
],
```

## How to Contribute

This tools is an OpenSource project so your contribution is very welcome.

In order to get started:

- Install this in your local (read installation section)
- Clone this repository.
- Check [README.md](README.md).
- Send [pull requests](https://github.com/hscstudio/yii2-mailbox/pulls).

Aside from contributing via pull requests you may [submit issues](https://github.com/hscstudio/yii2-mailbox/issues).

## Our Team

- [Hafid Mukhlasin](http://www.hafidmukhlasin.com) - Project Leader / Indonesian Yii developer.

We'd like to thank our [contributors](https://github.com/hscstudio/yii2-mailbox/graphs/contributors) for improving
this tools. Thank you!

Jakarta - Indonesia
