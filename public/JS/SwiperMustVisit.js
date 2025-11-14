new Swiper(".thingsSwiper", {
    slidesPerView: "auto",
    centeredSlides: true,
    spaceBetween: 10,
    loop: true,
    grabCursor: true,
    speed: 800,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        768: {
            spaceBetween: 10,
        },
        1024: {
            spaceBetween: 10,
        },
    },
    on: {
        init(swiper) {
            swiper.slides.forEach((s) => {
                s.style.transition = "transform 0.6s ease, opacity 0.6s ease";
                s.style.opacity = "0.5";
                s.style.transform = "scale(0.9)";
            });
            const active = swiper.slides[swiper.activeIndex];
            if (active) {
                active.style.opacity = "1";
                active.style.transform = "scale(1.05)";
            }
        },
        slideChangeTransitionStart(swiper) {
            swiper.slides.forEach((s) => {
                s.style.opacity = "0.5";
                s.style.transform = "scale(0.9)";
            });
            const active = swiper.slides[swiper.activeIndex];
            if (active) {
                active.style.opacity = "1";
                active.style.transform = "scale(1.05)";
            }
        },
    },
});
