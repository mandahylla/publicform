<?= $this->extend('layouts/pdf_main'); ?>
<?= $this->section('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/dropzone.min.css" />
    <style>
        html{margin:18px 35px}
        p{
            text-align: justify;            
        }

        ul{
            padding-top: -1em;
            list-style: none;
        }
        ul > li:before {
        content: "- ";
        text-indent: -10px;
        }
        .title-h2{
            text-align: center;
            border: 2px solid #3e4046;
            font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', 'Geneva', Verdana, sans-serif;
            /* border-color: ; */
        }

        .title-bold{
            font-weight: bold;
        }

        .ref{
            margin-top: 25px;
            margin-bottom: 18px;
        }

        .c-info{
            display: block;
            border: 2px solid #3e4046;
            padding: 1em 0.5em 1em 0.5em;            
        }

        .c-info-div{
            margin-bottom: 3px;
        }

        .c-info-num{
            float:right;
        }

        .d-info-paragraph{
            line-height: 1.5em;
            margin-bottom: -0.5em;
        }

        .d-inter{
            line-height: 1em;
        }

        .d-card{
            right: 0;
            position: absolute;
        }

        .sign{
            text-align: center ;
        }
        .sp-italic{
            font-style: italic ;
        }        
    </style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?php 
    $formula = ""; $stp = "";

    switch($demand['bc_formula']){
        case 'F1':
            $formula = "Formule N°1: 1M Retrait GAB | 1M Achat TPE"; 
            break;
        case 'F2':
            $formula = "Formule N°2: 5M Retrait GAB"; 
            break;
        case 'F3':
            $formula = "Formule N°3: 2,5M Retrait GAB | 2,5M Achat TPE"; 
            break;
        case 'F4':
            $formula = "Formule N°4: 5M Achat TPE"; 
            break;
    }

    switch($demand['stay_purpose']){
            case 'Etudiant':
                $stp = "Etudiant à l'étranger"; 
                break;
            case 'Formation, Stage, Mission ou alternance':
                $stp = "Formation, Stage, Mission ou Alternance"; 
                break;
            case 'Fonctionnaire Etat':
                $stp = ">Fonctionnaire d'état"; 
                break;
            case 'Mission Diplômatique':
                $stp = "Mission Diplômatique"; 
                break;
            case 'Mission Militaire':
                $stp = "Mission Militaire"; 
                break;
            case 'Membre Equipages':
                $stp = "Membre d'équipages"; 
                break;
            case 'Maladie':
                $stp = "Maladie"; 
                break;
            case 'Tourisme':
                $stp = "Tourisme, Sport ou Réligieux"; 
                break;  
            case 'Déplacement ponctuel':
                $stp = "Déplacement ponctuel"; 
                break;
    }
?>
    <h2 class="title-h2">
        Demande d'activation de Plafond mensuelle d'utilisation en devises 
        étrangères de carte monétique hors Zone CEMAC 
    </h2>
    <div class="ref">Réf (reserve à la banque) : ..............</div>
    <div class="c-info">
        <div class="c-info-div"><span class="c-info-label title-bold">Date :</span> <?= date("d/m/Y", strtotime($demand['created_at']))  ; ?> </div>
        <div class="c-info-div"><span class="c-info-label title-bold">Type de Carte : </span><?= $demand['bc_type']; ?> </div>
        <div class="c-info-div"><span class="c-info-label title-bold">Email : </span><?= $applicant['username']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c-info-num"><span class="c-info-label title-bold">Téléphone Connecté à WhatsApp : </span><?= $applicant['wphone']; ?> </span></div>
    </div>
    <div class="d-info">
        <p class="d-info-paragraph">
            Je soussigné(e) M/MME <?= $applicant['fullname']; ?> titulaire d'un compte <span class="title-bold">ouvert dans les livres du Crédit du congo</span>  
            N°: <?= $account['acc_num']; ?> Détenteur (détentrice) du passeport N°: <?= $demand['passport_num']; ?> <span>Valable jusqu'au:</span> <?= (!empty($demand['passport_date'])? date("d/m/Y", strtotime($demand['passport_date'])) : "")  ; ?> 
            <br>et de la carte bancaire, <span class="title-bold">dont les 4 derniers chiffres: </span><?= $demand['bcnum']; ?>, demande l'activation d'utilisation de ma carte hors zone CEMAC selon la <?= $formula  ; ?>,
            renouvellable chaque mois et selon la durée d'activation accordée selon les justificatifs fournis.            
        </p>
        <p class="d-info-paragraph">
            <span class="title-bold">Date d'activation : </span><?= date("d/m/Y", strtotime($demand['dobt'])); ?> <br>
            <span class="title-bold">Pays de destination : </span><?= $demand['destination']; ?> <br>
            <span class="title-bold">Objet de Séjour : </span><?= $stp; ?>
        </p>
    </div>
    <div class="rules">
        <p class="d-inter">
            Conformément à la réglementation, j'ai pris connaissance que cette autorisation renouvelable mensuellement est soumise
            à la présentation des pièces justificatives dument acceptées.
        </p>
        <p class="d-inter">
            Aussi, je vous autorise à débitermon compte de la somme de dix mille (10 000) F CFA équivalent aux frais de mise en place
            du plafond mensuelle de la carte hors zone CEMAC.
        </p>
        <p class="d-inter">
            Je joins à la présente demande les justificatifs ci-après : 
            <ul>
                <li>Photocopie de <span class="title-bold">la première page avec photo et dates d'émission/validité de mon</span> Passeport ;</li>
                <li>Copie du titre de Voyage (billet d'avion) ;</li>
                <li>Copie du Visa <span class="title-bold">ou équivalent (si exigé)</span> ;</li>
                <li>Justificatifs du statut résident installé à l'extérieur de la CEMAC.</li>
            </ul>
        </p>
        <p class="d-inter">
            Je m'engage à mettre à la diposition du Crédit du Congo, par tout moyen laissant trace, <span class="title-bold">dans un delai de 30 jours après la première utilisation de ma carte</span>
            toutes les pièces justificatives complémentaires y relatives, à savoir:
            <ul>
                <li><span class="title-bold">Les copies des tampons sur mon passeport justifiant la</span> sortie du territoire congolais
                                             et l'entrée dans le pays de destination hors zone CEMAC ;</li>
                <li><span class="title-bold">Toutes autres justificatifs permettant de confirmer mon statut de résident installé à l'extérieur de la CEMAC.</span> ;</li>
            </ul>
        </p>
        <p class="title-bold">
            Par ailleurs, je confirme avoir pris connaissance des exigences réglementataires de la Banque Centrale en vigueur notamment les sanctions prévues en cas de non-respect,
            à savoir la suspension de tous les moyens de paiement électronique en ma possession, en cas de non fourniture des compléments réquis dans le delai requis de 30 jours.
        </p>
        <p class="title-bold">
            En outre, je m'engage, en cas de demande d'activation de ma carte hors zone CEMAC, à ne pas déposer, pour le même voyage, aucune demande d'achat de billet de banque en devise
            ou un ordre de transfert pour motif "voyages hors zone CEMAC".
        </p>
    </div> 
    <div class="d-card">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="title-bold sign">Signature du client</span>
        <div>Précédée de la mention <span class="sp-italic"> &laquo;Lu et approuvée&raquo;</span> et de la carte</div>
    </div>
<?= $this->endSection(); ?>


