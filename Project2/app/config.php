<?php

// settings for db
require_once __DIR__ . '/../app/config_db.php';
// ------------
$myTemplatesPath = __DIR__ . '/../templates';

// load twig
$loader = new Twig_Loader_Filesystem($myTemplatesPath);
$twig = new Twig_Environment($loader);

// load silex
$app = new Silex\Application();

// register Session provider with Silex
$app->register(new Silex\Provider\SessionServiceProvider());

// register Twig with Silex
$app->register(new Silex\Provider\TwigServiceProvider(), array(
'twig.path' => $myTemplatesPath
));
