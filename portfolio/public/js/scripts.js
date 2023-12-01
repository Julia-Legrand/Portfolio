// Animation to progressively reveal about section on scroll
document.addEventListener("DOMContentLoaded", function () {
    // Get the "about-section" section
    var aboutSection = document.getElementById("about-section");
    
    // Get the elements
    var aboutText = document.querySelector(".aboutText");
    var aboutPicture = document.querySelector(".aboutPicture");

    // Calculate the vertical start position of the effect
    var startEffectPosition = aboutSection.offsetTop - window.innerHeight / 2;

    // Calculate the vertical end position of the effect (e.g., half of the window height)
    var endEffectPosition = startEffectPosition + window.innerHeight / 2;

    // Function to move elements on scroll
    function moveElementsOnScroll() {
      // Get the scroll position
      var scrollPosition = window.scrollY || window.pageYOffset;

      // Apply transformations only when scrolling is between the start and end positions of the effect
      if (scrollPosition > startEffectPosition && scrollPosition <= endEffectPosition) {
        var translateY = (scrollPosition - startEffectPosition) / 4;

        // Apply transformations
        aboutText.style.transform = "translateX(" + translateY + "px)";
        aboutPicture.style.transform = "translateX(-" + translateY + "px)";
      } else if (scrollPosition <= startEffectPosition) {
        // Reset transformations if scrolling is below the start position of the effect
        aboutText.style.transform = "translateX(0)";
        aboutPicture.style.transform = "translateX(0)";
      }
    }

    // Call the function on initial load and on scroll
    moveElementsOnScroll();
    window.addEventListener("scroll", moveElementsOnScroll);
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