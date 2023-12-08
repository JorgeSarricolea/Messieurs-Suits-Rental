let swiper = new Swiper(".swiper-container", {
  slidesPerView: 3,
  spaceBetween: 30 /* This adds space between slides, adjust as needed */,
  slidesPerGroup: 1 /* Change this if you want to scroll one slide at a time */,
  centeredSlides: true /* This will center the slides */,
  loop: true,
  loopFillGroupWithBlank: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});
