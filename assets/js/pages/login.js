function initPasswordToggle() {
    const passwordInput = document.querySelector('#inputPassword');
    const toggleButton = document.querySelector('[data-password-toggle]');

    if (!passwordInput || !toggleButton) {
        return;
    }

    if (toggleButton.dataset.initialized === 'true') {
        return;
    }

    const eyeOpen = toggleButton.querySelector('[data-eye-open]');
    const eyeClosed = toggleButton.querySelector('[data-eye-closed]');

    if (!eyeOpen || !eyeClosed) {
        return;
    }

    toggleButton.dataset.initialized = 'true';

    toggleButton.addEventListener('click', () => {
        const passwordIsHidden = passwordInput.type === 'password';

        passwordInput.type = passwordIsHidden
            ? 'text'
            : 'password';

        eyeOpen.hidden = passwordIsHidden;
        eyeClosed.hidden = !passwordIsHidden;

        toggleButton.setAttribute(
            'aria-pressed',
            String(passwordIsHidden)
        );

        toggleButton.setAttribute(
            'aria-label',
            passwordIsHidden
                ? 'Masquer le mot de passe'
                : 'Afficher le mot de passe'
        );

        toggleButton.setAttribute(
            'title',
            passwordIsHidden
                ? 'Masquer le mot de passe'
                : 'Afficher le mot de passe'
        );
    });
}

document.addEventListener(
    'DOMContentLoaded',
    initPasswordToggle
);

document.addEventListener(
    'turbo:load',
    initPasswordToggle
);

initPasswordToggle();