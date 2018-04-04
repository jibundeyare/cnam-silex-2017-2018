<?php require __DIR__.'/../header.php' ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Détail d'une tâche</h1>
                <div class="form-horizontal">

                    <div class="form-group">
                        <label for="id" class="col-sm-2 control-label">id</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id" readonly value="<?= htmlentities($task['id']) ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">titre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" readonly value="<?= htmlentities($task['title']) ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="done" class="col-sm-2 control-label">fait ?</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="done" readonly value="<?php if ($task['done']): ?>oui<?php else: ?>non<?php endif ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deadline" class="col-sm-2 control-label">date limite</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="deadline" readonly value="<?= htmlentities($task['deadline']) ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="importance_id" class="col-sm-2 control-label">importance</label>
                        <div class="col-sm-10">
                            <?php foreach ($importances as $importance): ?>
                                <?php if ($task['importance_id'] == $importance['id']): ?>
                                    <input type="text" class="form-control" id="importance_id" readonly value="<?= htmlentities($importance['name']) ?>" />
                                <?php endif ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div><!-- /.form-horizontal -->
            </div><!-- /.col-xs-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->

<?php require __DIR__.'/../footer.php' ?>
