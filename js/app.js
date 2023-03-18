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

//Search Program List
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

//Unlock Fee Inputs
const editFeesBtn = document.getElementById("edit-fee-btn");
const saveFeesBtn = document.getElementById("save-fee-btn");
const cancelFeesBtn = document.getElementById("cancel-fee-btn");
const feeInputs = Array.from(
  document.getElementById("fee-list").querySelectorAll("input")
);

function unlockInputs() {
  console.log("click");
  editFeesBtn.style.display = "none";
  saveFeesBtn.style.display = "block";
  cancelFeesBtn.style.display = "block";
  feeInputs.forEach((input) => {
    input.disabled = false;
  });
}

function lockInputs() {
  editFeesBtn.style.display = "block";
  saveFeesBtn.style.display = "none";
  cancelFeesBtn.style.display = "none";
  feeInputs.forEach((input) => {
    input.disabled = true;
  });
}

editFeesBtn.addEventListener("click", unlockInputs);
saveFeesBtn.addEventListener("click", lockInputs);
cancelFeesBtn.addEventListener("click", lockInputs);
