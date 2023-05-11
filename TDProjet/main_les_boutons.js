const link = document.querySelectorAll('.bouton_jeune');
links.forEach(function(link){ 
    link.addEventListener('click', function(event){
        event.preventDefault();
        link.classList.add('clicked');
    });
});