document.addEventListener("DOMContentLoaded", () => {

    const accordions = document.querySelectorAll(".project-accordion");

    accordions.forEach((accordion) => {

        accordion.addEventListener("toggle", () => {

            if (!accordion.open) {
                return;
            }

            accordions.forEach((otherAccordion) => {

                if (otherAccordion !== accordion) {
                    otherAccordion.removeAttribute("open");
                }

            });

        });

    });

});