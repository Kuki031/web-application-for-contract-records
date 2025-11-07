"use strict"

export const syncPayments = function() {
    document.addEventListener('DOMContentLoaded', function () {
        const startPicker = document.getElementById('start_picker');
        const endPicker = document.getElementById('end_picker');

        const startMonthInput = document.getElementById('start_month');
        const startYearInput = document.getElementById('start_year');
        const endMonthInput = document.getElementById('end_month');
        const endYearInput = document.getElementById('end_year');

        const startLabel = document.getElementById('start_picker_label');
        const endLabel = document.getElementById('end_picker_label');

        function updateMonthLabel(picker, label) {
            if (!picker.value) {
                label.textContent = '';
                return;
            }
            const [year, month] = picker.value.split('-');
            const date = new Date(year, month - 1);
            const formatter = new Intl.DateTimeFormat('hr-HR', { year: 'numeric', month: 'long' });
            label.textContent = formatter.format(date);
        }

        function syncDateInputs(picker, monthInput, yearInput, label) {
            picker.addEventListener('change', function () {
                if (this.value) {
                    const [year, month] = this.value.split('-');
                    monthInput.value = month;
                    yearInput.value = year;
                    updateMonthLabel(picker, label);
                } else {
                    monthInput.value = '';
                    yearInput.value = '';
                    label.textContent = '';
                }
            });

            if (picker.value) {
                updateMonthLabel(picker, label);
            }
        }

        if(startPicker && startMonthInput && startYearInput && startLabel) syncDateInputs(startPicker, startMonthInput, startYearInput, startLabel);
        if(endPicker && endMonthInput && endYearInput && endLabel) syncDateInputs(endPicker, endMonthInput, endYearInput, endLabel);
    });
}
