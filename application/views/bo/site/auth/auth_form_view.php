
<div class="container main identification">

    <div class="row">
        <div class="col-md-12">
            <h1 class="big_title"><?= $this->lang->line("identification") ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <?php echo validation_errors(); ?>
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <?php echo $this->session->flashdata('message'); ?>

            <?php echo form_open(current_url(), array("class" => "form")); ?>

            <div class="form-group">
                <label for="mail" class="label-form"><?= $this->lang->line("email") ?></label>
                <input class="form-control" type="text" name="email" id="email" value="" placeholder="<?= $this->lang->line("Votre email ici...") ?>">
            </div>

            <div class="form-group">
                <label for="password" class="label-form"><?= $this->lang->line("Mot de passe") ?></label>
                <input class="form-control" type="password" name="password" id="password" value="" placeholder="<?= $this->lang->line("Votre mot de passe ici...") ?>">
            </div>

            <button type="submit" class="btn btn-noir mb60"><?= $this->lang->line("Valider") ?></button>

            <div class="form-group">
                <a href="<?= site_url("auth/get_new_password") ?>" class="block" ><?= $this->lang->line("Mot de passe oublié ?") ?></a>
            </div>
            <div class="form-group">
                <a href="<?= site_url("client/inscription") ?>" class="block" ><?= $this->lang->line("inscription") ?></a>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div> 
