import "./bootstrap";

import Alpine from "alpinejs";

import Tooltip from "@ryangjchandler/alpine-tooltip";

Alpine.plugin(Tooltip);

window.Alpine = Alpine;

Alpine.start();




// DIPSLAYING IMAGE
document
    .getElementById("student_image")
    .addEventListener("change", function (event) {
        const [file] = event.target.files; // get the selected file
        if (file) {
            const preview = document.getElementById("student_image_preview");
            preview.src = URL.createObjectURL(file); // set preview
        }
    });
