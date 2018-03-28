<?php

// - escaping (`$app->escape()`)
// - authentification
// - upload de fichier
// - tests unitaires & tests fonctionnels
// - durée de session (`set_time_limit()`)
// - gestion des doublons dans la BDD
// - gestion de dates

use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\SessionServiceProvider;
use SilexPhpView\ViewServiceProvider;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Yaml;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Application();

$app['debug'] = true;

if ($app['debug']) {
    Debug::enable();
}

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    return new Response('We are sorry, but something went terribly wrong.');
});

$parameters = Yaml::parseFile(__DIR__.'/../config/parameters.yml');

$app->register(new DoctrineServiceProvider(), [
    'db.options' => $parameters,
]);

$app->register(new ViewServiceProvider(), [
    'view.path' => __DIR__.'/../templates',
]);

$app->register(new SessionServiceProvider());

$app->get('/', function() use ($app) {
    return $app['view']->render('home.php');
});

$app->get('/about', function() use ($app) {
    return $app['view']->render('about.php');
});

$app->get('/hello/{name}', function($name) use ($app) {
    return 'Hello '.$app->escape($name);
});

$app->get('/loops', function() use ($app) {
    return $app['view']->render('loops.php');
});

$app->get('/set-session-var', function() use ($app) {
    $app['session']->set('date', date('Y-m-d H:i:s'));
    $app['session']->set('firstname', 'Toto');
    $app['session']->set('email', 'toto@cnam.net');

    return $app['view']->render('set-session-var.php');
});

$app->get('/get-session-var', function() use ($app) {
    $date = '';
    $firstname = '';
    $email = '';

    if ($app['session']->has('date')) {
        $date = $app['session']->get('date');
        $firstname = $app['session']->get('firstname');
        $email = $app['session']->get('email');
    }

    return $app['view']->render('get-session-var.php', [
        'date' => $date,
        'firstname' => $firstname,
        'email' => $email,
    ]);
});

$app->get('/destroy-session-var', function() use ($app) {
    $app['session']->clear();
    $app['session']->invalidate();

    return $app['view']->render('destroy-session-var.php');
});

$app->get('/go-to-home', function () use ($app) {
    return $app->redirect('/');
});

$app->get('/task', function() use ($app) {
    $sql = 'SELECT *, task.id AS task_id
    FROM task
    INNER JOIN importance ON importance.id = task.importance_id
    ORDER BY importance.weight DESC, task.deadline ASC, task.title ASC';
    $tasks = $app['db']->fetchAll($sql);

    return $app['view']->render('task/index.php', [
        'tasks' => $tasks
    ]);
});

$app->get('/task/{id}', function($id) use ($app) {
    $sql = 'SELECT * FROM task WHERE id = ?';
    $task = $app['db']->fetchAssoc($sql, [$id]);

    return $app['view']->render('task/show.php', [
        'task' => $task,
    ]);
});

$app->match('/task/new', function(Request $request) use ($app) {
    $errorMessages = [];

    if ($request->getMethod() == 'POST') {
        $error = false;

        if (empty($request->get('title'))) {
            $error = true;
            $errorMessages['title'] = 'Veuillez remplir ce champ';
        }

        if (!$error) {
            $title = $request->get('title');
            $done = (int) $request->request->has('done');

            // le champs deadline doit être `null` si aucune date n'est précisée
            // vérification avec un bloc if
            if (empty($request->get('deadline'))) {
                $deadline = null;
            } else {
                $deadline = $request->get('deadline');
            }

            // même vérification mais avec un opérateur ternaire
            // $deadline = empty($request->get('deadline')) ? null : $request->get('deadline');

            $importance_id = $request->get('importance_id');

            $app['db']->insert('task', [
                'title' => $title,
                'done' => $done,
                'deadline' => $deadline,
                'importance_id' => $importance_id,
            ]);
        }
    }

    return $app['view']->render('task/new.php', [
        'errorMessages' => $errorMessages,
    ]);
})->method('GET|POST');

$app->run();
