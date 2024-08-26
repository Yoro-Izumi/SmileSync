const inputs = document.querySelectorAll(".input-field");
const toggle_btn = document.querySelectorAll(".toggle");
const main = document.querySelector("main");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");

inputs.forEach((inp) => {
  inp.addEventListener("focus", () => {
    inp.classList.add("active");
  });
  inp.addEventListener("blur", () => {
    if (inp.value != "") return;
    inp.classList.remove("active");
  });
});

toggle_btn.forEach((btn) => {
  btn.addEventListener("click", () => {
    main.classList.toggle("sign-up-mode");
  });
});


/*carousel image changing every login and signup switch*/
function moveSlider() {
  let index = this.dataset.value;

  let currentImage = document.querySelector(`.img-${index}`);
  images.forEach((img) => img.classList.remove("show"));
  currentImage.classList.add("show");

  const textSlider = document.querySelector(".text-group");
  textSlider.style.transform = `translateY(${-(index - 1) * 2.2}rem)`;

  bullets.forEach((bull) => bull.classList.remove("active"));
  this.classList.add("active");
}

bullets.forEach((bullet) => {
  bullet.addEventListener("click", moveSlider);
});


document.addEventListener("DOMContentLoaded", function () {
  const signUpForm = document.querySelector(".sign-up-form");
  const signInForm = document.querySelector(".sign-in-form");
  const images = document.querySelectorAll(".images-wrapper .image");
  const toggleLinks = document.querySelectorAll(".toggle");
  let currentImageIndex = 0;

  function showImage(index) {
      images.forEach((img, i) => {
          img.classList.toggle("show", i === index);
      });
  }

  toggleLinks.forEach(link => {
      link.addEventListener("click", function () {
          if (signUpForm.classList.contains("sign-up-form")) {
              currentImageIndex = (currentImageIndex + 1) % images.length;
              showImage(currentImageIndex);
          } else {
              currentImageIndex = (currentImageIndex + 1) % images.length;
              showImage(currentImageIndex);
          }
      });
  });

  // Initialize carousel with first image
  showImage(currentImageIndex);
});
