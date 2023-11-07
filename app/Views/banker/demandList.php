<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<?php //dd($demands);?>
        <h1 class="h3 mb-3"><strong><?= $title; ?></strong> </h1>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"> Listes des Demandes <a href="<?= base_url('demand/export/excel'); ?>" class="btn btn-primary btn-sm float-end" >Exporter sous Excel</a></h5>
            </div>        
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-receive-tab" data-bs-toggle="tab" data-bs-target="#nav-receive" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Reçues</button>
                        <button class="nav-link" id="nav-treating-tab" data-bs-toggle="tab" data-bs-target="#nav-treating" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">En cours</button>
                        <button class="nav-link" id="nav-suspend-tab" data-bs-toggle="tab" data-bs-target="#nav-suspend" type="button" role="tab" aria-controls="nav-valid" aria-selected="false">En attente</button>
                        <button class="nav-link" id="nav-validated-tab" data-bs-toggle="tab" data-bs-target="#nav-validated" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Validées</button>
                        <button class="nav-link" id="nav-closed-tab" data-bs-toggle="tab" data-bs-target="#nav-closed" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Clôturés</button>
                        <button class="nav-link" id="nav-canceled-tab" data-bs-toggle="tab" data-bs-target="#nav-canceled" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Annulées</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <?= $this->include('banker/include/receveidDemands_list'); ?>
                    <?= $this->include('banker/include/treatingDemands_list'); ?>
                    <?= $this->include('banker/include/suspendedDemands_list'); ?>
                    <?= $this->include('banker/include/validatedDemands_list'); ?>
                    <?= $this->include('banker/include/closedDemands_list'); ?>
                    <?= $this->include('banker/include/canceledDemands_list'); ?>
                </div>
                
            </div>
        </div>
<div class="modal fade" <?php if(($user['role_name'] === 'Banquier')) echo 'id="demandFormModal"' ?>  tabindex="-1" aria-labelledby="formUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formUserModalLabel">Modifier la demande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card-head">
                <span>&nbsp; Demande de : <span id="autor" class="h6"></span></span> 
            </div>
            <form action="<?= base_url('demand/status/update'); ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="m-sm-4">
                        <h5 class="card-title mb-0">Information sur le Voyage </h5>
                        <div class="mb-3">
                            <input type="hidden" class="form-control form-control-lg" value="" name="demandId" id="demandId" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputDobt">Date Début Voyage</label>
                            <input type="date" class="form-control form-control-lg" name="inputDobt" id="inputDobt" placeholder="Entrer la date de départ de voyage" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputDoet">Date fin de voyage</label>
                            <input type="date" class="form-control form-control-lg" name="inputDoet" id="inputDoet" placeholder="Entrer la date de votre retour" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputDestination">1ère destination</label>
                            <select name="inputCountry" id="inputCountry" class="form-select form-select-lg" required>
                            <?php foreach($countries as $country) :?>    
                                <option value="<?= $country['code'] ;?>" <?= (!empty($demand) AND ($demand['destination'] === $country['code']))? 'selected':'' ?>><?= $country['name'] ;?></option>
                            <?php endforeach ;?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">N° Passeport</label>
                            <input class="form-control form-control-lg" value="<?= set_value('inputPasspNum'); ?>" type="text" maxlength="14" oninput="this.className = ''" name="inputPasspNum" id="inputPasspNum" placeholder="Entrer votre numéro compte" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputDov">Valable jusqu'au</label>
                            <input type="date" class="form-control form-control-lg" name="inputDov" id="inputDov" placeholder="Entrer la date de votre retour" required>
                        </div>
                        <h5 class="card-title mb-0">Information Bancaire </h5>                            
                        <div class="mb-3">
                            <label class="form-label" for="inputBcType">Formule de votre carte</label>
                            <select name="inputBcType" id="inputBcType" class="form-select form-select-lg" disabled>                                                                 
                                <option value="Gold">Gold</option>
                                <option value="Privilège">Privilège</option>
                                <option value="Elite">Elite</option>                                 
                            </select>
                        </div> 
                        <div class="mb-3">
                            <label class="form-label" for="inputBcnum">Numéro de la carte Bancaire</label>
                            <input type="number" class="form-control form-control-lg" name="inputBcnum" id="inputBcnum" placeholder="Entre uniquement les 4 derniers chiffres de la carte"  required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputBcForm">Type de Formule</label>
                            <select name="inputBcForm" id="inputBcForm" class="form-select form-select-lg" disabled>
                            <?php foreach($formulas as $key => $formula) :?>    
                                <option value="<?= $key ;?>" <?= (!empty($demand) AND ($demand['bc_formula'] === $key))? 'selected':'' ?>><?= $formula ;?></option>
                            <?php endforeach ;?>
                            </select>
                        </div>
                        <h5 class="card-title mb-0">Information sur la demande </h5>                                                                            
                        <div class="mb-3">
                            <label class="form-label" for="inputStatus">Etat de la demande</label>
                            <select name="inputStatus" id="inputStatus" class="form-select form-select-lg" 
                            <?php if ($user['role_name'] === "Client"):  ?>
                            disabled
                            <?php endif ?>
                            required>
                                <?php foreach ($status as $status) : ?>
                                    <option class="form-select form-select-lg"
                                     value="<?= $status['id']; ?>"><?= $status['status']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>  
                        <div class="mb-3" id="commentDiv"></div>
                        <div class="text-center mt-3">
                            <button class="btn btn-lg btn-primary" type="submit">Modifier</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" <?php if(($user['role_name'] === 'Banquier')) echo 'id="filesListModal"' ?>  tabindex="-1" aria-labelledby="fileDemandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileDemandModalLabel">Fichiers Joints de cette demande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card-head">
                <span>&nbsp; Demande N° : <span id="idDemand" class="h6"></span> </span> 
            </div>
            <div class="mb-3"> 
                <p class="lead text-center mb-4">Fichiers Joints</p>                       
                <div class="listfiles"> </div>     
            </div> 
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('javascript') ?>
<script>

    $(document).ready(function () {        

        $(".btnFile").click(function (){
            event.preventDefault();
            const demandId  = $(this).data('id');
            const href      = $(this).attr('href');
            $('#idDemand').html(demandId);
            $.ajax({
                url: href,
                type: 'get',
                data: { demand_id:demandId },
                success: function(response){ 

                    if(response == 0)
                    {
                        $('.listfiles').addClass('text-center');
                        $('.listfiles').addClass('h4');
                        $('.listfiles').html('Il n\'a pas de fichiers joints à cette demande');                        
                    }
                    else
                    {
                        $('.listfiles').removeClass('text-center');
                        $('.listfiles').removeClass('h4');
                        $('.listfiles').html(response);
                    }
                    
                    $('#filesListModal').modal('show');
                //    récupérer la liste et l'afficher dans le modal
                },
                error: function (error)
                {
                    // error alert message
                    alert('Une erreur est survenue Veuillez contacter l\'administrateur de ce site');
                    //$('#testid').html(error);
                }
            });
            //Todo : Ajax pour recevoir les fichiers liés à la demande (interroger le controller Uploadfile)
            //Todo : afficher la liste des fichiers, avec les lien pour visualiser, dans un div comme dans la vue "demandeUpdate.php"
        });

        $(".btnEdit").click(function() {            

            const demandId  = $(this).data('id');
            const fullname  = $(this).data('fullname');
            const dobt      = $(this).data('dobt');
            const doet      = $(this).data('doet');
            const bcType    = $(this).data('bctype');
            const bcnum     = $(this).data('bcnum');
            const bcform    = $(this).data('bcform');
            const country   = $(this).data('country');
            console.log(country);
            const passport  = $(this).data('passport');
            const dov       = $(this).data('passdate');
            const stat      = $(this).data('stat');
            const comment   = $(this).data('comment');
            const zone      = $(this).data('zone');        

            $('.modalTitle').replaceWith('<h5 class="modal-title" id="formUserModalLabel">Mise à jour de la demande</h5>');
            $('.modal-footer button[type=submit]').html('Modifier');
            $('.modal-content form').attr('action', '<?= base_url('demand/status/update'); ?>');
            $('#demandId').val(demandId);
            $('#autor').html(fullname);
            $('#inputDobt').val(dobt);
            $('#inputDoet').val(doet);
            $('#inputBcnum').val(bcnum);
            $('#inputBcType').val(bcType);
            $('#inputBcForm').val(bcform);
            $('#inputCountry').val(country);
            $('#inputPasspNum').val(passport);
            $('#inputDov').val(dov);
            $('#inputStatus').val(stat);
            if (stat === 3) {
                // console.log('here')
                $('#commentDiv').html(
                    "<label class=\"form-label\" for=\"inputComment\">Les Raisons du refus</label>" +
                    "<textarea style=\" height:150px;\" class=\"form-control form-control-lg\" name=\"inputComment\" id=\"inputComment\" readonly> " +"</textarea>"
                );
                $('#inputComment').attr('readonly', true);
                }else{
                    $('#commentDiv').html('');
            }
            $('#inputComment').val(comment);
           
            <?php if ($user['role_name'] === "Banquier"):  ?>
            $('#demandId').attr('readonly', true);
            $('#inputDobt').attr('readonly', true);
            $('#inputDoet').attr('readonly', true);
            $('#inputDoet').attr('readonly', true);
            $('#inputBcnum').attr('readonly', true);
            $('#inputCountry').attr('disabled', true);
            $('#inputTown').attr('readonly', true);
            $('#inputVisaScan').attr('disabled', true);
            $('#inputPassportScan').attr('disabled', true);
            $('#inputTicketScan').attr('disabled', true);            
            $('#inputPasspNum').attr('readonly', true);
            $('#inputDov').attr('readonly', true);
            $('#inputComment').attr('readonly', false);

            $('#inputStatus').change(function() {
                let stat1 = $('#inputStatus').find(":selected").val();
                
                if (Number(stat1) === 3) {
                    console.log(stat1);
                    $('#commentDiv').html(
                        "<label class=\"form-label\" for=\"inputComment\">Les Raisons de l'attente</label>" +
                        "<textarea style=\" height:150px;\" class=\"form-control form-control-lg\" name=\"inputComment\" id=\"inputComment\"> " +
                        "</textarea>"
                    );
                    $('#inputComment').val(comment);
                }else{
                    $('#commentDiv').html('');
                }
            });            
            <?php endif ?>            
        }); 

        $('.table').DataTable({
            language: {
                lengthMenu: 'Afficher _MENU_ par page',
                zeroRecords: 'Aucun enregistrement trouvé !',
                info: 'Page _PAGE_ sur _PAGES_',
                infoEmpty: 'Aucune données valables',
                infoFiltered: '(Recherche de _MAX_ trouvés)',
                search : 'Rechercher',
                paginate:{
                    previous: 'Précédent',
                    next: 'Suivant',                    
                }
                // url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json',
            },
            order: [[10, 'desc']],
        });   
    });

</script>
<?= $this->endSection(); ?>