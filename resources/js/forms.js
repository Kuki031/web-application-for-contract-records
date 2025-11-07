export const handleDeleteForms = function() {

    Array.from(document.querySelectorAll('.delete-resource'))
    ?.forEach(form => {
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            const confirm = prompt("Želite li izbrisati ovu stavku? Upisati 'y' za potvrdu.");
            if (confirm === 'Y' || confirm === 'y') form.submit();
        });
    });
}

export const handlePDFuploadForms = function() {

    Array.from(document.querySelectorAll('.pdf-form'))
    ?.forEach(form => {
            form.querySelector('input[type="file"]')?.addEventListener("change", (e) => {
            e.preventDefault();
            let mainEl = e.currentTarget;

            if (mainEl.files.length > 0) form.submit();
        });
    });
}

export const handleCreatePaymentNote = function() {
    document.querySelectorAll('.payment-note-create')?.forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();

            let mainEl = e.target;
            const btn = mainEl.querySelector("button");

            if (!btn.textContent.includes("+")) {
                mainEl.submit();
                return;
            }

            const note = prompt("Unesi napomenu: ");
            const formField = e.currentTarget.querySelector('[name="note"]');
            formField.value = note;
            if (note) e.currentTarget.submit();
        })
    })
}

export const handleUpdatePaymentNote = function() {
    document.querySelectorAll('.payment-note-update')?.forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();

            let mainEl = e.target;
            const btn = mainEl.querySelector("button");
            const formField = e.currentTarget.querySelector('[name="note"]');

            const note = prompt(`Uredi napomenu: ${formField.value}`);

            if (note) {
                formField.value = note;
                e.currentTarget.submit();
            } else {
                return;
            }
        })
    })
}

export const handleRadioDomains = function () {
    const inputs = document.querySelectorAll('.radio-input-wrap .input-r');
    const labelRadio = document.querySelector('label[for="is_redirected_where"]');
    const inputRedirectedWhere = document.querySelector('input[name="is_redirected_where"]');

    const toggleRedirectedInput = () => {
        const checked = document.querySelector('.radio-input-wrap .input-r:checked');
        if (checked?.value === '1') {
            labelRadio.classList.remove('hidden');
            inputRedirectedWhere.classList.remove('hidden');
        } else {
            labelRadio?.classList.add('hidden');
            inputRedirectedWhere?.classList.add('hidden');
            if (inputRedirectedWhere) {
                inputRedirectedWhere.value = '';
            }
        }
    };

    toggleRedirectedInput();
    inputs.forEach(input => input.addEventListener('click', toggleRedirectedInput));
};

