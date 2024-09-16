document.addEventListener('DOMContentLoaded', function () {

const inputs = document.querySelectorAll(".input-field");
const toggle_btn = document.querySelectorAll(".toggle");
const main = document.querySelector("main");

flatpickr("#birthdate-picker", {
  minDate: "1975-01-01",
  maxDate: "2015-12-31",
  dateFormat: "Y-m-d", // Format as Year-Month-Day
});

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

toggle_btn.forEach((btn) => {
  btn.addEventListener("click", () => {
    main.classList.toggle("sign-up-mode");
  });
});

});