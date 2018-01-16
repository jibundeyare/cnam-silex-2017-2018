<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="/css/main.css" />
    </head>
    <body>

        <h1>détail d'une tâche</h1>

        <?= $task['id'] ?><br />
        <?= $task['title'] ?><br />
        <?= $task['description'] ?><br />
        <?= $task['done'] ?><br />
        <?= $task['deadline'] ?><br />
        <?= $task['importance_id'] ?><br />
        <?= $task['importance'] ?><br />

    </body>
</html>
