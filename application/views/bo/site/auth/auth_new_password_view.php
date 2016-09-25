
<div class="container main identification">

    <div class="row">
        <div class="col-md-12">
            <h1 class="big_title"><?= $this->lang->line('Mot de passe perdu') ?></h1>            
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <?php echo validation_errors(); ?>
            <?php echo $this->session->flashdata('message'); ?>
            <?php echo form_open(current_url(), array("class" => "form")); ?>
            <div class="form-group">
                <label for="mail" class="label-form"><?= $this->lang->line('email') ?> :</label>
                <input class="form-control" type="text" name="email" id="email" value="<?php echo set_value('email'); ?>"  placeholder="..............................">
            </div>
            <button type="submit" class="btn btn-noir"><?= $this->lang->line('Valider') ?></button>            
            <?php echo form_close(); ?>

        </div>
    </div>
</div>
