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
    <link href="<?= base_url('assets/css/multistep.css') ?>" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet"/>
    <link href="<?= base_url('assets/css/intlTelInput.min.css')?>" rel="stylesheet"/>
    <style>
        .text-orange{
            color: #eb5f48;
        }
        .text-orange:hover,
        .text-orange:focus{            
            color: #f7b52f;
        }
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }
      input[type="number"] {
        -moz-appearance: textfield;
      }
      input[type="number"]:hover,
      input[type="number"]:focus {
        -moz-appearance: number-input;
      }
      .lead{
        color: #f7b52f;
      }
      .input1{
        border-right: none;
     }
     .input2{
        border-left: none;
        margin-left: -4px;
     }
    </style>
    <style>
        body {
            background-image: url('<?= base_url('assets/img/fondecran.jpg') ?>');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: bottom;
        }
    </style>	
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->    
    <script src="<?= base_url('assets/js/intlTelInput.min.js') ?>"></script>
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-7 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">                        
                        <div class="text-center mt-4">
                            <h1 class="h3">Demande de Dotation en Devise <br> de Carte Monétique</h1>
                            <h1 class="h1">Bienvenue !</h1>
                            <p class="lead">
                                Inscription
                            </p>
                        </div>
                        <div class="card">                                                    
                            <div class="card-body">                                
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="<?= base_url('assets/img/logos/logo-1.png') ?>" alt="Crédit du Congo Logo" class="img-fluid" width="252" height="252" />
                                    </div>
                                    <?= $this->include('common/alerts'); ?>
                                    <form action="<?= base_url('register'); ?>" id="signUpForm" method="POST">
                                        <!-- start step indicators -->
                                        <div class="form-header d-flex mb-4">
                                            <span class="stepIndicator">Informations Personnelles</span>
                                            <span class="stepIndicator">Inscription</span>
                                            
                                        </div>
                                        <!-- end step indicators --> 
                                        <!-- step one --> 
                                        <div class="step">
                                            <p class="lead text-center mb-4">Informations Personnelles</p>
                                            <div class="mb-3">
                                                <label class="form-label">Nom complet</label>
                                                <input class="form-control form-control-lg" type="text" oninput="this.className = ''" value="<?= set_value('inputFullname'); ?>"  name="inputFullname" placeholder="Entrer votre nom et prénom" required />
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputTel" class="form-label">Téléphone (WhatsApp)</label>
                                                <input class="form-control form-control-lg" type="tel" id="inputTel" oninput="this.className = ''" value="<?= set_value('inputTel'); ?>" name="inputTel" placeholder="Entrer un numéro valide sur WhatsApp" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">N° Compte Bancaire</label><br/>
                                                <!-- <input class="form-control form-control-lg" oninput="this.className = ''" value="<?//= set_value('inputBa'); ?>" type="number" maxlength="14" id="inputBa" name="inputBa" placeholder="30001-000xx-xxxxxxxxxx-xx" required /> -->
                                                <input style="width:70px" type="text" class="fixed-value input1" name="inputBa1" value="30011" readonly> -
                                                <input style="width:70px" type="number" class="fixed-value input1" name="inputBa2" oninput="changeClass()" id="inputBa2"  value="<?= set_value('inputBa2')? set_value('inputBa2'):'000'; ?>" placeholder="000XX"> - 
                                                <input style="width:115px" type="number" name="inputBa3"  value="<?= set_value('inputBa3')? set_value('inputBa3'):''; ?>" oninput="changeClass()" class="fixed-value input1" placeholder="XXXXXXXXXX"> -
                                                <input style="width:45px" type="number" class="fixed-value input1" name="inputBa4" oninput="changeClass()"  value="<?= set_value('inputBa4')? set_value('inputBa4'):''; ?>" placeholder="XX">
                                                <br/>
                                                <span id="formate"></span>
                                            </div>                                            
                                        </div>                                       
                                        <!-- step two -->
                                        <div class="step">
                                            <p class="lead text-center mb-4">Inscription</p>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input class="form-control form-control-lg" type="email" oninput="this.className = ''" value="<?= set_value('inputEmail'); ?>" name="inputEmail" placeholder="Entrer votre email" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Mot de Passe (6 caractères minimum)</label>
                                                <input class="form-control form-control-lg" oninput="this.className = ''" type="password" name="inputPassword" placeholder="Entrer un mot de passe" required />
                                            </div>                          
                                            <div class="mb-3">
                                                <label class="form-label">Répéter Mot de Passe</label>
                                                <input class="form-control form-control-lg" oninput="this.className = ''" type="password" name="inputPassword2" placeholder="Repéter le mot de passe" required />
                                            </div>
                                            <div class="mb-3">
                                                <label for="InputAgree" class="form-check-label">
                                                    <a class="text-orange" href="<?= base_url('conditions'); ?>">J'accepte les termes et conditions</a>&nbsp;
                                                    <input class="form-check-input" type="checkbox" oninput="this.className = 'form-check-input'" value="agree" name="InputAgree" id="InputAgree">
                                                </label> 
                                            </div>
                                        </div>
                                        <!-- start previous / next buttons -->
                                        <div class="form-footer d-flex">
                                            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Précédent</button>
                                            <button type="button" id="nextBtn" onclick="nextPrev(1)">Suivant</button>
                                        </div>
                                        <!-- end previous / next buttons -->
                                    </form>
                                </div>                            
                            </div>
                        </div>                        
                        <div class="text-center mb-3">
                            <span style="color:antiquewhite;">Déjà inscrit(e)</span> | <a style="color:antiquewhite;" href="<?= base_url()?>">Se connecter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script>

    const input = document.querySelector("#inputTel");

    /*input.addEventListener("countrychange", function() {
        $('#phone').val()
    });*/
        // let result  = "";
        /* $('input#inputBa').keyup(function(){
            // var val = $("input.input1").val()
            var current = $(this).val();
            
            console.log(current.length);
            if(current.length == 5) result = current + '-';
            if(current.length == 10) result = current + '-';
            if(current.length == 20) result = current + '-';

             result = result + current;            

            $("#formate").html(result)
        }); */
        function changeClass() {
            var elements = document.getElementsByClassName('input1');
            for (var i = 0; i < elements.length; i++) {
                if(elements[i].classList.contains('is-invalid'))
                {
                    elements[i].classList.remove('invalid');
                    elements[i].classList.remove('is-invalid');
                }
            }            
        }

        $('.input1').keyup(function(){
            // val = $("input.input1").val();
            var current = $(this).val();

            if(($(this).attr('name') == 'inputBa2') && (current.length > 5)) 
            {
                var todel = 5-current.length
                $(this).val(current.slice(0, todel));
                $(this).blur(); 
                $(this).next("input").focus();
            }

            if(($(this).attr('name') == 'inputBa3') && (current.length > 10)) 
            {
                var todel = 10-current.length
                $(this).val(current.slice(0, todel));
                $(this).blur(); 
                $(this).next("input").focus();
            }

             if(($(this).attr('name') == 'inputBa4') && (current.length > 2)) 
            {
                var todel = 2-current.length
                $(this).val(current.slice(0, todel));
                $(this).blur(); 
            }
        });

    window.intlTelInput(input, {
      initialCountry: "auto",
      separateDialCode: true,
      preferredCountries: ["cg"],
      excludeCountries: ["eh"],
      geoIpLookup: callback => {
        fetch("https://ipapi.co/json")
          .then(res => res.json())
          .then(data => callback(data.country_code))
          .catch(() => callback("us"));
      },
      utilsScript: "/intl-tel-input/js/utils.js?1687509211722" // just for formatting/placeholders etc
    });

  var currentTab = 0; // Current tab is set to be the first tab (0) 
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
                    document.getElementById("nextBtn").innerHTML = "S'Inscrire";          
                } else {            
                    document.getElementById("nextBtn").innerHTML = "Suivant";          
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
            } 
            
            function clearInvalidClass(i){

                let rdiv = document.getElementsByClassName('cl'+i);

                if (rdiv.length > 0 ) {

                    rdiv[0].remove();
                }
            }

            function validateForm() {

                // This function deals with validation of the form fields          
                var x, y, i, valid = true;          
                x = document.getElementsByClassName("step");          
                y = x[currentTab].getElementsByTagName("input");

                const invInputs = document.getElementsByClassName('invalid');
                
                // A loop that checks every input field in the current tab:          
                for (i = 0; i < y.length; i++) {  

                    // If a field is empty...            
                    if (y[i].value == "") {                        
                        if((y[i].name === 'inputBa2') ^ (y[i].name === 'inputBa3') ^ (y[i].name === 'inputBa4')){

                            var elements = document.getElementsByClassName('input1');
                            // add an "invalid" class to the field:                       
                            for (var j = 0; j < elements.length; j++) {                               
                                elements[j].className += " invalid is-invalid";                               
                            } 
                        }    
                        else if (invInputs.length == i) {
                            // add an "invalid" class to the field:
                            y[i].className += " invalid is-invalid";
                            var para = document.createElement('div');
                            para.className += " invalid-feedback";
                            para.className += " cl"+i;
                            para.textContent = 'Ce champ ne peut-être vide';
                            y[i].after(para);
                        }                                               

                        // and set the current valid status to false
                        valid = false;
                    }
                    else if(y[i].type == 'tel' )
                    {
                        let tel = y[i].value;
                        if(!tel.match(/^\+?([0-9] ?){9,20}$/))
                        {
                            clearInvalidClass(i);
                           // add an "invalid" class to the field:
                            y[i].className += " invalid is-invalid";
                            var para = document.createElement('div');
                            para.className += " invalid-feedback";                            
                            para.className += " cl"+i;
                            para.textContent = 'Entrez un numéro de téléphone valide';
                            y[i].after(para);

                            valid = false;
                        } 
                    }
                    else if(y[i].name == 'inputEmail' )
                    {
                        let inputVal = y[i].value;
                        // Expression régulière pour valider une adresse e-mail
                        var emailRegex = /^[A-Za-z0-9._+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
                        if(!inputVal.match(emailRegex))
                        {
                            clearInvalidClass(i);
                           // add an "invalid" class to the field:
                            y[i].className += " invalid is-invalid";
                            var para = document.createElement('div');
                            // para.className += "row";
                            para.className += " invalid-feedback";                            
                            para.className += " cl"+i;
                            para.textContent = 'Cette adresse email est invalide';
                            y[i].after(para);

                            valid = false;
                        } // la suite aujourd'hui
                    }
                    else if(y[i].name == 'inputPassword' )
                    {
                        let inputVal = y[i].value;
                        if(inputVal.length < 6)
                        {
                            clearInvalidClass(i);
                           // add an "invalid" class to the field:
                            y[i].className += " invalid is-invalid";
                            var para = document.createElement('div');
                            // para.className += "row";
                            para.className += " invalid-feedback";                            
                            para.className += " cl"+i;
                            para.textContent = 'Il faut minimum six (6) caractères';
                            y[i].after(para);

                            valid = false;
                        } // la suite aujourd'hui
                    }
                    else if(y[i].name == 'inputPassword2' )
                    {
                        let inputVal = y[i].value;
                        console.log(inputVal);
                        let pass = document.getElementsByName('inputPassword')[0].value;
                        console.log(pass);
                        if(!(inputVal === pass))
                        {
                            clearInvalidClass(i);
                           // add an "invalid" class to the field:
                            y[i].className += " invalid is-invalid";
                            var para = document.createElement('div');
                            // para.className += "row";
                            para.className += " invalid-feedback";                            
                            para.className += " cl"+i;
                            para.textContent = 'Ce mot de passe ne correspond pas au premier';
                            y[i].after(para);

                            valid = false;
                        } // la suite aujourd'hui
                    }
                    else if(y[i].name == 'InputAgree' )
                    {
                        let inputVal = y[i].value;
                        
                        if(!y[i].checked)
                        {
                            clearInvalidClass(i);
                           // add an "invalid" class to the field:
                            y[i].className += " invalid is-invalid";
                            var para = document.createElement('div');
                            para.className += "row";
                            para.className += " invalid-feedback";                            
                            para.className += " cl"+i;
                            para.textContent = 'Vous devez accepter ces termes et conditions avant de continuer';
                            y[i].after(para);

                            valid = false;
                        } // la suite aujourd'hui
                    }
                    else if((y[i].name === 'inputBa2') ^ (y[i].name === 'inputBa3') ^ (y[i].name === 'inputBa4'))
                    {
                        let bc = $("input[name='inputBa1']").val() + $("input[name='inputBa2']").val() + $("input[name='inputBa3']").val() + $("input[name='inputBa4']").val();
                                               
                        if(bc.length < 22) //!bc.match(/^[0-9]{22}$/)
                        {   
                            var spanElement = document.getElementById('formate');                            
                            var nextElement = spanElement.nextElementSibling; 

                            if (nextElement && nextElement.tagName.toLowerCase() === 'div') {
                               
                                nextElement.remove();
                            }

                             clearInvalidClass(i);
                            y[i].classList.remove("is-invalid") ;
                            y[i].classList.remove("invalid") ;
                            
                            var elements = document.getElementsByClassName('input1');
                            // add an "invalid" class to the field:                       
                            for (var j = 0; j < elements.length; j++) {                               
                                elements[j].className += " invalid is-invalid";                               
                            }                            
                            var para = document.createElement('div');
                            para.className += " invalid-feedback";                            
                            para.className += " cl"+i;
                            para.textContent = 'Vous devez entrer un compte valide (22 chiffres)';
                            $('#formate').after(para);

                            valid = false;
                        } // la suite aujourd'hui                        
                    }
                }          

                // If the valid status is true, mark the step as finished and valid:          
                if (valid) {            
                    document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";          
                }          

                return valid; // return the valid status        
            }                

            function fixStepIndicator(n) {          
                // This function removes the "active" class of all steps...          
                var i, x = document.getElementsByClassName("stepIndicator");          

                for (i = 0; i < x.length; i++) {            
                    x[i].className = x[i].className.replace(" active", "");          
                }          

                //... and adds the "active" class on the current step:          
                x[n].className += " active";        
            }
</script>
</html>