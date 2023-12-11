/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*************************************************************!*\
  !*** ./resources/assets/js/student-js/clearlocalStorage.js ***!
  \*************************************************************/
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
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!***********************************************!*\
  !*** ./resources/assets/js/student-js/nav.js ***!
  \***********************************************/
function test() {
  var tabsNewAnim = document.getElementById('navbarSupportedContent');
  var selectorNewAnim = tabsNewAnim.querySelectorAll('li').length;
  var activeItemNewAnim = tabsNewAnim.querySelector('.active');
  var activeWidthNewAnimHeight = activeItemNewAnim.offsetHeight;
  var activeWidthNewAnimWidth = activeItemNewAnim.offsetWidth;
  var itemPosNewAnimTop = activeItemNewAnim.offsetTop;
  var itemPosNewAnimLeft = activeItemNewAnim.offsetLeft;
  var horiSelector = document.querySelector(".hori-selector");
  horiSelector.style.top = itemPosNewAnimTop + "px";
  horiSelector.style.left = itemPosNewAnimLeft + "px";
  horiSelector.style.height = activeWidthNewAnimHeight + "px";
  horiSelector.style.width = activeWidthNewAnimWidth + "px";
  tabsNewAnim.addEventListener("click", function (e) {
    var target = e.target.closest('li');
    if (!target) return;
    var links = tabsNewAnim.querySelectorAll('li');
    links.forEach(function (link) {
      link.classList.remove("active");
    });
    target.classList.add('active');
    var activeWidthNewAnimHeight = target.offsetHeight;
    var activeWidthNewAnimWidth = target.offsetWidth;
    var itemPosNewAnimTop = target.offsetTop;
    var itemPosNewAnimLeft = target.offsetLeft;
    horiSelector.style.top = itemPosNewAnimTop + "px";
    horiSelector.style.left = itemPosNewAnimLeft + "px";
    horiSelector.style.height = activeWidthNewAnimHeight + "px";
    horiSelector.style.width = activeWidthNewAnimWidth + "px";

    // Collapse the navbar after clicking a link on mobile
    if (window.innerWidth < 768) {
      var navbarCollapse = document.querySelector(".navbar-collapse");
      navbarCollapse.classList.remove("show");
    }
  });
}
document.addEventListener("DOMContentLoaded", function () {
  setTimeout(function () {
    test();
  });
});
window.addEventListener('resize', function () {
  setTimeout(function () {
    test();
  }, 500);
});
var navbarToggler = document.querySelector(".navbar-toggler");
navbarToggler.addEventListener("click", function () {
  var navbarCollapse = document.querySelector(".navbar-collapse");
  navbarCollapse.classList.toggle("show");
  setTimeout(function () {
    test();
  });
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*************************************************************!*\
  !*** ./resources/assets/js/student-js/profileAutoUpload.js ***!
  \*************************************************************/
function submitForm() {
  document.getElementById("profile-form").submit();
}
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!********************************************************!*\
  !*** ./resources/assets/js/student-js/searchJquery.js ***!
  \********************************************************/
$(document).ready(function () {
  $("#search").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    var foundMatch = false;
    $(".week-content").each(function () {
      var weekTitle = $(this).find(".title").text().toLowerCase();
      if (weekTitle.indexOf(value) > -1) {
        $(this).show();
        foundMatch = true;
      } else {
        $(this).hide();
      }
    });
    if (!foundMatch) {
      // If no match is found, hide the container holding all weeks
      $("#arc").hide();
    } else {
      $("#arc").show();
    }
  });
});
})();

/******/ })()
;