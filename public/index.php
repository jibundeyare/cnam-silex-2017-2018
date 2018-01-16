<?php

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

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'driver'    => 'pdo_mysql',
        'host'      => '127.0.0.1',
        'dbname'    => 'cnam_silex_2017_2018',
        'user'      => 'root',
        'password'  => '123',
        'charset'   => 'utf8mb4',
    ],
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

$app->get('/task/{id}', function($id) use($app, $task) {
    // @todo requête sql
    // @todo récupération du résultat dans la variable $task

    return $app['view']->render('task/single.php', [
        'task' => $task,
    ]);
});

$app->run();
