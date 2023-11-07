<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<?php //dd($demands);?>
        <h1 class="h3 mb-3"><strong><?= $title; ?></strong> </h1>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"> Listes des Demandes <a href="<?= base_url('demand'); ?>" class="btn btn-primary btn-sm float-end" >Ouvrir une nouvelle Demande</a></h5>
            </div>
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Mes demandes</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <?= $this->include('customer/include/demands_list'); ?>
                </div>                
            </div>
        </div>
        <?= $this->include('customer/include/suspend_modal'); ?>
<?= $this->endSection(); ?>
<?= $this->section('javascript') ?>
<script>

    $(document).ready(function () {       

        $(".btnRead").click(function() {            

            const demandId  = $(this).data('id');
            const fullname  = $(this).data('fullname');
            const dobt      = $(this).data('dobt');
            const doet      = $(this).data('doet');
            const bcType    = $(this).data('bctype');
            const bcnum     = $(this).data('bcnum');
            const bcform    = $(this).data('bcform');
            const country   = $(this).data('country');
            const passport  = $(this).data('passport');
            const dov       = $(this).data('passdate');
            const stat      = $(this).data('stat');
            const comment   = $(this).data('comment');
            const zone      = $(this).data('zone');   
            console.log(comment);
            $('#commentDiv').html(
                "<label class=\"form-label h3\" for=\"inputComment\">Les Raisons du Suspend :</label>" +
                "<textarea style=\" height:150px;\" class=\"form-control form-control-lg\" name=\"inputComment\" id=\"inputComment\" readonly> " +"</textarea>"
            );
            $('#inputComment').attr('readonly', true);
            $('#inputComment').val(comment);                       
                   
        }); 
        
        $('#demandTable').DataTable({
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
            order: [[7, 'desc']],
        });   
    });

</script>
<?= $this->endSection(); ?>