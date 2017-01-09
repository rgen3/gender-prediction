<?php

// ensure we get report on all possible php errors
error_reporting(-1);

define('YII_ENABLE_ERROR_HANDLER', false);
define('YII_DEBUG', true);

require_once(__DIR__ . '/../../autoload.php');
require_once(__DIR__ . '/../../yiisoft/yii2/Yii.php');

$config = require (__DIR__ . '/../../../common/config/main-local.php');

$config['id'] = 'crm';
$config['basePath'] = '.';
$config['vendorPath'] = __DIR__ . '/../..';
$config['class'] = 'yii\web\Application';

\Yii::createObject($config);