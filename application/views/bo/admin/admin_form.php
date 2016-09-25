<div class="container">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">

            <?= form_open(site_url('paddle/add/'.$catalogue_id), array('class' => 'form-inline', 'id' => 'form_paddle')) ?>
            <?= validation_errors() ?>

            <?php echo $this->session->flashdata('error_validation'); ?>

            <div class="row text-center">
                <input type="hidden" name="action" value="insert" id="actionInput">
                <input type="hidden" name="id" value="" id="idInput">

                <div class="form-group">
                    <button type="submit" class="btn btn-danger" id="deleteButton" style="display: none;"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="num_paddle" id="numpaddleInput" placeholder="N° Paddle" value="">
                </div>

                <div class="form-group">
                    <select class="form-control" name="source" id="sourceInput">
                        <option  value="tel">Telephone</option>
                        <option  value="web">Site web</option>
                        <option  value="salle">En salle</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="client_code" id="codeclientInput" placeholder="Code Client" value=""> 
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="nom_temp" id="clientempInput" placeholder="Nom Du Client" value="">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="email"  id="emailInput" placeholder="E-mail" value="">
                </div>

                <button type="submit" class="btn btn-success" id="insertButton"><i class="fa fa-check" aria-hidden="true"></i></button>
                <button type="submit" class="btn btn-info" id="updateButton" style="display: none;"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-warning" id="resetButton" style="display: none;"><i class="fa fa-ban" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <?= form_close() ?>


        <?= form_open('', array('class' => 'form-inline')) ?>

        <div class="col-md-6">
            <form class="navbar-form" role="search">
                <div class="input-group">
                    <input type="text" class="form-control float-left" placeholder="Filtrage dans la liste"  name="Barre_recherche" id="barre_recherche" >
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="button" ><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" class="form-control" name="identification"  id="identificationInput" placeholder="Identification" value="" style="width: 4%;"> Identification à vérifier uniquement
                    </label>
                </div>
                <br /><input type="text" id="textbox2"/>
            </form>
        </div>        
        <?= form_close() ?>
    </div>
</div>

<div class="container">
    <div class="row">
        <table id="paddle_table" class="table table-bordered table-hover table-striped ">
            <div id="resultats"value="<?= $paddle->nom_temp ?>"> </div>
        </table>
    </div>
</div>


<div class="container ">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table id="paddle_table" class="table table-bordered table-hover table-striped ">
                <tr>
                    <td></td>
                    <td>N° Paddle</td>
                    <td>Source</td>
                    <td>Code Client</td>
                    <td>Nom du client</td>
                    <td>Email</td>                    
                </tr>
                <?php foreach ($paddles as $paddle): ?>
                    <tr class="<?= $paddle->id ?>">
                        <td></td>
                        <td class="num_paddle"><?= $paddle->num_paddle ?><input type="hidden" value="<?= $paddle->num_paddle ?>" ></td>
                        <td class="source"><?= $paddle->source ?><input type="hidden" value="<?= $paddle->source ?>"></td>
                        <td class="client_code"><?= $paddle->client_code ?><input type="hidden" value="<?= $paddle->client_code ?>"></td>
                        <td class="nom_temp"><?= $paddle->nom_temp ?><input type="hidden" value="<?= $paddle->nom_temp ?>"></td>
                        <td class="email"><?= $paddle->email ?><input type="hidden" value="<?= $paddle->email ?>"></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>





<script type="text/javascript">

    $("#barre_recherche").keyup(function () {
        var textinput = $('#barre_recherche').val().substring(0, 8);
        $('#resultats').append('<br />Handler for .keyup() called - ' + textinput);
        $("#textbox2").val(textinput);
    });
</script>

<script type="text/javascript">
    $('#clientempInput').autocomplete({
        source: '<?= site_url("client/get_JSON") ?>',
        autoFocus: true,
        select: function (event, ui) {
            $('#codeclientInput').val(ui.item.code);
            $('#clientempInput').val(ui.item.fullname);
            $('#emailInput').val(ui.item.email);
            return false;
        },
        /*
         change: function (event, ui) {
         if (!ui.item) {
         //http://api.jqueryui.com/autocomplete/#event-change -
         // The item selected from the menu, if any. Otherwise the property is null
         //so clear the item for force selection
         $("#clientempInput").val("");
         }
         }
         */
    });</script>

<script type="text/javascript">

    var fauxid = 0;
    $('#paddle_table').on("click", "tr", function () {

        id = $(this).attr('class');
        num_paddle = $(this).find('.num_paddle').find('input').val();
        source = $(this).find('.source').find('input').val();
        client_code = $(this).find('.client_code').find('input').val();
        nom_temp = $(this).find('.nom_temp').find('input').val();
        email = $(this).find('.email').find('input').val();
        $('#idInput').val(id);
        $('#numpaddleInput').val(num_paddle);
        $('#codeclientInput').val(client_code);
        $('#sourceInput').val(source);
        $('#clientempInput').val(nom_temp);
        $('#emailInput').val(email);
        $('#form_paddle').attr("action", "<?= site_url('paddle/edit/'.$catalogue_id) ?>");
        $('#deleteButton').show();
        $('#resetButton').show();
        $('#updateButton').show();
        $('#insertButton').hide();
    });
    $('#deleteButton ').click(function () {
        $('form').attr('action', '<?= site_url('paddle/del') ?>')
    });
    $('#resetButton').click(function () {
        $('#idInput').val("");
        $('#numpaddleInput').val("");
        $('#codeclientInput').val("");
        $('#sourceInput').val("");
        $('#clientempInput').val("");
        $('#emailInput').val("");
        $('#actionInput').val('insert');
        $('#idInput').val('');
        $('#deleteButton').hide();
        $('#resetButton').hide();
        $('#insertButton').show();
        $('#updateButton').hide();
    });

</script>

