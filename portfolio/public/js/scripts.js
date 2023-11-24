// Rotation du CV au survol de la souris

document.addEventListener('DOMContentLoaded', function() {
    const cvDiv = document.querySelector('.cv');

    cvDiv.addEventListener('mouseenter', function() {
        cvDiv.classList.add('rotate-on-hover');
    });

    cvDiv.addEventListener('mouseleave', function() {
        cvDiv.classList.remove('rotate-on-hover');
    });
});

// Animation pour faire apparaître les articles de la timeline au fur et à mesure du scroll
document.addEventListener('DOMContentLoaded', function() {
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

    // Ajouter un écouteur de scroll
    window.addEventListener('scroll', handleScroll);

    // Appeler la fonction au chargement initial
    handleScroll();
});