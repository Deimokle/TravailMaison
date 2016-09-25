<div class="container ">
    <div class="row">
        <h3><?= $title; ?></h3><br>
        <a href="<?= site_url('resident/add') ?>">Ajouter un résident</a>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table id="facture_table" class="table table-bordered table-hover table-striped ">
                <thead>
                <th></th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Civilité</th>
                <th>email</th>
                </thead>
                <?php foreach ($all_resident as $r): ?>
                    <tr class="">
                        <td><a href="<?= site_url('resident/edit/'.$r->id) ?>"> editer</a></td>
                        <td class="nom"><?= $r->nom; ?><input type="hidden" name="nom[]" value="<?= $r->nom; ?>" readonly></td>
                        <td class="prenom"><?= $r->prenom; ?><input type="hidden" name="prenom[]" value="<?= $r->prenom; ?>" readonly></td>
                        <td class="civilite"><?= $r->civilite; ?><input type="hidden" name="civilite[]" value="<?= $r->civilite; ?>" readonly></td>
                        <td class="email"><?= $r->email; ?><input type="hidden" name="email[]" value="<?= $r->email; ?>" readonly></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>0