function toggleFilhos(elementoPai) {
    const icone = elementoPai.querySelector(".seta");
    const topicoFilho = elementoPai.nextElementSibling;

    if (topicoFilho.classList.contains("hidden")) {
        topicoFilho.classList.remove("hidden");
        icone.style.transform = "rotate(180deg)";
    } else {
        topicoFilho.classList.add("hidden");
        icone.style.transform = "rotate(0deg)";
    }
}

// Torna acessível no HTML (escopo global)
window.toggleFilhos = toggleFilhos;
