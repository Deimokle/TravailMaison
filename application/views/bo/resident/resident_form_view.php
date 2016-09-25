<div class="container">
    <div class="row">
        <h3 class="text-center"><?= $title ?></h3>
        <div class="col-md-offset-2 col-md-8">
            <?php echo validation_errors(); ?>
            <?php echo form_open_multipart('', array('class' => 'form')); ?>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input name="nom" type="text" class="form-control" id="nom" placeholder="nom" value="<?= (isset($resident) ? $resident->nom : '') ?>">
            </div>
            <div class="form-group">
                <label for="civilite">Categorie</label>
                <select name="civilite" class="form-control">
                    <option value="Mr." <?= set_checkbox('civilite', 'Mr.'); ?> <?= (isset($resident) ? ($resident->civilite == 'Mr.' ? 'selected="selected"' : '') : '') ?>>Mr.</option>
                    <option value="Mme."<?= set_checkbox('civilite', 'Mme.'); ?> <?= (isset($resident) ? ($resident->civilite == 'Mme.' ? 'selected="selected"' : '') : '') ?>>Mme.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="prenom">Prenom</label>
                <input name="prenom" type="text" class="form-control" value="<?= (isset($resident) ? $resident->prenom : '') ?>">
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input name="email" type="text" class="form-control" value="<?= (isset($resident) ? $resident->email : '') ?>">
            </div>
            <div class="form-group">
                <input class="form-control btn btn-success" type="submit" value="Enregistrer">
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>