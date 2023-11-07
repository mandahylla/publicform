<script>
$(document).ready(function () 
{
    $('#send-btn').click( function(){
        event.preventDefault();
        validateForm();
    });

    function validateForm() {
        // This function deals with validation of the form fields          
        var x, y, i, valid = true;   
        x = document.getElementById('demandForm');                 
        y = x.getElementsByTagName("input");

        // A loop that checks every input field in the current tab:          
        for (i = 0; i < y.length; i++) {  

            // If a field is empty...            
            if (y[i].value == "") {
                if(y[i].id === 'inputOtherScan'){}
                else{
                    var nextel = y[i].nextElementSibling;
                    if(nextel && nextel.getElementsByClassName('invalid-feedback')) {nextel.remove() ;}
                    // add an "invalid" class to the field:
                    y[i].className += " is-invalid";
                    var para = document.createElement('div');
                    para.className += " invalid-feedback";
                    para.className += " cl"+i;
                    para.textContent = 'Ce champ ne peut-être vide';
                    y[i].after(para);
                    // and set the current valid status to false
                    valid = false;
                }

            }
			else if(y[i].name == 'inputDobt' )
            {
            <?php if(empty($demand)):?>
                var inputdobt  = $('#inputDobt') ;
                var dobt       = new Date($('#inputDobt').val()) ;
                var today      = new Date();

                if (dobt.valueOf() < today.valueOf()) {     

                    clear_nextclass(inputdobt,'invalid-feedback');
                        // add an "invalid" class to the field:
                    inputdobt.addClass(" invalid is-invalid") ;
                    var para = "<div class='invalid-feedback'>La date de départ ne peut-être antérieur à la date du jour</div> ";
                    inputdobt.after(para);
                    valid = false;
                }
            <?php endif; ?>
            }
            else if(y[i].name == 'inputDoet' )
            {
                var inputdobt = $('#inputDobt') ;
                var inputdoet = $('#inputDoet');
                var dobt      = new Date($('#inputDobt').val()) ;
                var doet      = new Date($('#inputDoet').val());
                var stp       = $('#inputStP').find(":selected").val();
				var today     = new Date();
               <?php if(empty($demand)):?> 
                if (doet.valueOf() < today.valueOf()) { 
				
					clear_nextclass(inputdoet,'diffo');
                    clear_nextclass(inputdoet,'invalid-feedback');
                        // add an "invalid" class to the field:
                    inputdoet.addClass(" invalid is-invalid") ;
                    var para = "<div class='invalid-feedback'>La date de retour ne peut-être antérieur à la date du jour</div> ";
                    inputdoet.after(para);
                    valid = false;
                }       
               <?php endif; ?>
            //    ajouter la validation du numéro de passport il doit-être alphanumérique
                if (((stp == 10) || (stp == 12) || (stp == 13)) && ((diff_date(dobt,doet) >= 90))){                    
                    
                    clear_nextclass(inputdoet,'diffo');
                    clear_nextclass(inputdoet,'invalid-feedback');
                    // if($('diffo').length > 0 ) {$('diffo').remove() ; console.log('ok !')}
                    // add an "invalid" class to the field:
                    inputdoet.addClass(" invalid is-invalid") ;
                    var para = "<div class='invalid-feedback'>La date de retour ne peut-être supérieur à 90 jours pour ce motif de séjour </div> ";
                    inputdoet.after(para);                    
                    valid = false;
                }

                if (dobt.valueOf() >= doet.valueOf()) {
                
                    clear_nextclass(inputdoet,'invalid-feedback');
                    
                    // clearInvalidClass(i);
                    // add an "invalid" class to the field:
                    inputdoet.addClass(" invalid is-invalid") ;
                    var para = "<div class='invalid-feedback'>La date de retour doit-être supérieur à la date de départ</div> ";
                    inputdoet.after(para);
                    valid = false;
                }                 
            }        
            else if(y[i].name == 'inputDov' )
            {
                var inputdov  = $('#inputDov') ;
                var inputdoet = $('#inputDoet');
                var dov       = new Date($('#inputDov').val()) ;
                var doet      = new Date($('#inputDoet').val());

                if (diff_date(doet,dov) <= 90) {     

                    clear_nextclass(inputdov,'diff');
                    clear_nextclass(inputdov,'invalid-feedback');
                        // add an "invalid" class to the field:
                    inputdov.addClass(" invalid is-invalid") ;
                    var para = "<div class='invalid-feedback'>Votre passeport doit avoir une date de validité supérieur à 90 jours de votre date de retour</div> ";
                    inputdov.after(para);
                    valid = false;
                }       
            }
            else if(y[i].name == 'inputBcnum' )
            {
                var inputbcnum = $('#inputBcnum') ;
                var current    = inputbcnum.val();

                if (current.length > 4) 
                {
                    clear_nextclass(inputbcnum,'invalid-feedback');
                    
                    // clearInvalidClass(i);
                    // add an "invalid" class to the field:
                    inputbcnum.addClass(" invalid is-invalid") ;
                    var para = "<div class='invalid-feedback'>Veuillez entrer 4 chiffres uniquement</div> ";
                    inputbcnum.after(para);
                    valid = false;
                }                 
            } 
            else if(y[i].name == 'inputBcDov' )
            {
                var inputdobt  = $('#inputDobt') ;
                var inputbcdov = $('#inputBcDov');
                var dobt       = new Date($('#inputDobt').val()) ;
                var bcdov      = new Date($('#inputBcDov').val());
                var today      = new Date();

                <?php if(empty($demand)):?> 
                if (bcdov.valueOf() <= today.valueOf()) { 
				
                    clear_nextclass(inputbcdov,'invalid-feedback');
                        // add an "invalid" class to the field:
                    inputdoet.addClass(" invalid is-invalid") ;
                    var para = "<div class='invalid-feedback'>La date de validité de la carte ne peut-être antérieur à la date du jour</div> ";
                    inputdoet.after(para);
                    valid = false;
                }       
               <?php endif; ?>
                
                if (dobt.valueOf() >= bcdov.valueOf()) {
                
                    clear_nextclass(inputbcdov,'invalid-feedback');
                    
                    // clearInvalidClass(i);
                    // add an "invalid" class to the field:
                    inputbcdov.addClass(" invalid is-invalid") ;
                    var para = "<div class='invalid-feedback'>La date de validité de la carte doit-être supérieur à la date de départ</div> ";
                    inputbcdov.after(para);
                    valid = false;
                }                 
            } 
        }          

        // If the valid status is true, mark the step as finished and valid:          
        if (valid) {            
            $('#demandForm').submit();        
        } 
        else {
            event.preventDefault();
        }                
    } 

    let stat1 = $('#inputDocType').find(":selected").val();
        // console.log(stat1)
        if (Number(stat1) === 5) {
            $('#otherFileName').html(
                '<label class="form-label" for="inputOtherName">Entrer le nom du document</label>' +
                '<input type="text" class="form-control form-control-lg" name="inputOtherName" id="inputOtherName" required> '
            );
            // $('#inputotherFileName').val(comment);
        }else{
            $('#otherFileName').html('');
        }
        
    let valid = true;
    $('#inputBcnum').change(function(){
        // val = $("input.input1").val();
        var current = $(this).val();

        if(($(this).attr('name') == 'inputBcnum') && (current.length > 4)) 
        {
            var todel = 4-current.length
            $(this).val(current.slice(0, todel));
            $(this).blur(); 
            $(this).next("input").focus();
        }
    });

    $('#inputDoet').focusout(function(){
        
        var inputdobt = $('#inputDobt') ;
        var inputdoet = $('#inputDoet');
        var dobt      = new Date($('#inputDobt').val()) ;
        var doet      = new Date($('#inputDoet').val());
        var nextel    = inputdoet.next();
        // console.log(nextel);
        if(nextel.length>0) {nextel.remove() ;}

        var doetspan   = "<span class='diffo'>"+diff_date(dobt,doet)+" jours de voyage</span> ";

        inputdoet.after(doetspan);
   
        // 
    }); 

    $('#inputDov').focusout(function(){
        var inputdov  = $('#inputDov');
        var inputdoet = $('#inputDoet');
        var dov       = new Date(inputdov.val());
        var doet      = new Date(inputdoet.val());

        var nextel    = inputdov.next();
        // console.log(nextel);
        if(nextel.length && nextel.hasClass('diff')) {nextel.remove() ;}

        var dovspan   = "<span class='diff'>Expire "+diff_date(doet,dov)+" jours avant votre date de retour</span> ";
        inputdov.after(dovspan);
      /*   inputdov
        if (inputdoet.val().valueOf() >= inputdov.val().valueOf()) {
            alert(inputdov);
        } */

        // 
    });    

    $('.delete_up').click(function(){
        event.preventDefault();
        let del = confirm('Voulez-vous supprimer ce fichier ?');
        var deleteid = $(this).attr("id");
        var href = $(this).attr("href");
        let el = $(this);
        // alert(href);

        if(del)
        {
            $.ajax({
                url: href,
                type: 'post',
                data: { id:deleteid },
                success: function(response){    

                   if(response == 1){
                        // Remove row from HTML Table
                        $(el).closest('li').css({"color": "red", "border": "2px solid red"});
                        $(el).closest('li').fadeOut(800,function(){
                            $(this).remove();
                        });
                    }else{
                        alert('Une erreur est survenue lors de la suppression Essayez à nouveau');
                    }
                },
                error: function (error)
                {
                    // error alert message
                    alert('Une erreur est survenue Veuillez contacter l\'administrateur de ce site');
                    //$('#testid').html(error);
                }
            });
        }
    });
});

function changeClass() {

    var elements = document.getElementsByClassName('inputdate');
    for (var i = 0; i < elements.length; i++) {
        if(elements[i].classList.contains('is-invalid'))
        {
            elements[i].classList.remove('is-invalid');
        }
    }            
}

function clear_nextclass(input,classname){
    var nextel = input.next();
    if((nextel.length>0) && nextel.hasClass(classname)) {nextel.remove() ;}
}

function diff_date(date1,date2){

    // Calcul de la différence en millisecondes
    var differenceEnMillisecondes = date2 - date1;

    // Conversion en unités de temps (jours, heures, minutes, secondes)
    var millisecondsInOneSecond = 1000;
    var millisecondsInOneMinute = 60 * millisecondsInOneSecond;
    var millisecondsInOneHour = 60 * millisecondsInOneMinute;
    var millisecondsInOneDay = 24 * millisecondsInOneHour;

    var jours = Math.floor(differenceEnMillisecondes / millisecondsInOneDay);
    differenceEnMillisecondes %= millisecondsInOneDay;
    var heures = Math.floor(differenceEnMillisecondes / millisecondsInOneHour);
    differenceEnMillisecondes %= millisecondsInOneHour;
    var minutes = Math.floor(differenceEnMillisecondes / millisecondsInOneMinute);
    differenceEnMillisecondes %= millisecondsInOneMinute;
    var secondes = Math.floor(differenceEnMillisecondes / millisecondsInOneSecond);
    
    return jours
}

$flag = 1;

$("a.gfg").hover(
    function () {
        $("div.popup").attr("style", "display: inline-block; position:relative; z-index: 1;");
    },
    function () {
        if ($flag == -1) {
            $("div.popup").attr("style", "display:none");
        }
    }
);

$("a.gfg").click(function () {
    event.preventDefault();
    $flag = 1;
});
<?php if (!empty($demand) AND ($demand['status_id'] > 3 )) : ?>
    const inputs = document.querySelectorAll("input");
    const selects = document.querySelectorAll("select");
    const disabledFields = ["inputPasspNum", "inputDobt",""];
    const enabledField   = ["inputDoet"];
    inputs.forEach((input) => {
        
        if(enabledField.includes(input.getAttribute('id'))){            
            return;
        }
        input.setAttribute("readonly", "true");
    }) ;

    selects.forEach((select) => {
    
        select.setAttribute("disabled", "true");
    })
<?php endif; ?>    
</script>
