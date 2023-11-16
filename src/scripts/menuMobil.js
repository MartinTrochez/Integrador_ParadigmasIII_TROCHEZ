window.onload = () => {
  const iconoMenuMobil = document.getElementById("menu-mobil");
  iconoMenuMobil.addEventListener("click", () => {
    if (iconoMenuMobil.classList.contains("open")) {
      iconoMenuMobil.classList.remove("open");
    } else {
      iconoMenuMobil.classList.add("open");
    }
  });
};
