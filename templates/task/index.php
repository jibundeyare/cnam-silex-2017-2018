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
                            <td><?= $task['id'] ?></td>
                            <td><a href="/task/<?= $task['id'] ?>"><?= $task['title'] ?></a></td>
                            <td><?= $task['done'] ?></td>
                            <td><?= $task['deadline'] ?></td>
                            <td><?= $task['name'] ?></td>
                        </tr>
<?php
endforeach;
?>
                    </table>
                </div>
            </div>
        </div>

<?php require __DIR__.'/../footer.php' ?>
