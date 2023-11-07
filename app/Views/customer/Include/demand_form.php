<div class="m-sm-5">
    <?= (!empty($demand) AND ($demand['demandID']))? '<input type="hidden" name="demandId" value="'.$demand['demandID'].'">':''; ?>
    <!-- step one -->
    <div class="step">
        <p class="lead text-center mb-4">Information sur le Voyage</p>
        <div class="mb-3">
            <label class="form-label" for="inputDobt">Date de départ (Indiquée sur le titre de voyage)</label>
            <input type="date" class="form-control form-control-lg inputdate" onfocus="changeClass()" value="<?= (!empty($demand) AND ($demand['dobt']))? $demand['dobt'] : set_value('inputDobt'); ?>" min="<?= !empty($now)? $now->toDateString():'' ?>" name="inputDobt" id="inputDobt" placeholder="Entrer la date de départ de voyage" required>
        </div>

        <div class="mb-3">
            <label class="form-label" for="inputDoet">Date de retour (Indiquée sur le titre de voyage)</label>
            <input type="date" class="form-control form-control-lg inputdate" onfocus="changeClass()" value="<?= (!empty($demand) AND ($demand['doet']))? $demand['doet'] : set_value('inputDoet'); ?>" min="<?= !empty($doe)? $doe->toDateString():'' ?>" name="inputDoet" id="inputDoet" placeholder="Entrer la date de votre retour" required>
        </div>  
        <div class="mb-3">
            <label class="form-label" for="inputCountry">Destination (1ère destination si plusieurs voyages)</label>                                
            <select name="inputCountry" id="inputCountry" class="form-select form-select-lg" required>
            <?php foreach($countries as $country) :?>    
                <option value="<?= $country['code'] ;?>" <?=  (!empty($demand) AND ($demand['destination'] === $country['code']))? 'selected' : set_select('inputCountry', $country['code'], False); ?>><?= $country['name'] ;?></option>
            <?php endforeach ;?>
            </select>
        </div> 
        <div class="mb-3">
            <label class="form-label" for="inputStP">Motif de Séjour</label>
            <select name="inputStP" id="inputStP" class="form-select form-select-lg" required>
            <?php foreach($purposes as $key => $purpose) :?>    
                <option value="<?= $key ;?>" <?=  set_select('inputStP', $key, False); ?>><?= $purpose ;?></option>
            <?php endforeach ;?>
            </select>
        </div> 
        <div class="mb-3">
            <label class="form-label">N° Passeport</label>
            <?php if(\Config\Services::validation()->getError('inputPasspNum')) :?>                                                    
            <input type="text" class="form-control form-control-lg is-invalid" onfocus="this.className = 'form-control form-control-lg'" value="<?= set_value('inputPasspNum'); ?>" name="inputPasspNum" id="inputPasspNum" required>
            <div class="invalid-feedback"><?= \Config\Services::validation()->getError('inputPasspNum'); ?>.</div>
            <?php else : ?>  
            <input type="text" class="form-control form-control-lg"  onfocus="this.className = 'form-control form-control-lg'" value="<?= (!empty($demand) AND ($demand['passport_num']))? $demand['passport_num'] : set_value('inputPasspNum') ?>" name="inputPasspNum" id="inputPasspNum" required>  
            <?php endif; ?>
            
        </div>
        <div class="mb-3">
            <label class="form-label" for="inputDov">Valable jusqu'au</label>
            <input type="date" class="form-control form-control-lg" name="inputDov" onfocus="this.className = 'form-control form-control-lg' " value="<?= (!empty($demand) AND ($demand['passport_date']))? $demand['passport_date'] : set_value('inputDov'); ?>" id="inputDov" min="<?= !empty($dov)? $dov->toDateString():'' ?>" placeholder="Entrer la date de votre retour" required>
        </div>                            
    </div>
    <!-- step two -->
    <div class="step parentClass"> 
        <p class="lead text-center mb-4">Information de la Carte</p>
        <div class="mb-3 child1">
            <label class="form-label" for="inputBcType">Type de carte</label>
            <select name="inputBcType" id="inputBcType" class="form-select form-select-lg" required>
            <?php foreach($bc_types as $key => $bc_type) :?>    
                <option value="<?= $key ;?>" <?= (!empty($demand) AND ($demand['bc_type'] === $key))? 'selected': set_select('inputBcType', $key, False); ?>><?= $bc_type ;?></option>
            <?php endforeach ;?>
            </select>
        </div>
        <div class="popup"><img src="<?= base_url('assets/img/bc_visa.jpg') ?>" alt="carte visa" width="300" height="189" ></div>
        <div class="mb-3">
            <label class="form-label" for="inputBcnum">Numéro de la Carte Bancaire <br> (Entrer uniquement les 4 derniers chiffres de la carte)</label>                                
            <a href="" class="gfg"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info align-middle me-2">
                <circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg></a>                     
            <?php if(!empty($errors) AND $errors->getError('inputBcnum')) :?>                     
            <input type="number" class="form-control form-control-lg is-invalid" value="<?= (!empty($demand) AND ($demand['bcnum']))? $demand['bcnum']:set_value('inputBcnum'); ?>" name="inputBcnum" id="inputBcnum" placeholder="" required>
            <div class="invalid-feedback"><?= $errors->showError('inputBcnum','checkDigit'); ?>.</div>
            <?php else : ?>  
            <input type="number" class="form-control form-control-lg"  onfocus="this.className = 'form-control form-control-lg'" value="<?= (!empty($demand) AND ($demand['bcnum']))? $demand['bcnum'] : set_value('inputBcnum') ?>" max="9999" name="inputBcnum" id="inputBcnum" placeholder="" required>  
            <?php endif; ?> 
        </div>
        <div class="mb-3">
            <label class="form-label" for="inputBcDov">Valable jusqu'au</label>
            <input type="date" class="form-control form-control-lg" name="inputBcDov" onfocus="this.className = 'form-control form-control-lg' " value="<?= (!empty($demand) AND ($demand['bcdov']))? $demand['bcdov'] : set_value('inputBcDov'); ?>" id="inputBcDov" placeholder="Date de validité de votre carte" required>
        </div> 
        <div class="mb-3">
            <label class="form-label" for="inputBcForm">Répartition de la dotation en dévise</label>                            
            <select name="inputBcForm" id="inputBcForm" class="form-select form-select-lg" required>
            <?php foreach($formulas as $key => $formula) :?>    
                <option value="<?= $key ;?>" <?= (!empty($demand) AND ($demand['bc_formula'] === $key))? 'selected' : set_select('inputBcType', $key, False); ?>><?= $formula ;?></option>
            <?php endforeach ;?>
            </select>                            
        </div>
    </div> 
    
    <!-- step two -->
    <div class="step">         
        <?php if(!empty($demand) AND ($demand['demandID'])): ?>
        <div class="mb-3"> 
            <p class="lead text-center mb-4">Fichiers Joints</p>
            <div>                                
                <a href="#" title="Joindre un fichier" id="upload" class="btn btn-outline-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#uploadFormModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip align-middle"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>          
                </a>                                
            </div>                        
                                    
            <?php if(!empty($uploads)): ?>
                <ul class="list-group">
                    <?php $counter = 1;
                        foreach($uploads as $upload) : ?>
                    <li class="mb-2 list-group-item">
                        <span><?php echo $upload['doc_type'] ?></span> |
                        <a href="<?= base_url('assets/uploads/'.$upload['file_name']); ?>" class="btn btn-primary btn-sm" target=”_blank”>lien du document</a> 

                        <a href="<?= base_url('uploadFile/delete');?>" id="<?= $upload['id']; ?>" class="btn btn-outline-danger btn-sm float-end delete_up">X</a>                      
                    </li>  
                <?php $counter++;
                        endforeach; ?> 
                </ul>                                                                   
            <?php endif; ?>    
        </div> 
        <?php else : ?>
        <p class="lead text-center mb-4">Fichier joint</p>
        <div class="mb-3">
            <label class="form-label" for="inputPassportScan"> Scan des données personnelles du passeport (fichier *.jpg,*.png ou *.pdf)</label>
            <input type="file" class="form-control form-control-lg" onfocus="this.className = 'form-control form-control-lg' " name="inputPassportScan" id="inputPassportScan" required>
        </div>                            
        <div class="mb-3">
            <label class="form-label" for="inputVisaScan">Scan Visa si exigé (fichier *.jpg,*.png ou *.pdf)</label>
            <input type="file" class="form-control form-control-lg" onfocus="this.className = 'form-control form-control-lg' " name="inputVisaScan" id="inputVisaScan" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="inputTicketScan">Scan du billet d'avion (fichier *.jpg,*.png ou *.pdf)</label>
            <input type="file" class="form-control form-control-lg" onfocus="this.className = 'form-control form-control-lg' " name="inputTicketScan" id="inputTicketScan" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="inputOtherScan">Autres Justificatifs (fichier *.jpg,*.png ou *.pdf)</label>
            <input type="file" class="form-control form-control-lg" name="inputOtherScan[]" id="inputOtherScan" multiple>
        </div>
        <?php endif; ?> 
        <div class="mb-3">
            <label for="InputAgree" class="form-check-label">
                <span> En validant : </span><br/>
                <span> 1 - J'atteste sur l'honneur la validité des données transmis</span><br/>
                <span> 2 - J'autorise la banque à prélever sur mon compte la somme de 10 000frs CFA dès traitement de ma demande</span><br/>
                <span> 3 - J'autorise la banque à détenir mes données</span><br/>
                <!-- <a class="text-orange" href="<?//= base_url('conditions'); ?>">J'accepte les termes et conditions</a>&nbsp; -->
                <!-- <input class="form-check-input" type="checkbox" oninput="this.className = 'form-check-input'" value="agree" name="InputAgree" id="InputAgree"> -->
            </label> 
        </div>
        <div class="text-center mb-6">
            <button class="btn btn-block btn-primary" type="submit" id="send-btn"><?= (!empty($demand))? 'Modifier' : 'Envoyer'?></button>
        </div>                               
    </div>
</div>
