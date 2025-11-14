document.addEventListener('DOMContentLoaded', () => {
    const $current = document.getElementById('currentSlide');
    const $total = document.getElementById('totalSlide');
    const $bar = document.getElementById('progressBar');

    if (!$current || !$total || !$bar) {
        console.warn('Progress elements not found (currentSlide / totalSlide / progressBar).');
        return;
    }

    const swiper = new Swiper('.mySwiper', {
        slidesPerView: 1,
        spaceBetween: 12,
        loop: true,
        centeredSlides: false,
        autoplay: {
            delay: 4500,
            disableOnInteraction: false
        },
        navigation: {
            nextEl: '#nextBtn',
            prevEl: '#prevBtn',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 12,
                freeMode: true
            },
            540: {
                slidesPerView: 1.15,
                spaceBetween: 14,
                freeMode: true
            },
            768: {
                slidesPerView: 1.5,
                spaceBetween: 18,
                freeMode: true
            },
            1024: {
                slidesPerView: 2,
                spaceBetween: 24,
                freeMode: true
            }
        },
        a11y: {
            enabled: true,
        },
    });

    function countOriginalSlides() {
        const allSlides = Array.from(swiper.slides || []);
        return allSlides.filter(s => !s.classList.contains('swiper-slide-duplicate')).length;
    }

    function refreshProgress() {
        const total = Math.max(1, countOriginalSlides());
        const idx = (typeof swiper.realIndex === 'number') ? swiper.realIndex : (swiper.activeIndex || 0);
        const current = ((idx % total) + total) % total + 1;

        $current.textContent = String(current).padStart(2, '0');
        $total.textContent = String(total).padStart(2, '0');

        const percent = (current / total) * 100;
        $bar.style.width = `${percent}%`;
    }

    swiper.on('init', () => refreshProgress());
    swiper.on('afterInit', () => refreshProgress());
    swiper.on('slideChange', () => refreshProgress());
    swiper.on('resize', () => {
        setTimeout(refreshProgress, 60);
    });

    setTimeout(() => refreshProgress(), 120);

    window.addEventListener('resize', () => {
        setTimeout(refreshProgress, 90);
    });
});