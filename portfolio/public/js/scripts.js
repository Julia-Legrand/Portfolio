// Animation to bring the two divs closer together on scroll in the about-section
document.addEventListener('DOMContentLoaded', function () {
    var textElements = document.querySelectorAll('.aboutText');
    var pictureElements = document.querySelectorAll('.aboutPicture');

    function checkElements(elements) {
        elements.forEach(function (element) {
            var elementTop = element.getBoundingClientRect().top;
            var windowHeight = window.innerHeight;
            var scroll = window.scrollY || window.pageYOffset;

            // Ajout de la condition pour le responsive design
            if (window.innerWidth >= 1131) {
                if (scroll > elementTop - windowHeight + 100) {
                    element.classList.add('animated');
                }
            } else {
                // Si la largeur de l'écran est inférieure à 1130px, désactiver l'animation
                element.classList.remove('animated');
            }
        });
    }

    function updateOnResize() {
        // Mise à jour de l'animation lors du redimensionnement de la fenêtre
        checkElements(textElements);
        checkElements(pictureElements);
    }

    window.addEventListener('scroll', function () {
        checkElements(textElements);
        checkElements(pictureElements);
    });

    // Pour afficher l'animation lors du chargement de la page
    checkElements(textElements);
    checkElements(pictureElements);

    // Ajout de l'événement de redimensionnement pour mettre à jour l'animation
    window.addEventListener('resize', updateOnResize);
});


// Animation to progressively reveal timeline articles as you scroll
document.addEventListener('DOMContentLoaded', function () {
    const timelineArticles = document.querySelectorAll('.timeline article');

    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    function handleScroll() {
        timelineArticles.forEach(article => {
            if (isElementInViewport(article) && !article.classList.contains('visible')) {
                article.classList.add('visible');
            }
        });
    }

    // Add a scroll listener
    window.addEventListener('scroll', handleScroll);

    // Calling the function on initial load
    handleScroll();
});

// Animation to display project picture on first clic, then going to Github page on second clic
document.addEventListener('DOMContentLoaded', function () {
    var projectBlocks = document.querySelectorAll('.projectBloc');

    projectBlocks.forEach(function (block) {
        var projectImage = block.querySelector('img');
        var printScreenImage = block.querySelector('.printScreen img');
        var overlay = document.createElement('div');

        // Au départ, cacher l'image de la classe printScreen
        printScreenImage.style.display = 'none';

        // Créer l'overlay noir
        overlay.className = 'overlay';
        document.body.appendChild(overlay);

        // Gestion du clic sur l'image projectPicture
        projectImage.addEventListener('click', function () {
            // Afficher l'image de la classe printScreen en plein écran
            printScreenImage.style.display = 'block';
            printScreenImage.classList.add('fullscreen');
            overlay.style.display = 'block';
        });

        // Gestion du clic en dehors de l'image
        document.addEventListener('click', function (event) {
            if (
                printScreenImage.classList.contains('fullscreen') &&
                !printScreenImage.contains(event.target) &&
                !projectImage.contains(event.target)
            ) {
                // Si l'image est en plein écran et le clic est en dehors, la cacher
                printScreenImage.classList.remove('fullscreen');
                printScreenImage.style.display = 'none';
                overlay.style.display = 'none';
            }
        });

        // Écouter la fin de la transition pour rétablir la visibilité de l'image principale
        printScreenImage.addEventListener('transitionend', function () {
            if (!printScreenImage.classList.contains('fullscreen')) {
                projectImage.style.display = 'block';
                overlay.style.display = 'none';
            }
        });
    });
});