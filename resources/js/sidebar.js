document.addEventListener("DOMContentLoaded", function () {
  const smallSidebar = document.getElementById("sidebar");
  const expandedSidebar = document.getElementById("sidebar-expanded");
  const menuToggle = document.getElementById("menu-toggle");
  const menuClose = document.getElementById("menu-close");
  const header = document.getElementById("main-header");

  // Abrir sidebar grande e ajustar header
  menuToggle.addEventListener("click", function () {
      smallSidebar.classList.add("hidden");
      expandedSidebar.classList.remove("hidden");
      toggleHeaderPadding(true);
  });

  // Voltar para sidebar pequena e ajustar header
  menuClose.addEventListener("click", function () {
      expandedSidebar.classList.add("hidden");
      smallSidebar.classList.remove("hidden");
      toggleHeaderPadding(false);
  });
});