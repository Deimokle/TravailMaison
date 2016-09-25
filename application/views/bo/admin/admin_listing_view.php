
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1><?= $title ?></h1>
            <?= isset($errors) ? $errors : "" ?>
            <p class="text-right"><a href="<?= site_url("admin/add") ?>" class="btn btn-info">Ajouter un administrateur</a></p>
        </div>
    </div>
</div>

<div class="container ">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table id="paddle_table" class="table table-bordered table-hover table-striped ">
                <tr>
                    <td></td>
                    <td>Nom</td>
                    <td>Prenom</td>
                    <td>Civilite</td>
                    <td>Email</td>
                </tr>
                <?php foreach ($all_admin as $admin) : ?>

                    <tr class="<?= $admin->id ?>">
                        <td></td>
                        <td class="nom"><?= $admin->nom ?><input type="hidden" value="<?= $admin->nom ?>" >
                            <div class="">
                                <div class="pull-right link-crud">
                                    <a href="<?= site_url("admin/edit/".$admin->id) ?>">
                                        <button type="button" class="btn btn-default btn-xs">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Editer
                                        </button></a>
                                    <a href="<?= site_url("admin/del_confirm/".$admin->id) ?>">
                                        <button type="button" class="btn btn-default btn-xs">
                                            <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>Supprimer
                                        </button></a>
                                </div>
                            </div>
                        </td>
                        <td class="prenom"><?= $admin->prenom ?><input type="hidden" value="<?= $admin->prenom ?>"></td>
                        <td class="civilite"><?= $admin->civilite ?><input type="hidden" value="<?= $admin->civilite ?>"></td>
                        <td class="email"><?= $admin->email ?><input type="hidden" value="<?= $admin->email ?>"></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>