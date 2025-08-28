document.addEventListener("DOMContentLoaded", function () {
  const dropdownBtn = document.querySelector(".btn-dropdown");
  const dropdownArea = document.querySelector(".Dropdown-area");
  const dropdownClose = document.querySelector(
    ".Dropdown-body-title .zmdi-close"
  );

  // Abrir dropdown
  dropdownBtn.addEventListener("click", function (e) {
    e.preventDefault();
    dropdownArea.classList.add("show-Dropdown-area");
  });

  // Cerrar dropdown
  dropdownClose.addEventListener("click", function () {
    dropdownArea.classList.remove("show-Dropdown-area");
  });

  // Cerrar al hacer click fuera
  document.addEventListener("click", function (e) {
    if (!dropdownArea.contains(e.target) && !dropdownBtn.contains(e.target)) {
      dropdownArea.classList.remove("show-Dropdown-area");
    }
  });
});
