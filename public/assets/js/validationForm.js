document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('#submit').addEventListener('click', function(event) {
        // Empêcher la soumission automatique du formulaire
        //event.preventDefault();
        
        // Réinitialiser les messages d'erreur
        document.querySelectorAll('.error-message').forEach(function(element) {
            element.textContent = '';
        });

        // Valider le formulaire
        var isValid = validateForm();

        // Soumettre le formulaire si la validation réussit
        if (isValid) {
            document.getElementById('user-form').submit();
        }
    });

    document.querySelector('#clear').addEventListener('click', function() {
        // Réinitialiser les champs du formulaire
        document.querySelectorAll('input, select').forEach(function(input) {
            input.value = '';
        });
    });

    function validateForm() {
        var isValid = true;

        // Validation du nom
        var name = document.getElementById('name').value.trim();
        if (name === '') {
            document.getElementById('name-error').textContent = 'Le nom est obligatoire.';
            isValid = false;
        }

        // Validation du prénom
        var firstName = document.getElementById('first_name').value.trim();
        if (firstName === '') {
            document.getElementById('first_name-error').textContent = 'Le prénom est obligatoire.';
            isValid = false;
        }

        // Validation du numéro de téléphone
        var phone = document.getElementById('phone').value.trim();
        var phonePattern = /^(76|77|78)\d{7}$/;
        if (!phone.match(phonePattern)) {
            document.getElementById('phone-error').textContent = 'Le numéro de téléphone doit commencer par 76, 77 ou 78, suivi de 7 chiffres.';
            isValid = false;
        }

        // Validation du numéro de CNI
        var cni = document.getElementById('cni').value.trim();
        var cniPattern = /^SN\d{13}$/;
        if (!cni.match(cniPattern)) {
            document.getElementById('cni-error').textContent = 'Le numéro de CNI doit commencer par SN et être suivi de 13 chiffres.';
            isValid = false;
        }

        // Validation de l'heure de début
        var heureDebut = document.getElementById('heure_debut').value.trim();
        if (!Number.isInteger(parseInt(heureDebut))) {
            document.getElementById('heure_debut-error').textContent = 'L\'heure de début doit être un entier.';
            isValid = false;
        }

        // Validation de l'heure de fin
        var heureFin = document.getElementById('heure_fin').value.trim();
        if (!Number.isInteger(parseInt(heureFin))) {
            document.getElementById('heure_fin-error').textContent = 'L\'heure de fin doit être un entier.';
            isValid = false;
        }

        // Validation du coût journalier moyen
        var cjm = document.getElementById('cjm').value.trim();
        if (!Number.isInteger(parseInt(cjm))) {
            document.getElementById('cjm-error').textContent = 'Le coût journalier moyen doit être un entier.';
            isValid = false;
        }

        // Validation de l'email
        var email = document.getElementById('email').value.trim();
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.match(emailPattern)) {
            document.getElementById('email-error').textContent = 'Veuillez entrer une adresse e-mail valide.';
            isValid = false;
        }

        // Validation du mot de passe
        var password = document.getElementById('password').value.trim();
        var passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
        if (!password.match(passwordPattern)) {
            document.getElementById('password-error').textContent = 'Le mot de passe doit comporter au moins 8 caractères alphanumériques et au moins un caractère spécial.';
            isValid = false;
        }

        // Validation confirmation mot de passe
        var confirmPassword = document.getElementById('confirm_password').value.trim();
        var confirmPasswordError = document.getElementById('confirm_password-error'); // Correction de l'ID ici
        if (confirmPassword !== password) {
            confirmPasswordError.textContent = 'La confirmation du mot de passe ne correspond pas.';
            isValid = false;
        } else {
            confirmPasswordError.textContent = '';
        }

        // Validation du rôle
        var role = document.getElementById('role').value;
        if (role === '') {
            document.getElementById('role-error').textContent = 'Veuillez sélectionner un rôle pour l\'utilisateur.';
            isValid = false;
        }

        return isValid;
    }
});