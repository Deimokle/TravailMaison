

<div class="container">
    <div class="col-md-12">

        <h1><?= $title ?></h1>

        <?php echo validation_errors(); ?>

        <?php echo form_open(current_url(), array("class" => "form")); ?>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="nom">Nom :</label>
                <input class="form-control" type="text" name="nom" id="nom" value="<?php echo set_value('nom', isset($admin->nom) ? $admin->nom : ""); ?>">
            </div>

            <div class="form-group col-md-6">
                <label for="prenom">Prénom :</label>
                <input class="form-control" type="text" name="prenom" id="prenom" value="<?php echo set_value("prenom", isset($admin->prenom) ? $admin->prenom : "") ?>"> 
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="prenom">Civilité :</label>
                <select name="civilite" id="civilite" value="<?php echo set_value("civilite", isset($admin->civilite) ? $admin->civilite : "") ?>">
                    <option>
                        Mr.
                    </option>
                    <option>
                        Mme
                    </option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="email">Email :</label>
                <input class="form-control" type="text" name="email" id="email" value="<?php echo set_value('email', isset($admin->email) ? $admin->email : ""); ?>">
            </div>

            <div class="form-group col-md-6">
                <label for="password">Mot de passe :</label>
                <input class="form-control" type="password" name="mdp" id="mdp" value="<?php echo set_value('mdp'); ?>" <?php if (isset($admin->mdp)) echo 'placeholder="Laisser vide pour ne pas le modifier"'; ?> >
            </div>
        </div>

        <div class="form-group col-md-12 right">
            <button type="submit" class="btn btn-success mtop20">Enregistrer</button>
            <a href="<?= site_url("/admin/listing") ?>" class="btn btn-warning mtop20">Retour</a>
        </div>

        <?php echo form_close(); ?>

    </div>
</div> 
