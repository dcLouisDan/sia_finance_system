const navLinks = Array.from(document.querySelectorAll(".nav-link"));
const URLArray = document.URL.split("/");
const currentFile = URLArray[URLArray.length - 1];
navLinks.map((link) => {
  link.classList.remove("active");
  var href = link.getAttribute("href");
  if (href === currentFile) {
    link.classList.toggle("active");
  }
});

const navMenuBtns = Array.from(document.querySelectorAll(".nav-menu-btn"));

navMenuBtns.map((btn) => {
  btn.addEventListener("click", (e) => {
    btn.classList.toggle("active");
    btn.nextElementSibling.classList.toggle("active");
    btn.querySelector(".bi").classList.toggle("active");
  });
});

const programSearchInput = document.getElementById("program-search");
const programList = Array.from(
  document.getElementById("program-list").children
);

programSearchInput.addEventListener("keyup", (e) => {
  let key = e.target.value.toLowerCase();
  programList.forEach((program) => {
    let itemName = program.textContent;
    if (itemName.toLowerCase().indexOf(key) != -1) {
      program.style.display = "block";
    } else {
      program.style.display = "none";
    }
  });
});
