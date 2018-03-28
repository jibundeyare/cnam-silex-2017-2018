<?php require __DIR__.'/../header.php' ?>

        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>task list</h1>

                    <table class="table">
<?php
foreach ($tasks as $task):
?>
                        <tr>
                            <td><?= htmlentities($task['task_id']) ?></td>
                            <td><a href="/task/<?= htmlentities($task['task_id']) ?>"><?= htmlentities($task['title']) ?></a></td>
                            <td><?= htmlentities($task['done']) ?></td>
                            <td><?= htmlentities($task['deadline']) ?></td>
                            <td><?= htmlentities($task['name']) ?></td>
                        </tr>
<?php
endforeach;
?>
                    </table>
                </div>
            </div>
        </div>

<?php require __DIR__.'/../footer.php' ?>
