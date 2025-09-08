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

let lastScrollTop = 0;
const navbar = document.querySelector(".navbar-premium");

window.addEventListener("scroll", () => {
  let scrollTop = window.scrollY || document.documentElement.scrollTop;

  if (scrollTop > lastScrollTop) {
    // descendo -> esconde a navbar
    navbar.classList.add("hidden");
  } else {
    // subindo -> mostra a navbar
    navbar.classList.remove("hidden");
  }

  lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // evita valor negativo
});
