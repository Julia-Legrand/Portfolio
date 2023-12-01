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