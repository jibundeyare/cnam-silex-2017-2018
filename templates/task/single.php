<?php require __DIR__.'/../header.php' ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>détail d'une tâche</h1>

                <?= $task['id'] ?><br />
                <?= $task['title'] ?><br />
                <?= $task['done'] ?><br />
                <?= $task['deadline'] ?><br />
                <?= $task['importance_id'] ?><br />
            </div>
        </div>
    </div>

<?php require __DIR__.'/../footer.php' ?>
