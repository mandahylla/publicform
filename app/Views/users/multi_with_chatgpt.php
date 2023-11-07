<!DOCTYPE html>
<html>
<head>
    <title>Formulaire à 3 étapes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .step-form {
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="step-form">
                    <!-- Étape 1 -->
                    <div class="step" id="step-1">
                        <h3>Étape 1</h3>
                        <div class="mb-3">
                            <label for="name">Nom :</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <!-- Bouton pour passer à l'étape suivante -->
                        <button type="button" class="btn btn-primary next-step">Suivant</button>
                    </div>
                    
                    <!-- Étape 2 -->
                    <div class="step" id="step-2" style="display: none;">
                        <h3>Étape 2</h3>
                        <div class="mb-3">
                            <label for="email">Email :</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <!-- Boutons pour passer à l'étape précédente ou à l'étape suivante -->
                        <button type="button" class="btn btn-secondary prev-step">Précédent</button>
                        <button type="button" class="btn btn-primary next-step">Suivant</button>
                    </div>
                    
                    <!-- Étape 3 -->
                    <div class="step" id="step-3" style="display: none;">
                        <h3>Étape 3</h3>
                        <div class="mb-3">
                            <label for="message">Message :</label>
                            <textarea id="message" name="message" class="form-control" required></textarea>
                        </div>
                        <!-- Boutons pour passer à l'étape précédente ou soumettre le formulaire -->
                        <button type="button" class="btn btn-secondary prev-step">Précédent</button>
                        <button type="submit" class="btn btn-primary">Soumettre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.next-step').click(function() {
                var currentStep = $(this).closest('.step');
                var nextStep = currentStep.next('.step');
                currentStep.hide();
                nextStep.show();
            });

            $('.prev-step').click(function() {
                var currentStep = $(this).closest('.step');
                var prevStep = currentStep.prev('.step');
                currentStep.hide();
                prevStep.show();
            });
        });
    </script>
</body>
</html>