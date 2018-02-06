<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;

require_once __DIR__.'/../vendor/autoload.php';

// fixture
$task = [
    'id' => 123,
    'title' => 'Lorem ipsum',
    'description' => '',
    'done' => false,
    'deadline' => (new DateTime)->format('Y-m-d H:i:s'),
    'importance_id' => 1,
    'importance' => 'très important',
];

$app = new Silex\Application();

$app['debug'] = true;

$parameters = Yaml::parseFile(__DIR__.'/../config/parameters.yml');

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => $parameters,
]);

$app->register(new SilexPhpView\ViewServiceProvider(), [
    'view.path' => __DIR__.'/../templates',
]);

$app->get('/', function() use($app) {
    return $app['view']->render('home.php');
});

$app->get('/about', function() use($app) {
    return $app['view']->render('about.php');
});

$app->get('/hello/{name}', function($name) use($app) {
    return 'Hello '.$app->escape($name);
});

$app->get('/loops', function() use($app) {
    return $app['view']->render('loops.php');
});

$app->get('/task', function() use($app) {
    $sql = 'SELECT *
    FROM task
    INNER JOIN importance ON importance.id = task.importance_id
    ORDER BY importance.weight DESC, task.deadline ASC, task.title ASC';
    $tasks = $app['db']->fetchAll($sql);

    return $app['view']->render('task/index.php', [
        'tasks' => $tasks
    ]);
});

$app->match('/task/new', function(Request $request) use($app) {
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

$app->get('/task/{id}', function($id) use($app) {
    $sql = 'SELECT * FROM task WHERE id = ?';
    $task = $conn->fetchAssoc($sql, [$id]);

    return $app['view']->render('task/show.php', [
        'task' => $task,
    ]);
});

$app->run();
