document.addEventListener('DOMContentLoaded', function() {
    let popup = document.getElementById('popup');
    let closeBtn = document.querySelector('.close-btn');

    // Afficher la popup après un délai de 3 secondes
    setTimeout(function() {
        popup.style.display = 'block';
    }, 1000);

    // Fermer la popup quand on clique sur le bouton de fermeture
    closeBtn.addEventListener('click', function() {
        popup.style.display = 'none';
    });

    // Fermer la popup si on clique en dehors de son contenu
    window.addEventListener('click', function(event) {
        if (event.target == popup) {
            popup.style.display = 'none';
        }
    });
});
