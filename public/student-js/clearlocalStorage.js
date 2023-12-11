// 2 ways :

  // Function to delete all properties from localStorage
  function deleteAllProperties() {
    // Clear all properties in localStorage
    localStorage.clear();

    alert(".حاول الدخول للامتحان الآن");
  }

  // Add an event listener to the button to trigger the deletion of properties
  document.getElementById("deleteAllPropertiesButton").addEventListener("click", deleteAllProperties);
  
  
// function deleteAllProperties() {
//     // Iterate through all keys in localStorage and remove them
//     for (let i = 0; i < localStorage.length; i++) {
//       const key = localStorage.key(i);
//       localStorage.removeItem(key);
//     }

//     alert(".حاول الدخول للامتحان الآن");
//   }

//   // Add an event listener to the button to trigger the deletion of properties
//   document.getElementById("deleteAllPropertiesButton").addEventListener("click", deleteAllProperties);
