// Mobile menu toggle with overlay and close button
const menuBtn = document.getElementById("mobile-menu-btn");
const menu = document.getElementById("mobile-menu");
const overlay = document.getElementById("mobile-menu-overlay");
const closeBtn = document.getElementById("mobile-menu-close");

function openMenu() {
  menu.classList.remove("translate-x-full");
  menu.classList.add("translate-x-0");
  overlay.classList.remove("hidden");
}

function closeMenu() {
  menu.classList.add("translate-x-full");
  menu.classList.remove("translate-x-0");
  overlay.classList.add("hidden");
}

menuBtn.addEventListener("click", openMenu);
closeBtn.addEventListener("click", closeMenu);
overlay.addEventListener("click", closeMenu);

// Optional: Close menu on ESC key
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") closeMenu();
});
