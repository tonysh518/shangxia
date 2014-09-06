<?php

require_once("yii/yii.php");

define("ROOT_PATH", dirname(__FILE__));

$config = ROOT_PATH.'/protected/config/main.php';

defined('YII_DEBUG') or define('YII_DEBUG', FALSE);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',6);

Yii::createWebApplication($config)->run();
