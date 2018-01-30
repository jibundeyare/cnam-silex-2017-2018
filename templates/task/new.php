<?php require __DIR__.'/../header.php' ?>

        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>Ajout d'une tâche</h1>

                    <form method="post">
                        <div class="form-group <?php if (isset($errorMessages['title'])): ?>has-error<?php endif ?>">
                            <label for="title">Titre</label>
                            <input class="form-control" type="text" id="title" name="title" value="" placeholder="le titre ici..." />
                            <?php if (isset($errorMessages['title'])): ?>
                                <span class="help-block"><?= $errorMessages['title'] ?></span>
                            <?php endif ?>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="done" name="done" value="" /> Fait
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="deadline">Date limite</label>
                            <input class="form-control" type="date" id="deadline" name="deadline" value="" placeholder="la date limite ici..." />
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="importance_id" id="importance_id1" value="1" checked />
                                Important
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="importance_id" id="importance_id2" value="2" />
                                Très important
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="importance_id" id="importance_id3" value="3" />
                                Pas important
                            </label>
                        </div>
                        <input class="btn btn-default" type="submit" value="OK" />
                    </form>
                </div>
            </div>
        </div>

<?php require __DIR__.'/../footer.php' ?>
