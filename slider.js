/* display first image */
var slideIndex = 1;
showSlides(slideIndex);

/* adds or substracts one to the slideIndex */
function goToSlide(plusMinusOne) {
    slideIndex += plusMinusOne;
    showSlides(slideIndex);
}

/* hides (display="none") all elements with the class name "slide",
   and displays (display="block") the element with the given slideIndex.*/
function showSlides(n) {
    var index;
    var element = document.getElementsByClassName("slide");

    /* if the slideIndex is higher than the number of elements, it is set to 1 */
    if (n > element.length) {
      slideIndex = 1;
    }

    /* if the slideIndex is less than 1 it is set to number of elements */
    if (n < 1) {
      slideIndex = element.length;
    }

    for (index = 0; index < element.length; index++) {
        element[index].style.display = "none";
    }

    element[slideIndex-1].style.display = "block";
}
