/* display first image */
var slideIndex = 1;

/* adds or substracts one to the slideIndex */
function goToSlide(number) {
    slideIndex += number;
    showSlide(slideIndex);
}

/* hides (display="none") all elements with the class name "slide",
   and displays (display="block") the element with the given slideIndex.*/
function showSlide(n) {
    var images = document.getElementsByClassName("slide");

    /* if the slideIndex is higher than the number of elements, set it to 1 */
    if (n > images.length) {
      slideIndex = 1;
    } else if (n < 1) {
      /* if the slideIndex is less than 1 it is set to number of elements */
      slideIndex = images.length;
    } else {
      slideIndex = n;
   }

    for (var index = 0; index < images.length; index++) {
        images[index].style.display = "none";
    }

    images[slideIndex-1].style.display = "block";
}
