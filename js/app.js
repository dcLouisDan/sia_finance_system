try {
  MicroModal.init({
    onShow: (modal) => console.info(`${modal.id} is shown`), // [1]
    onClose: (modal) => console.info(`${modal.id} is hidden`), // [2]
    openTrigger: "data-custom-open", // [3]
    closeTrigger: "data-micromodal-close", // [4]
    disableScroll: true, // [5]
    disableFocus: false, // [6]
    awaitCloseAnimation: false, // [7]
    debugMode: true, // [8]
  });
} catch {}

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
    document.getElementById("input-list").querySelectorAll(".input-control")
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

try {
  const searchStudNum = document.getElementById("searchStudNum");
  const searchStudName = document.getElementById("searchStudName");
  const searchStudProgram = document.getElementById("searchStudProgram");
  const studentRows = Array.from(
    document.getElementById("studentRows").children
  );

  console.log(studentRows);

  searchStudNum.addEventListener("keyup", (e) => {
    let numKey = e.target.value;

    studentRows.forEach((row) => {
      let itemName = row.querySelector("[data-field='studNum']").textContent;
      if (itemName.toLowerCase().indexOf(numKey) != -1) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
  searchStudName.addEventListener("keyup", (e) => {
    let nameKey = e.target.value.toLowerCase();

    studentRows.forEach((row) => {
      let itemName = row.querySelector("[data-field='studName']").textContent;
      if (itemName.toLowerCase().indexOf(nameKey) != -1) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
  searchStudProgram.addEventListener("keyup", (e) => {
    let progKey = e.target.value.toLowerCase();

    studentRows.forEach((row) => {
      let itemName = row.querySelector(
        "[data-field='studProgram']"
      ).textContent;
      if (itemName.toLowerCase().indexOf(progKey) != -1) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });

  const radAll = document.getElementById("radAll");
  const radPaid = document.getElementById("radPaid");
  const radUnpaid = document.getElementById("radUnpaid");
  const feeRadFilter = document.getElementById("feeRadFilter");

  feeRadFilter.addEventListener("click", () => {
    const noBal = "Php 0.00";
    if (radPaid.checked) {
      studentRows.forEach((row) => {
        let balance = row.querySelector("[data-field='studBal']").textContent;
        if (balance == noBal) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      });
    } else if (radUnpaid.checked) {
      studentRows.forEach((row) => {
        let balance = row.querySelector("[data-field='studBal']").textContent;
        if (balance != noBal) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      });
    } else if (radAll.checked) {
      studentRows.forEach((row) => {
        row.style.display = "";
      });
    }
  });
} catch (error) {}
