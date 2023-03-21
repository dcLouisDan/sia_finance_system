try {
  const mainNavLinks = Array.from(document.querySelectorAll(".nav-link"));
  const URLArray = document.URL.split("/");
  let currentFile = URLArray[URLArray.length - 1];
  if (currentFile.includes("?")) {
    currentFile = currentFile.slice(0, currentFile.indexOf("?"));
  }
  const subNavLinks = Array.from(document.querySelectorAll(".nav-menu li a "));
  const navLinks = mainNavLinks.concat(subNavLinks);

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
} catch {}

try {
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
} catch {}

try {
  //Unlock Inputs
  const editBtn = document.getElementById("edit-btn");
  const saveBtn = document.getElementById("save-btn");
  const cancelBtn = document.getElementById("cancel-btn");
  const inputList = Array.from(
    document.getElementById("input-list").querySelectorAll("input")
  );
  function unlockInputs() {
    editBtn.style.display = "none";
    saveBtn.style.display = "block";
    cancelBtn.style.display = "block";
    inputList.forEach((input) => {
      if (input.previousElementSibling) {
        input.previousElementSibling.style.color = "var(--primary)";
      }
      input.disabled = false;
    });
  }

  function lockInputs() {
    editBtn.style.display = "block";
    saveBtn.style.display = "none";
    cancelBtn.style.display = "none";
    inputList.forEach((input) => {
      if (input.previousElementSibling) {
        input.previousElementSibling.style.color = "gray";
      }
      input.disabled = true;
    });
  }

  editBtn.addEventListener("click", unlockInputs);
  cancelBtn.addEventListener("click", lockInputs);
} catch {}

try {
  const changeDpForm = document.getElementById("change-dp-form");
  const changeDpBtn = document.getElementById("change-dp-btn");
  const canelDpBtn = document.getElementById("cancel-dp-btn");

  changeDpBtn.addEventListener("click", () => {
    changeDpForm.style.display = "block";
    changeDpBtn.style.display = "none";
  });

  canelDpBtn.addEventListener("click", () => {
    changeDpForm.style.display = "none";
    changeDpBtn.style.display = "block";
  });
} catch (error) {}
