<?= $this->extend('layouts/main'); ?>
		<?= $this->section('content'); ?>
		<h1 class="h3 mb-3"><strong><?= $title; ?></strong> </h1>
		<div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">	Formulaire de demande </h5>
            </div>
            <div class="card-body">
            	<?= $this->include('common/alerts'); ?>
                    <div class="card">
                        <form action="<?= base_url('createDemands'); ?>" method="post"> 
                        	<div class="card-body">
                        		<div class="m-sm-5">
                        			<div class="mb-3">
	                                    <label class="form-label" for="inputDobt">Date Début Voyage</label>
	                                    <input type="date" class="form-control form-control-lg" name="inputDobt" id="inputDobt" required>
	                                </div> 
	                                <div class="mb-3">
	                                    <label class="form-label" for="inputDoet">Date fin de voyage</label>
	                                    <input type="date" class="form-control form-control-lg" name="inputDoet" id="inputDoet" required>
	                                </div>
	                                <div class="mb-3">
			                            <label class="form-label" for="inputStatus">Formule de votre carte</label>
			                            <select name="inputStatus" id="inputStatus" class="form-control" required>		                               
		                                    <option class="form-control form-control-lg" value="Gold">Gold</option>
		                                    <option class="form-control form-control-lg" value="Privilège">Privilège</option>
		                                    <option class="form-control form-control-lg" value="Elite">Elite</option>	                              
			                            </select>
			                        </div> 
	                                <div class="mb-3">
	                                    <label class="form-label" for="inputBcnum">Numéro de la carte Bancaire</label>
	                                    <input type="number" class="form-control form-control-lg" name="inputBcnum" id="inputBcnum" required>
	                                </div>	                                 
                						<h5 class="card-title mb-0">Lieu de Destination </h5>            							
	                                <div class="mb-3">
	                                    <label class="form-label" for="inputDestination">Pays</label>
	                                    <input type="text" class="form-control form-control-lg" name="inputCountry" id="inputCountry" required>
	                                </div>	                                
	                                <div class="mb-3">
	                                    <label class="form-label" for="inputDestination">Ville</label>
	                                    <input type="text" class="form-control form-control-lg" name="inputTown" id="inputTown" required>
	                                </div>                                
	                                <div class="mb-3">
	                                    <label class="form-label" for="inputVisaScan">Scan Visa</label>
	                                    <input type="file" class="form-control form-control-lg" name="inputVisaScan" id="inputVisaScan" required>
	                                </div> 
	                                <div class="mb-3">
	                                    <label class="form-label" for="inputPassportScan">Scan du passeport</label>
	                                    <input type="file" class="form-control form-control-lg" name="inputPassportScan" id="inputPassportScan" required>
	                                </div> 
	                                <div class="mb-3">
	                                    <label class="form-label" for="inputTicketScan">Scan du billet d'avion</label>
	                                    <input type="file" class="form-control form-control-lg" name="inputTicketScan" id="inputTicketScan" required>
	                                </div>   
	                                <div class="text-center mt-3">
	                                    <button class="btn btn-lg btn-primary" type="submit">Envoyer</button>
	                                </div>
                        		</div>                            		
                        	</div>                                
                        </form>
                    </div>
            </div>
        </div>
		<?= $this->endSection(); ?>
		