<?php require __DIR__.'/../header.php' ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Ajout d'une tâche</h1>
                <form method="post" class="form-horizontal">

                    <div class="form-group <?php if (isset($errorMessages['title'])): ?>has-error<?php endif ?>">
                        <label for="title" class="col-sm-2 control-label">Titre</label>
                        <div class="col-sm-10">
                        <input class="form-control" type="text" id="title" name="title" value="<?= htmlentities($task['title']) ?>" placeholder="le titre ici..." />
                            <?php if (isset($errorMessages['title'])): ?>
                                <span class="help-block"><?= $errorMessages['title'] ?></span>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="done" name="done" <?php if ($task['done']): ?>checked <?php endif ?>/> Fait
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deadline" class="col-sm-2 control-label">Date limite</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" id="deadline" name="deadline" value="<?= htmlentities($task['deadline']) ?>" placeholder="la date limite ici..." />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <?php foreach ($importances as $importance): ?>
                            <div class="radio">
                                <label>
                                <input type="radio" name="importance_id" id="importance_id<?= htmlentities($importance['id']) ?>" value="<?= htmlentities($importance['id']) ?>" <?php if ($task['importance_id'] == $importance['id']): ?>checked <?php endif ?>/>
                                    <?= htmlentities($importance['name']) ?>
                                </label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input class="btn btn-default" type="submit" value="OK" />
                            </div>
                        </div>
                    </div>

                </form><!-- /.form-horizontal -->
            </div><!-- /.col-xs-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->

<?php require __DIR__.'/../footer.php' ?>
