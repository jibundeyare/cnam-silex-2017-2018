<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->get('/', function() use($app) {
    return <<<EOT
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Accueil</title>
  </head>
  <body>
    <h1>Accueil</h1>
  </body>
</html>
EOT;
});

$app->get('/about', function() {
  return <<<EOT
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>À propos</title>
  </head>
  <body>
    <h1>À propos</h1>
    <p>lorem ipsum</p>
  </body>
</html>
EOT;
});

$app->get('/hello/{name}', function($name) use($app) {
    return 'Hello '.$app->escape($name);
});

$app->get('/test', function() use($app) {
    $nombre = 3.14;
    $sum = $nombre + $nombre;
    $result = 'somme ' . $sum;

    return $result;
});

$app->run();
