
    const carouselContainer = document.querySelector('.carousel-container');
    const carouselSlides = document.querySelectorAll('.carousel-slide');
    const preshowButton = document.querySelector('.carousel-navigation button:first-of-type');
    const nextshowButton = document.querySelector('.carousel-navigation button:last-of-type');

    let slideshowIndex = 0;

    function showSlide() {
      carouselContainer.style.transform = `translateX(-${slideshowIndex * 100}%)`;
    }

    function nextShow() {
      slideshowIndex++;
      if (slideshowIndex >= carouselSlides.length) {
        slideshowIndex = 0;
      }
      showSlide();
    }

    function preShow() {
      slideshowIndex--;
      if (slideshowIndex < 0) {
        slideshowIndex = carouselSlides.length - 1;
      }
      showSlide();
    }

    preshowButton.addEventListener('click', preShow);
    nextshowButton.addEventListener('click', nextShow);

    // setInterval(nextShow, 5000); // Change slide every 2 seconds
  