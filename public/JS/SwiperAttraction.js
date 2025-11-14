const swiper = new Swiper(".attraction-slider", {
    slidesPerView: 1.2,
    spaceBetween: 20,
    freeMode: true,
    loop: true,
    centeresSlides: true,
    autoplay: {
        delay: 4500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: "#nextBtn",
        prevEl: "#prevBtn",
    },
    breakpoints: {
        768: { slidesPerView: 2.3 },
        1024: { slidesPerView: 3.3 },
    },
});
