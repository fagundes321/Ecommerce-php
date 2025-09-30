const swiper = new Swiper('.swiper', {
    direction: 'horizontal',
    loop: false,
    slidesPerView: 2,
    spaceBetween: 20,

    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },

    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 10
        },
        620: {
            slidesPerView: 2,
            spaceBetween: 15
        },
        1024: {
            slidesPerView: 4.7,   // mantém corte
            spaceBetween: 20,
            slidesOffsetAfter: 40 // garante último visível
        }
    }
});

// Animação de entrada
const cards = document.querySelectorAll(".busca-produtos");
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
        if (entry.isIntersecting && !entry.target.classList.contains("visible")) {
            setTimeout(() => {
                entry.target.classList.add("visible");
            }, index * 150);
        }
    });
}, { threshold: 0.2 });

cards.forEach(card => observer.observe(card));

document.querySelectorAll("img.lazy-img").forEach(img => {
    const realSrc = img.getAttribute("data-src");
    const preloader = new Image();
    preloader.src = realSrc;
    preloader.onload = () => {
        img.src = realSrc;
        img.classList.add("loaded");
    };
});