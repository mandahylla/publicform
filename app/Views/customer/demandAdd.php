<?= $this->extend('layouts/main'); ?>
<?= $this->section('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/dropzone.min.css" />
    <style> 
        /* .parentClass{
            position: relative;
        } */

        /* .child1 {
            position: absolute;
            width: inherit;
            height: inherit;
        } */

        .popup {
            /* display: none; */
            width: 300px;
            /* s */
        }

        .drop-section{
            min-height: 250px;
            border: 1px dashed #A8B3E3;
            background-image: linear-gradient(180deg, white, #F1F6FF);
            margin: 5px 35px 35px 35px;
            border-radius: 12px;
            position: relative;
        }     

        .drop-section div.col:first-child{
            opacity: 1;
            visibility: visible;
            transition-duration: 0.2s;
            transform: scale(1);
            width: 200px;
            margin: auto;
        }

        .drop-section div.col:last-child{
            font-size: 40px;
            font-weight: 700;
            color: #c0cae1;
            position: absolute;
            top: 0px;
            bottom: 0px;
            left: 0px;
            right: 0px;
            margin: auto;
            width: 200px;
            height: 55px;
            pointer-events: none;
            opacity: 0;
            visibility: hidden;
            transform: scale(0.6);
            transition-duration: 0.2s;
        }
        .drop-section .cloud-icon{
            margin-top: 25px;
            margin-bottom: 20px;
        }
        .drop-section span,
        .drop-section button{
            display: block;
            margin: auto;
            color: #707EA0;
            margin-bottom: 10px;
        }
        .drop-section button{
            color: white;
            background-color: #5874C6;
            border: none;
            outline: none;
            padding: 7px 20px;
            border-radius: 8px;
            margin-top: 20px;
            cursor: pointer;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
        }
        .drop-section input{
            display: none;
        }
        /* we will use "drag-over-effect" class in js */
        .drag-over-effect div.col:first-child{
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: scale(1.1);
        }
        .drag-over-effect div.col:last-child{
            opacity: 1;
            visibility: visible;
            transform: scale(1);
        }
        .list-section{
            display: none;
            text-align: left;
            margin: 0px 35px;
            padding-bottom: 20px;
        }
        .list-section .list-title{
            font-size: 0.95rem;
            color: #707EA0;
        }
        .list-section li{
            display: flex;
            margin: 15px 0px;
            padding-top: 4px;
            padding-bottom: 2px;
            border-radius: 8px;
            transition-duration: 0.2s;
        }
        .list-section li:hover{
            box-shadow: #E3EAF9 0px 0px 4px 0px, #E3EAF9 0px 12px 16px 0px;
        }
        .list-section li .col{
            flex: .1;
        }
        .list-section li .col:nth-child(1){
            flex: .15;
            text-align: center;
        }
        .list-section li .col:nth-child(2){
            flex: .75;
            text-align: left;
            font-size: 0.9rem;
            color: #3e4046;
            padding: 8px 10px;
        }
        .list-section li .col:nth-child(2) div.name{
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            max-width: 250px;
            display: inline-block;
        }
        .list-section li .col .file-name span{
            color: #707EA0;
            float: right;
        }
        .list-section li .file-progress{
            width: 100%;
            height: 5px;
            margin-top: 8px;
            border-radius: 8px;
            background-color: #dee6fd;
        }
        .list-section li .file-progress span{
            display: block;
            width: 0%;
            height: 100%;
            border-radius: 8px;
            background-image: linear-gradient(120deg, #6b99fd, #9385ff);
            transition-duration: 0.4s;
        }
        .list-section li .col .file-size{
            font-size: 0.75rem;
            margin-top: 3px;
            color: #707EA0;
        }
        .list-section li .col svg.cross,
        .list-section li .col svg.tick{
            fill: #8694d2;
            background-color: #dee6fd;
            position: relative;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
        }
        .list-section li .col svg.tick{
            fill: #50a156;
            background-color: transparent;
        }
        .list-section li.complete span,
        .list-section li.complete .file-progress,
        .list-section li.complete svg.cross{
            display: none;
        }
        .list-section li.in-prog .file-size,
        .list-section li.in-prog svg.tick{
            display: none;
        }
    </style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <h1 class="h3 mb-3"><strong><?= $title; ?></strong> </h1>
    <div class="card operande">
        <div class="card-header">
            <h5 class="card-title mb-0">Ouvrir une nouvelle demande </h5>
        </div>        
        <form action="<?= base_url('demand'); ?>" id="demandForm" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <?= view('customer/include/demand_form') ; ?>
            </div>
        </form>        
        <div id="testid"></div>
    </div>

    <div class="modal fade" id="uploadFormModal"  tabindex="-1" aria-labelledby="uploadFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadFormModalLabel">Joindre un fichier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card-head">
                <span>&nbsp; Demande de : <span id="autor" class="h6"></span> </span> 
            </div>
            <form action="<?= base_url('uploadFile/add'); ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="m-sm-5">
                        <h5 class="card-title mb-0">Ajouter un nouveau fichier </h5>
                        <div class="mb-3">
                        <input type="hidden" name="demandId" value="<?= (!empty($demand)? $demand['demandID']:'') ; ?>" id="demandId" >
                        </div>
                        <div class="mb-3"> <label class="form-label" for="inputDocType">Document à Ajouter</label>
                            <select name="inputDocType" id="inputDocType" class="form-control form-control-lg form-select form-select-lg" disabled>
                                  <option value="1">Passeport (page photo)</option>
                                  <option value="2">Visa ou équivalent (si exigé)</option>
                                  <option value="3">Titre de Voyage (Billet d'avion)</option>
                                  <option value="4">Image cachet d'entrée</option>
                                  <option value="5" selected>Autres Justificatifs</option>
                            </select>
                        </div>
                        <div class="mb-3" id="otherFileName"></div> 
                        <div class="mb-3">
                            <label class="form-label" for="inputFile">Insérer le fichier</label>
                            <input type="file" class="form-control form-control-lg" name="inputFile" id="inputFile">
                        </div> 
                        <div class="text-center mt-3">
                            <button class="btn btn-lg btn-primary" type="submit">Ajouter le fichier</button>
                        </div>                
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= view('customer/include/demand_formjs'); ?>
<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>

<script>
  
    /*var currentTab = 0; // Current tab is set to be the first tab (0) 
        showTab(currentTab); // Display the current tab

            function showTab(n) { 

                // This function will display the specified tab of the form...          
                var x = document.getElementsByClassName("step");          
                x[n].style.display = "block"; 

                //... and fix the Previous/Next buttons:          
                if (n == 0) {            
                    document.getElementById("prevBtn").style.display = "none";          
                } else {            
                    document.getElementById("prevBtn").style.display = "inline";          
                } 

                if (n == (x.length - 1)) {            
                document.getElementById("nextBtn").innerHTML = "Submit";          
                } else {            
                    document.getElementById("nextBtn").innerHTML = "Next";          
                }

                //... and run a function that will display the correct step indicator:          
                fixStepIndicator(n)        
            }

            function nextPrev(n) { 

                // This function will figure out which tab to display
                var x = document.getElementsByClassName("step");

               // Exit the function if any field in the current tab is invalid:
               if (n == 1 && !validateForm()) return false;          
               
               // Hide the current tab:          
               x[currentTab].style.display = "none";
               
               // Increase or decrease the current tab by 1:          
               currentTab = currentTab + n; 

               // if you have reached the end of the form...          
               if (currentTab >= x.length) {            
                    // ... the form gets submitted:            
                    document.getElementById("signUpForm").submit();            
                    return false;          
                } 

                // Otherwise, display the correct tab:          
                showTab(currentTab);        
            }*/                   

            /*function fixStepIndicator(n) {          
                // This function removes the "active" class of all steps...          
                var i, x = document.getElementsByClassName("stepIndicator");          

                for (i = 0; i < x.length; i++) {            
                    x[i].className = x[i].className.replace(" active", "");          
                }          

                //... and adds the "active" class on the current step:          
                x[n].className += " active";        
            }*/
</script>
<?= $this->endSection(); ?>

