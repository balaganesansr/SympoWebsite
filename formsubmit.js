// document.getElementById('registrationForm').addEventListener('submit', function(e) {
//     e.preventDefault(); // Prevent the form from submitting the normal way

//     const form = document.getElementById('registrationForm');
//     const formData = new FormData(form); // Collect the form data
//     const checkboxes = form.querySelectorAll('input[type="checkbox"]');
//     const errorMessages = document.getElementById('errorMessages');
//     const successMessage = document.getElementById('successMessage');

//     // Reset messages
//     errorMessages.innerHTML = '';
//     successMessage.innerHTML = '';

//     // Validation
//     let errors = [];
//     let selectedEvents = 0;
    
//     // Check required fields
//     if (!form['teamName'].value.trim()) errors.push("Team name is required.");
//     if (!form['collegeName'].value.trim()) errors.push("College name is required.");
//     if (!form['leader'].value.trim()) errors.push("Team leader's name is required.");
//     if (!form['email'].value.trim() || !/\S+@\S+\.\S+/.test(form['email'].value)) errors.push("Invalid email format.");
//     if (!form['mobileNumber'].value.trim() || !/^\d{10}$/.test(form['mobileNumber'].value)) errors.push("Mobile number must be a 10-digit number.");

//     // Check at least one checkbox is selected
//     selectedEvents = Array.from(checkboxes).filter(cb => cb.checked).length;
//     if (selectedEvents === 0) errors.push("At least one event must be selected.");
//     if (selectedEvents > 3) errors.push("You can select a maximum of 3 events.");

//     // Check if payment screenshot is provided
//     if (!form['payment-screenshot'].files.length) errors.push("Payment screenshot is required.");

//     if (errors.length > 0) {
//         // Display errors
//         errors.forEach(error => {
//             errorMessages.innerHTML += `<p>${error}</p>`;
//         });
//     } else {
//         // Disable checkboxes before submission
//         checkboxes.forEach(cb => cb.disabled = true);

//         // Send form data via AJAX
//         fetch('./register.php', {
//             method: 'POST',
//             body: formData
//         })
//         .then(response => response.json()) // Convert the response to JSON
//         .then(data => {
//             if (data.status === 'success') {
//                 // Show success message
//                 successMessage.innerHTML = "Registration successful!";
//             } else {
//                 // Show error messages
//                 data.errors.forEach(error => {
//                     errorMessages.innerHTML += `<p>${error}</p>`;
//                 });
//             }
//         })
//         .catch(error => console.error('Error:', error));
        
//     }
// });

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