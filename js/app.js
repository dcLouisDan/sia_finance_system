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
