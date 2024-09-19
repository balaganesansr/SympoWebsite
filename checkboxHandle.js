const checkboxes = document.querySelectorAll('.event-checkboxes input[type="checkbox"]');
    const maxSelections = 3;

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const checkedCount = document.querySelectorAll('.event-checkboxes input[type="checkbox"]:checked').length;

            if (checkedCount >= maxSelections) {
                // Disable all unchecked checkboxes
                checkboxes.forEach(cb => {
                    if (!cb.checked) {
                        cb.disabled = true;
                    }
                });
            } else {
                // Enable all checkboxes if less than maxSelections
                checkboxes.forEach(cb => {
                    cb.disabled = false;
                });
            }
        });
    });