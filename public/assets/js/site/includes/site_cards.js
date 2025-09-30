document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".card-produto, .slide-card");

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
});
