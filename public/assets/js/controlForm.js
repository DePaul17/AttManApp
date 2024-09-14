function validateForm() {
    var name = document.getElementById('name').value.trim();
    var firstName = document.getElementById('first_name').value.trim();
    var cni = document.getElementById('cni').value.trim();
    var phone = document.getElementById('phone').value.trim();
    var heureDebut = document.getElementById('heure_debut').value.trim();
    var heureFin = document.getElementById('heure_fin').value.trim();
    var email = document.getElementById('email').value.trim();
    var password = document.getElementById('password').value.trim();
    var confirmPassword = document.getElementById('confirm_password').value.trim();
    var cjm = document.getElementById('cjm').value.trim();
    var role = document.getElementById('role').value;

    // Vérification si tous les champs sont remplis
    if (name === '' || firstName === '' || cni === '' || phone === '' || heureDebut === '' || heureFin === '' || email === '' || password === '' || cjm === '' || role === '') {
        alert('Veuillez remplir tous les champs.');
        return false;
    }

    // Vérification du format du nom et du prénom
    var namePattern = /^[A-Za-z]+$/;
    if (!name.match(namePattern) || !firstName.match(namePattern)) {
        alert('Le nom et le prénom doivent être composés uniquement de lettres.');
        return false;
    }

    //Vérification de la date de naissance
    var dateNaissance = document.getElementById('date_naissance').value.trim();
    if (dateNaissance === '') {
        alert('Veuillez sélectionner votre date de naissance.');
        return false;
    }

    //Vérification du sexe
    var sexe = document.getElementById('sexe').value;
    if (sexe === '') {
        alert('Veuillez sélectionner votre sexe.');
        return false;
    }

    // Vérification du format du numéro de CNI
    var cniPattern = /^FR\d{13}$/;
    if (!cni.match(cniPattern)) {
        alert('Le numéro de CNI doit commencer par FR et être composé de 13 chiffres.');
        return false;
    }

    // Vérification du format du numéro de téléphone
    var phonePattern = /^\d{9}$/;
    if (!phone.match(phonePattern)) {
        alert('Le numéro de téléphone doit être composé de 9 chiffres.');
        return false;
    }

    // Vérification du format de l'heure de début et de fin
    var heurePattern = /^\d{1,2}$/;
    if (!heureDebut.match(heurePattern) || !heureFin.match(heurePattern) || parseInt(heureDebut) < 0 || parseInt(heureDebut) > 23 || parseInt(heureFin) < 0 || parseInt(heureFin) > 23) {
        alert('L\'heure de début et de fin doivent être des nombres compris entre 0 et 23 H.');
        return false;
    }

    // Validation de l'email
    var email = document.getElementById('email').value.trim();
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var domainPattern = /@wingroup\.fr$/; // Modifié pour terminer par .fr
    if (!email.match(emailPattern) || !email.match(domainPattern)) {
        alert('Veuillez entrer une adresse e-mail valide se terminant par @wingroup.fr');
        return false;
    }

    // Vérification du format du mot de passe
    var passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
    if (!password.match(passwordPattern)) {
        alert('Le mot de passe doit comporter au moins 8 caractères alphanumériques et au moins un caractère spécial.');
        return false;
    }

    // Validation confirmation mot de passe
    var confirmPassword = document.getElementById('confirm_password').value.trim();
    if (confirmPassword !== password) {
        alert('La confirmation du mot de passe ne correspond pas.');
        return false;
    }

    // Vérification du format du coût journalier moyen
    var cjmPattern = /^\d+$/;
    if (!cjm.match(cjmPattern)) {
        alert('Le coût journalier moyen doit être composé uniquement de chiffres.');
        return false;
    } else if (parseInt(cjm) < 56) {
        alert('Le coût journalier moyen, à partir de 56€.');
        return false;
    }

    // Si toutes les validations passent, retourne vrai pour soumettre le formulaire
    return true;
}
