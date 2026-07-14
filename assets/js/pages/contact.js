const initContactPage = () => {
    const privacyCheckbox = document.querySelector("#contact_privacy");
    const submitButton = document.querySelector("#contact_submit");

    const modal = document.querySelector("[data-privacy-modal]");
    const openModalButton = document.querySelector(
        "[data-privacy-modal-open]"
    );
    const closeModalButtons = document.querySelectorAll(
        "[data-privacy-modal-close]"
    );

    /* ===========================
       BOUTON ENVOYER
    =========================== */

    if (privacyCheckbox && submitButton) {
        const updateSubmitButton = () => {
            submitButton.disabled = !privacyCheckbox.checked;
        };

        updateSubmitButton();

        privacyCheckbox.removeEventListener(
            "change",
            updateSubmitButton
        );

        privacyCheckbox.addEventListener(
            "change",
            updateSubmitButton
        );
    }

    /* ===========================
       MODAL RGPD
    =========================== */

    if (!modal || !openModalButton) {
        return;
    }

    const openModal = (event) => {
        event.preventDefault();

        modal.classList.add("is-open");
        modal.setAttribute("aria-hidden", "false");

        document.body.classList.add("modal-open");
    };

    const closeModal = () => {
        modal.classList.remove("is-open");
        modal.setAttribute("aria-hidden", "true");

        document.body.classList.remove("modal-open");
    };

    openModalButton.onclick = openModal;

    closeModalButtons.forEach((button) => {
        button.onclick = closeModal;
    });

    document.onkeydown = (event) => {
        if (
            event.key === "Escape" &&
            modal.classList.contains("is-open")
        ) {
            closeModal();
        }
    };
};

document.addEventListener("DOMContentLoaded", initContactPage);
document.addEventListener("turbo:load", initContactPage);