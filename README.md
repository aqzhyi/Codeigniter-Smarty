Introduction(簡介)
===============

en: This library is a **easy & lazy & fast** to help you building **Smarty** views in Codeigniter.

You can use [this library](https://github.com/QueenbyeR/Codeigniter-Smarty) to substitute [Codeigniter-Parser](http://codeigniter.org.cn/user_guide/libraries/parser.html) library, or direct use **Smarty** build-in function to write your web application.


zh: 這個類庫是一項可以讓你在 Codeigniter 之中， **簡單、懶惰、快速** 的 Smarty 樣版引擎建置方法。

你可以直接使用[這個類庫](https://github.com/QueenbyeR/Codeigniter-Smarty)取代內建的 [Codeigniter-Parser](http://codeigniter.org.cn/user_guide/libraries/parser.html) 類庫來使用它，或是直接使用傳統的 **Smarty** 內建函式使用它。


How to install? (如何安裝?)
==================

1. Go [http://www.smarty.net/](http://www.smarty.net/) and download **Smarty** library.

2. Extract **Smarty** zip file into your third_party dir like a example: `/application/third_party/Smarty-3.1.11/`

	Example path
	`/application/third_party/Smarty-3.1.11/demo`
	`/application/third_party/Smarty-3.1.11/libs`
	`/application/third_party/Smarty-3.1.11/change_log.txt`
	`/application/third_party/Smarty-3.1.11/COPYING.lib`
	`/application/third_party/Smarty-3.1.11/README`

3. Get [this library](https://github.com/QueenbyeR/Codeigniter-Smarty) into dir: `/application/libraries/template.php`


How to use? (如何使用?)
===============

#### Basic syntax (基本語法)

`in Controller`
```php
<?php
function index() {
	// You also can setting autoload in /application/config/autoload.php
	$this->load->library( 'template' );

	// Such as traditional syntax
	$this->template->assign( 'title', 'CI-Smarty Example' );
	$this->template->assign( 'keyword', 'codeigniter,smarty,template' );

	$this->template->display( 'home/index', $assign ); // default file ext is `.html`
}
```

`in HTML`
```html
<!DOCTYPE HTML>
<html>
<head>
	<title>{$title} - website name</title>
	<meta name="keywords" content="{$keyword}">
</head>
```


#### How to return a fetched html string? (如何返回html字串供額外使用?)

`in Controller`
```php
<?php
function index() {
	$this->load->library( 'template' );

	$data['title']   = 'CI-Smarty Example';
	$data['keyword'] = 'codeigniter,smarty,template';

	// Such as traditional syntax
	$string = $this->template->parse( 'home/index', $data, true ); // default file ext is `.html`

	echo $string;
}
```


#### How to access $CI in views? (如何在視圖中, 存取CI物件?)

`in Controller`
```php
<?php
function index() {
	$this->load->library( 'template' );

	$CI =& get_instance();

	$this->template->assign( 'CI', $CI );

	$this->template->display( 'home/index', $assign ); // default file ext is `.html`
}
```

`in HTML`
```html
<!DOCTYPE HTML>
<html>
<head></head>
<body>
	hello, world<br />
	This site's name is {$CI->config->item( 'site_name' )}.
</body>
```


#### Traditional function? (smarty的傳統函數?)

`{nocache}{/nocache}`

`in HTML`
```html
<!DOCTYPE HTML>
<html>
<head></head>
<body>
	hello, world the time is {nocache}{$smarty.now|date_format}{/nocache}
</body>
```