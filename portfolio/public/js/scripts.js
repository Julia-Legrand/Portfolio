// Animation to bring the two divs closer together on scroll in the about-section
document.addEventListener('DOMContentLoaded', function () {
    var textElements = document.querySelectorAll('.aboutText');
    var pictureElements = document.querySelectorAll('.aboutPicture');

    function checkElements(elements) {
        elements.forEach(function (element) {
            var elementTop = element.getBoundingClientRect().top;
            var windowHeight = window.innerHeight;
            var scroll = window.scrollY || window.pageYOffset;

            // Adding the condition for responsive design
            if (window.innerWidth >= 1131) {
                if (scroll > elementTop - windowHeight + 100) {
                    element.classList.add('animated');
                }
            } else {
                // If the screen width is less than 1130 pixels, disable the animation
                element.classList.remove('animated');
            }
        });
    }

    function updateOnResize() {
        // Update the animation during window resizing
        checkElements(textElements);
        checkElements(pictureElements);
    }

    window.addEventListener('scroll', function () {
        checkElements(textElements);
        checkElements(pictureElements);
    });

    // To display the animation during page loading
    checkElements(textElements);
    checkElements(pictureElements);

    // Adding the resize event to update the animation
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

document.addEventListener('DOMContentLoaded', function () {
    var projectBlocks = document.querySelectorAll('.projectBloc');

    projectBlocks.forEach(function (block) {
        var projectImage = block.querySelector('img');
        var printScreenImage = block.querySelector('.printScreen img');

        // Vérifier si les éléments ont été trouvés
        if (projectImage && printScreenImage) {
            var overlay = document.createElement('div');
            var closeButton = document.createElement('button');

            // At the beginning, hide the image with the 'printScreen' class
            printScreenImage.style.display = 'none';

            // Creating black overlay
            overlay.className = 'overlay';
            document.body.appendChild(overlay);

            // Creating close button
            closeButton.className = 'close-btn';
            closeButton.innerHTML = '&times;';
            document.body.appendChild(closeButton);
            closeButton.style.display = 'none';

            // Handling the click on the 'projectPicture' image
            projectImage.addEventListener('click', function () {
                printScreenImage.style.display = 'block';
                printScreenImage.classList.add('fullscreen');
                overlay.style.display = 'block';
                closeButton.style.display = 'block';
            });

            // Handling the click on the close button
            closeButton.addEventListener('click', function () {
                printScreenImage.classList.remove('fullscreen');
                printScreenImage.style.display = 'none';
                overlay.style.display = 'none';
                closeButton.style.display = 'none';
            });

            // Handling the click outside of the image
            document.addEventListener('click', function (event) {
                if (
                    printScreenImage.classList.contains('fullscreen') &&
                    !printScreenImage.contains(event.target) &&
                    !projectImage.contains(event.target) &&
                    !closeButton.contains(event.target)
                ) {
                    // If the image is in fullscreen and the click is outside, hide it
                    printScreenImage.classList.remove('fullscreen');
                    printScreenImage.style.display = 'none';
                    overlay.style.display = 'none';
                    closeButton.style.display = 'none';
                }
            });

            // Listen for the end of the transition to restore the visibility of the main image
            printScreenImage.addEventListener('transitionend', function () {
                if (!printScreenImage.classList.contains('fullscreen')) {
                    projectImage.style.display = 'block';
                    overlay.style.display = 'none';
                    closeButton.style.display = 'none';
                }
            });
        }
    });
});

// Pop-up to display "Message envoyé"
function showPopup() {
    return confirm('Le message a bien été envoyé !');
}

function submitForm() {
    if (showPopup()) { // Scroll to the top of the page
        window.scrollTo(0, 0);
        return true; // Allow the form submission
    }
    return false; // Prevent the form submission if the user clicks cancel in the popup
};