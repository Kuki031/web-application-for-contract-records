export const handleMorphNote = function() {
    const morphNoteFormBtn = document.querySelector('.new-note')
    morphNoteFormBtn?.addEventListener('click', function(e) {
        e.preventDefault();
        let mainEl = e.target;

        const notePrompt = prompt("Unesi napomenu: ");
        if (!notePrompt) {
            return;
        }

        let noteInput = document.querySelector('input[name="note"]');
        noteInput.value = notePrompt;

        mainEl.parentElement.submit();
    })
}


export const handleDeleteMorphNote = function() {
    const btns = document.querySelectorAll('.delete-note');
    btns?.forEach(button => {
        button.addEventListener('click', function(e) {
        e.preventDefault();
        let mainEl = e.target;

        const confirm = prompt("Želite li izbrisati ovu stavku? Upisati 'y'");
            if (confirm === 'y' || confirm === 'Y')
            {
                mainEl.parentElement.submit();
            }
            else {
                return;
            }
        })
    })
}


export const handleUpdateMorphNote = function () {
    document.querySelectorAll('.morph-note-form--update')?.forEach(form => {
        const button = form.querySelector('button[type="submit"]');
        button.addEventListener('click', (e) => {
            e.preventDefault();

            const noteInput = form.querySelector('input[name="note"]');
            const noteText = prompt(`Uredi napomenu: ${noteInput.value}`);

            if (!noteText) return;

            noteInput.value = noteText;
            form.submit();
        });
    });
};



