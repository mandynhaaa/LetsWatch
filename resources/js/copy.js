document.addEventListener('DOMContentLoaded', function () {
    const copyButton = document.getElementById('copy-invite');
    const codeElement = document.getElementById('invite-code');

    if (copyButton && codeElement) {
        copyButton.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(codeElement.textContent.trim());
                copyButton.textContent = 'Copiado';
                copyButton.classList.remove('bg-[#2a2a2a]');
                copyButton.classList.add('bg-emerald-600');
                setTimeout(() => {
                    copyButton.textContent = 'Copiar';
                    copyButton.classList.remove('bg-emerald-600');
                    copyButton.classList.add('bg-[#2a2a2a]');
                }, 3000);
            } catch (err) {
                console.error('Falha ao copiar código', err);
            }
        });
    }
});