<div class="container">
    <div class="row">
        <div class="col-md-12 centerb">
            <h1><?php echo $title; ?></h1>
            <div>Voulez vous vraiment supprimer <?php
                echo $admin->prenom . " " . $admin->nom . " ?";
                ?>  </div>
            <a class="btn btn-success mtop20" href="<?= site_url("/admin/del/" . $admin->id) ?>">Oui</a>
            <a class="btn btn-danger mtop20" href="<?= site_url("/admin/listing") ?>">Non</a>
        </div>
    </div>
</div> 



