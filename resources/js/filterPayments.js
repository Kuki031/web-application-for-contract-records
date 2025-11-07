export const filterForm = document.querySelector('.filter')?.addEventListener('submit', function(e) {
    e.preventDefault();

    const inputs = Array.from(this.querySelectorAll('input'));
    const emptyInputs = inputs.some(x => !x.value);

    if (emptyInputs) {
        return;
    }
    this.submit();
});
