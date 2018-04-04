<?php require __DIR__.'/../header.php' ?>

        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>task list</h1>

                    <table class="table">
                        <tr>
                            <th>id</th>
                            <th>titre</th>
                            <th>fait ?</th>
                            <th>date limite</th>
                            <th>importance</th>
                        </tr>
                        <?php foreach ($tasks as $task): ?>
                            <tr>
                                <td><?= htmlentities($task['task_id']) ?></td>
                                <td><a href="/task/<?= htmlentities($task['task_id']) ?>"><?= htmlentities($task['title']) ?></a></td>
                                <td><?php if ($task['done']): ?>oui<?php else: ?>non<?php endif ?></td>
                                <td><?= htmlentities($task['deadline']) ?></td>
                                <td><?= htmlentities($task['importance_name']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>

<?php require __DIR__.'/../footer.php' ?>
