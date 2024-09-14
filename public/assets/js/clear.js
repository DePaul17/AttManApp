document.addEventListener("DOMContentLoaded", function() {
    // Obtenez une référence au bouton de nettoyage
    var clearButton = document.getElementById('clear');
    
    // Ajoutez un écouteur d'événements pour le clic sur le bouton de nettoyage
    clearButton.addEventListener('click', function() {
        // Obtenez une référence à tous les champs de formulaire
        var formInputs = document.querySelectorAll('input, select');

        // Parcourez chaque champ et réinitialisez sa valeur à une chaîne vide
        formInputs.forEach(function(input) { 
            input.value = '';
        });
    });
});