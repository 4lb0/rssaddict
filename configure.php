<?php

// Load configuration
$config = parse_ini_file (__DIR__ . DIRECTORY_SEPARATOR . 'rss.ini', true);

// Load database
$db = new PDO($config['_db']['dsn'], $config['_db']['user'], $config['_db']['password']);

// Set timezone
date_default_timezone_set($config['_site']['timezone']);

// Set locale
setlocale(LC_ALL, $config['_site']['locale']);

// Set default autoload
spl_autoload_extensions('.php');
spl_autoload_register();

// Common functions

function configIsSpecial($config)
{
    return (string) $config[0] === '_';
}


