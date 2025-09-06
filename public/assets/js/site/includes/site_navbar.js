// Scroll efeito na navbar
window.addEventListener("scroll", () => {
    const navbar = document.querySelector(".navbar-premium");
    navbar.classList.toggle("scrolled", window.scrollY > 50);
});

// Placeholder do campo de busca
const searchInput = document.getElementById("searchInput");
const originalPlaceholder = searchInput.placeholder;

searchInput.addEventListener("focus", () => {
    searchInput.placeholder = "";
});

searchInput.addEventListener("blur", () => {
    if (!searchInput.value.trim()) {
        searchInput.placeholder = originalPlaceholder;
    }
});
