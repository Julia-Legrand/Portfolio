// Animation to progressively reveal about section on scroll
document.addEventListener('DOMContentLoaded', function () {
    var elements = document.querySelectorAll('.aboutText, .aboutPicture');

    function checkElements() {
        elements.forEach(function (element) {
            var elementTop = element.getBoundingClientRect().top;
            var windowHeight = window.innerHeight;
            var scroll = window.scrollY || window.pageYOffset;

            if (scroll > elementTop - windowHeight + 100) {
                element.classList.add('animated');
            }
        });
    }

    window.addEventListener('scroll', checkElements);
    checkElements(); // Pour déclencher l'animation au chargement de la page
});

// Animation to progressively reveal timeline articles as you scroll
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

    // Add a scroll listener
    window.addEventListener('scroll', handleScroll);

    // Calling the function on initial load
    handleScroll();
});