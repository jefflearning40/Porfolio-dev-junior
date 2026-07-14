document.addEventListener("DOMContentLoaded", () => {
    const privacyCheckbox = document.querySelector("#contact_privacy");
    const submitButton = document.querySelector("#contact_submit");

    const modal = document.querySelector("[data-privacy-modal]");
    const openModalButton = document.querySelector(
        "[data-privacy-modal-open]"
    );
    const closeModalButtons = document.querySelectorAll(
        "[data-privacy-modal-close]"
    );

    if (privacyCheckbox && submitButton) {
        const updateSubmitButton = () => {
            submitButton.disabled = !privacyCheckbox.checked;
        };

        updateSubmitButton();

        privacyCheckbox.addEventListener(
            "change",
            updateSubmitButton
        );
    }

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

    openModalButton.addEventListener("click", openModal);

    closeModalButtons.forEach((button) => {
        button.addEventListener("click", closeModal);
    });

    document.addEventListener("keydown", (event) => {
        if (
            event.key === "Escape" &&
            modal.classList.contains("is-open")
        ) {
            closeModal();
        }
    });
});