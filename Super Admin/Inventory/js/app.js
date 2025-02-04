  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");

  const inputs = document.querySelectorAll(".modal-input");

  inputs.forEach((input) => {
    // When input gains focus
    input.addEventListener("focus", () => {
      input.classList.add("active");
    });
  
    // When input loses focus
    input.addEventListener("blur", () => {
      if (input.value.trim() === "") {
        input.classList.remove("active");
      }
    });
  
    // Check pre-filled values (e.g., on page load or after a modal is opened)
    if (input.value.trim() !== "") {
      input.classList.add("active");
    }
  });
  

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });

  searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
    sidebar.classList.toggle("open");
    menuBtnChange(); //calling the function(optional)
  });

  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
   }
  }
