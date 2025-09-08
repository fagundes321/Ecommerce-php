document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".card-produto");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                cards.forEach((card, index) => {
                    setTimeout(() => {
                        card.classList.add("visible");
                    }, index * 150); // 150ms de delay entre cada card
                });
                observer.disconnect(); // anima apenas uma vez
            }
        });
    }, { threshold: 0.2 });

    cards.forEach(card => observer.observe(card));
});

document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".card-produto2");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                cards.forEach((card, index) => {
                    setTimeout(() => {
                        card.classList.add("visible");
                    }, index * 150); // 150ms de delay entre cada card
                });
                observer.disconnect(); // anima apenas uma vez
            }
        });
    }, { threshold: 0.2 });

    cards.forEach(card => observer.observe(card));
});
