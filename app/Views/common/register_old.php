<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="Gheav">
    <meta name="keywords" content="Gheav, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com"/>
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <title>CDCO - Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"/>
    <link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet"/>    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet"/>
    <link href="<?= base_url('assets/css/intlTelInput.css') ?>" rel="stylesheet"/>

    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <script src="<?= base_url('assets/js/intlTelInput.js') ?>"></script>
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-9 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <?= $this->include('common/alerts'); ?>
                        <div class="text-center mt-4">
                            <h1 class="h3">Activation des plafonds des cartes<br /> hors zone CEMAC</h1>
                            <h1 class="h1">Bienvenue !</h1>
                            <p class="lead">
                                1ère Demande et Inscription
                            </p>
                        </div>

                        <div class="card">                            
                            <div class="card-body">                                
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="<?= base_url('assets/img/logos/logo-1.png') ?>" alt="Crédit du Congo Logo" class="img-fluid" width="252" height="252" />
                                    </div>
                                    <form action="<?= base_url('register'); ?>" method="POST">  
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Nom complet</label>
                                                <input class="form-control form-control-lg" type="text" value="<?= set_value('inputFullname'); ?>"  name="inputFullname" placeholder="Entrer votre nom et prénom" required />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Email</label>
                                                <input class="form-control form-control-lg" type="email" value="<?= set_value('inputEmail'); ?>" name="inputEmail" placeholder="Entrer votre email" required />
                                            </div>                                            
                                        </div>
                                        <div class="row"> 
                                        <div class="mb-3 col-md-6">
                                                <label class="form-label">Téléphone (WhatsApp)</label>
                                                <input class="form-control form-control-lg" type="tel" value="<?= set_value('inputTel'); ?>" name="inputTel" placeholder="Entrer un numéro valide sur WhatsApp" required /><span class="validity"></span>
                                                <!-- <span id="valid-msg" class=" visually-hidden hide">✓ Valid</span>
                                                <span id="error-msg" class="hide visually-hidden"></span> -->
                                            </div>                                           
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Compte Bancaire</label>
                                                <input class="form-control form-control-lg" value="<?= set_value('inputBa'); ?>" type="number" name="inputBa" placeholder="Entrer votre numéro compte" required />
                                            </div>                                                                          
                                        </div>
                                        <div class="row">      
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputBcType">Type de carte</label>
                                                <select name="inputBcType" id="inputBcType" class="form-control" required>                                     
                                                    <option class="form-control form-control-lg" value="Gold">Gold</option>
                                                    <option class="form-control form-control-lg" value="Privilège">Privilège</option>
                                                    <option class="form-control form-control-lg" value="Elite">Elite</option>                                 
                                                </select>
                                            </div> 
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputBcnum">Numéro de la carte Bancaire</label>
                                                <input type="number" class="form-control form-control-lg" name="inputBcnum" id="inputBcnum" placeholder="Entre uniquement les 4 derniers chiffres de la carte"  required>
                                            </div>                                                                                
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="inputDobt">Date Début Voyage</label>
                                                <input type="date" class="form-control form-control-lg" name="inputDobt" id="inputDobt" placeholder="Entrer la date de départ de voyage" required>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="inputDoet">Date fin de voyage</label>
                                                <input type="date" class="form-control form-control-lg" name="inputDoet" id="inputDoet" placeholder="Entrer la date de votre retour" required>
                                            </div>  
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="inputDestination">Pays</label>
                                                <input type="text" class="form-control form-control-lg" name="inputCountry" id="inputCountry" required>
                                            </div>                                                                                 
                                        </div> 
                                        <div class="row">
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="inputVisaScan">Scan Visa</label>
                                                <input type="file" class="form-control form-control-lg" name="inputVisaScan" id="inputVisaScan">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="inputPassportScan">Scan du passeport</label>
                                                <input type="file" class="form-control form-control-lg" name="inputPassportScan" id="inputPassportScan">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="inputTicketScan">Scan du billet d'avion</label>
                                                <input type="file" class="form-control form-control-lg" name="inputTicketScan" id="inputTicketScan">
                                            </div>                                      
                                        </div>                                       
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Mot de Passe</label>
                                                <input class="form-control form-control-lg" type="password" name="inputPassword" placeholder="Entrer un mot de passe" required />
                                            </div>                          
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Répéter Mot de Passe</label>
                                                <input class="form-control form-control-lg" type="password" name="inputPassword2" placeholder="Repéter le mot de passe" required />
                                            </div>                     
                                        </div>
                                   
                                        <div class="ms-4">
                                            <label class="form-check">
                                                <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
                                                <span class="form-check-label">
                                                    J'accepte les termes et conditions
                                                </span>
                                            </label>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">S'inscrire</button>
                                        </div>
                                    </form>
                                </div>                            
                            </div>
                        </div>                        
                        <div class="text-center mb-3">
                            Je suis déjà inscrit(e) | <a href="<?= base_url() ?>">Se connecter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script>
      var input = document.querySelector("#inputTel");
      window.intlTelInput(input, {
        utilsScript: "<?= base_url('assets/js/utils.js') ?>?1687509211722";
      });
    </script>
</html>