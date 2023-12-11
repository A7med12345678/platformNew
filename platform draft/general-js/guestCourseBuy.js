   // JavaScript to toggle between forms
   const buyFormToggle = document.getElementById("buyFormToggle");
   const getFormToggle = document.getElementById("getFormToggle");
   const buyForm = document.getElementById("buy");
   const getForm = document.getElementById("get");

   // Initially, make sure the "Buy Course" form is visible
   buyForm.style.display = "block";
   getForm.style.display = "none";

   buyFormToggle.addEventListener("change", () => {
       if (buyFormToggle.checked) {
           buyForm.style.display = "block";
           getForm.style.display = "none";
       }
   });

   getFormToggle.addEventListener("change", () => {
       if (getFormToggle.checked) {
           buyForm.style.display = "none";
           getForm.style.display = "block";
       }
   });