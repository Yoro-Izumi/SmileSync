const inputs = document.querySelectorAll(".input-field");
inputs.forEach((inp) => {
  inp.addEventListener("focus", () => {
    inp.classList.add("active");
  });
  inp.addEventListener("blur", () => {
    if (inp.value != "") return;
    inp.classList.remove("active");
  });
  inp.addEventListener("focus", () => {
    if (inp.value == "#birthdate-picker") return;
    inp.classList.add("active");
  });
});

const toggle_btn = document.querySelectorAll(".toggle");
const main = document.querySelector("main");


toggle_btn.forEach((btn) => {
  btn.addEventListener("click", () => {
    main.classList.toggle("sign-up-mode");
  });
});