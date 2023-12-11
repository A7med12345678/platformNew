document.getElementById("upload").classList.add("disabled");

// prevent loss force upload attemps :
if (localStorage.getItem("enbale_upload") === "yes") {
    document.getElementById("force").classList.add("disabled");
} else {
    // document.getElementById("force").classList.add("d-block");
    document.getElementById("force").classList.remove("disabled");
}

// force upload (if wrong upload) :
function forceUpload() {
    var limit = parseInt(localStorage.getItem("limit"));
    limit++;
    localStorage.setItem("limit", limit);
    if (localStorage.getItem("limit") > 12) {
        // Do something here if week is greater than 2
        alert("Sorry , please contact the developer.");
    } else {
        if (confirm("Are you sure you want to enable uploads?")) {
            localStorage.setItem("enbale_upload", "yes");
            location.reload();
        }
    }
}
// Load the values from local storage if they exist
if (localStorage.getItem("selected_week")) {
    document.querySelector("#week-selector").value =
        localStorage.getItem("selected_week");
}
if (localStorage.getItem("selected_section")) {
    document.querySelector("#section-selector").value =
        localStorage.getItem("selected_section");
}

document
    .getElementById("upload")
    .classList.toggle(
        "disabled",
        localStorage.getItem("enbale_upload") !== "yes"
    );

function store() {
    localStorage.setItem(
        "selected_week",
        document.querySelector("#week-selector").value
    );
    localStorage.setItem(
        "selected_section",
        document.querySelector("#section-selector").value
    );
    localStorage.setItem("enbale_upload", "yes");
}

function disable() {
    document.getElementById("upload").classList.add("disabled");
    localStorage.setItem("enbale_upload", "no");
}

// document.getElementById('upload').classList.add('disabled');
// prevent loss force upload attemps :
// if (localStorage.getItem("enbale_upload") === "yes") {
//     document.getElementById("force").classList.add("disabled");
// } else {
//     // document.getElementById("force").classList.add("d-block");
//     document.getElementById("force").classList.remove("disabled");
// }

// // force upload (if wrong upload) :
// function forceUpload() {
//     var limit = parseInt(localStorage.getItem("limit"));
//     limit++;
//     localStorage.setItem("limit", limit);
//     if (localStorage.getItem("limit") > 2) {
//         // Do something here if week is greater than 2
//         alert("Sorry , please contact the developer");
//     } else {
//         if (confirm("Are you sure you want to enable uploads?")) {
//             localStorage.setItem("enbale_upload", "yes");
//             location.reload();
//         }
//     }
// }

// // Load the values from local storage if they exist
// if (localStorage.getItem('selected_week')) {
//     document.getElementById('week-selector').value = localStorage.getItem('selected_week');
// }
// if (localStorage.getItem('selected_section')) {
//     document.getElementById('section-selector').value = localStorage.getItem('selected_section');
// }

// if (localStorage.getItem('enbale_upload') === "yes") {
//     document.getElementById('upload').classList.remove('disabled')
// } else if (localStorage.getItem('enbale_upload') === "no") {
//     document.getElementById('upload').classList.add('disabled');
// }

// function store() {
//     localStorage.setItem('selected_week', document.getElementById('week-selector').value);
//     localStorage.setItem('selected_section', document.getElementById('section-selector').value);
//     localStorage.setItem('enbale_upload', 'yes');

// }

// function disable() {
//     document.getElementById('upload').classList.add('disabled');
//     localStorage.setItem('enbale_upload', 'no');

// }
