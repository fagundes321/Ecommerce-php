// Scroll + esconder navbar ao descer
let lastScrollTop = 0;
const navbar = document.querySelector(".navbar-premium");

// efeito placeholder
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

// unificação do scroll
window.addEventListener("scroll", () => {
    let scrollTop = window.scrollY || document.documentElement.scrollTop;

    // efeito "scrolled"
    navbar.classList.toggle("scrolled", scrollTop > 50);

    // efeito esconder/mostrar
    if (scrollTop > lastScrollTop) {
        navbar.classList.add("hidden"); // descendo
    } else {
        navbar.classList.remove("hidden"); // subindo
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
});
