const bar = document.querySelector(".fa-bars");
const menu = document.querySelector(".menu",);
const menuB = document.querySelector(".menu-b");

bar.addEventListener("click", () => {
  menu.classList.toggle("show-menu",);
});

bar.addEventListener("click", () => {
  menuB.classList.toggle("show-menu",);
});
X