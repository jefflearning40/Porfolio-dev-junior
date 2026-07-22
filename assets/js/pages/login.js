const passwordInput = document.querySelector('#inputPassword');
const toggleButton = document.querySelector('[data-password-toggle]');

if (passwordInput && toggleButton) {

    const eyeOpen = toggleButton.querySelector('[data-eye-open]');
    const eyeClosed = toggleButton.querySelector('[data-eye-closed]');

    toggleButton.addEventListener('click', () => {

        const isHidden = passwordInput.type === 'password';

        passwordInput.type = isHidden ? 'text' : 'password';

        eyeOpen.hidden = isHidden;
        eyeClosed.hidden = !isHidden;

        toggleButton.setAttribute(
            'aria-pressed',
            String(isHidden)
        );

        toggleButton.setAttribute(
            'aria-label',
            isHidden
                ? 'Masquer le mot de passe'
                : 'Afficher le mot de passe'
        );

    });

}