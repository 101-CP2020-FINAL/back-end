<?php

$config = require(__DIR__ . '/config.php');

$config['id'] = $config['id'].' [console]';

$config['controllerNamespace'] = 'app\commands';

$config['components']['request'] = [];

$config['bootstrap'] = array_filter($config['bootstrap'], function ($value) {
    return $value != 'debug';
});
unset($config['modules']['debug']);

return $config;
