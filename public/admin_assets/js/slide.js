
  
                                      // onload function




  // image slider function
var slideIndex = 0;
const prevButton = document.querySelector('.carousel-navigation button:first-of-type');
const nextButton = document.querySelector('.carousel-navigation button:last-of-type');

function showSlides() {
    var slides = document.getElementsByClassName("slide");
    for (var i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");
    }

    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    slides[slideIndex - 1].classList.add("active");
    setTimeout(showSlides, 2000);
}

showSlides();

