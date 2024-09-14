document.addEventListener("DOMContentLoaded", function() {
    // Sélectionner l'alerte avec l'ID 'message'
    var message = document.getElementById('message');

    // Masquer l'alerte après 3 secondes
    setTimeout(function() {
        if (message) {
            message.style.display = 'none';
        }
    }, 3000); // 3000 millisecondes = 3 secondes
});