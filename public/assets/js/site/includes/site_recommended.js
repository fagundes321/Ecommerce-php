// Remova o código duplicado e use apenas esta inicialização:
document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('.swiper-container', {
        // Configurações corretas
        direction: 'horizontal', // Mudei de vertical para horizontal
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,
        
        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        
        // Breakpoints para responsividade
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            620: {
                slidesPerView: 2
            },
            1024: {
                slidesPerView: 3
            }
        }
    });
});