document.addEventListener("DOMContentLoaded", function () {
  const smallSidebar = document.getElementById("sidebar");
  const expandedSidebar = document.getElementById("sidebar-expanded");
  const menuToggle = document.getElementById("menu-toggle");
  const menuClose = document.getElementById("menu-close");
  const header = document.getElementById("main-header");
  

  function toggleHeaderMargin(isExpanded) {
    if (isExpanded) {
        header.classList.remove("ml-20");
        header.classList.add("ml-48");
    } else {
        header.classList.remove("ml-48");
        header.classList.add("ml-20");
    }
  }

  // Abrir sidebar grande e ajustar header
  menuToggle.addEventListener("click", function () {
      smallSidebar.classList.add("hidden");
      expandedSidebar.classList.remove("hidden");
      toggleHeaderMargin(true);
  });

  // Voltar para sidebar pequena e ajustar header
  menuClose.addEventListener("click", function () {
      expandedSidebar.classList.add("hidden");
      smallSidebar.classList.remove("hidden");
      toggleHeaderMargin(false);
  });
});