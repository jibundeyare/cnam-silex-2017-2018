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

        <h1>task list</h1>

        <table class="table">
<?php
foreach ($tasks as $task) {
    echo '<tr>';
    echo '<td>'.$task['id'].'</td>';
    echo '<td>'.$task['title'].'</td>';
    echo '<td>'.$task['done'].'</td>';
    echo '<td>'.$task['deadline'].'</td>';
    echo '<td>'.$task['name'].'</td>';
    echo '</tr>';
}
?>
        </table>

    </body>
</html>
