function validate(event) {
    // Prevent default form submission to handle validation first
    event.preventDefault();

    // Get form inputs
    const teamName = document.getElementsByName('teamName')[0].value;
    const collegeName = document.getElementsByName('collegeName')[0].value;
    const teamLeader = document.getElementsByName('teamLeader')[0].value;
    const memberTwo = document.getElementsByName('memberTwo')[0].value;
    const memberThree = document.getElementsByName('memberThree')[0].value;
    const email = document.getElementsByName('email')[0].value;
    const mobileNumber = document.getElementsByName('mobileNumber')[0].value;
    const fileToUpload = document.getElementById('fileToUpload').files.length;

    // Regular expression patterns
    const stringRegex = /^[a-zA-Z ]+$/;
    const collegeNameRegex = /^[a-zA-Z ]+$/;
    const teamNameRegex = /^[A-Za-z]([a-z0-9_]*\d?)$/; // Team name must start with string and can be followed by numbers
    const emailRegex = /^[A-Za-z0-9\._%+\-]+@[A-Za-z0-9\.\-]+\.[A-Za-z]{2,}$/;
    const mobileRegex = /^[0-9]{10}$/;

    // Clear existing error messages
    document.querySelectorAll('.error').forEach(el => el.innerHTML = '');

    // Validation flags
    let isValid = true;

    // Team Name validation
    if (!teamNameRegex.test(teamName) || teamName.length < 5) {
        showError("teamName", "Team Name must start with a letter and be at least 5 characters long.");
        isValid = false;
    }

    // College Name validation
    if (!collegeNameRegex.test(collegeName) && collegeName.length < 10) {
        showError("collegeName", "Please provide a valid college name.");
        isValid = false;
    }
    // if () {
    //     // showError("collegeName", "Please provide a valid college name.");
    //     isValid = false;
    // }

    // Team Leader validation
    if (!stringRegex.test(teamLeader)) {
        showError("teamLeader", "Enter a valid name.");
        isValid = false;
    }

    // Member Two validation (optional)
    if (memberTwo && !stringRegex.test(memberTwo)) {
        showError("memberTwo", "Enter a valid name.");
        isValid = false;
    }

    // Member Three validation (optional)
    if (memberThree && !stringRegex.test(memberThree)) {
        showError("memberThree", "Enter a valid name.");
        isValid = false;
    }

    // Email validation
    if (!emailRegex.test(email)) {
        showError("email", "Enter a valid email address.");
        isValid = false;
    }

    // Mobile number validation
    if (!mobileRegex.test(mobileNumber)) {
        showError("mobileNumber", "Provide a valid 10-digit mobile number.");
        isValid = false;
    }

    // If all validation passes, submit form with loading indicator
    if (isValid) {
        showLoadingIndicator();

        // Simulate submission delay for loading (remove in production)
        setTimeout(() => {
            document.getElementById('registrationForm').submit(); // Submit form after validation
        }, 1000); // Adjust timeout if needed
    }
}

// Function to show error messages
function showError(inputName, message) {
    const inputField = document.getElementsByName(inputName)[0];
    const errorElement = document.createElement('div');
    errorElement.classList.add('error');
    errorElement.style.color = 'red';
    errorElement.textContent = message;
    inputField.after(errorElement);
}

// Function to show a loading indicator
function showLoadingIndicator() {
    const submitButton = document.querySelector('.form-submit-btn');
    submitButton.disabled = true;
    submitButton.textContent = 'Loading...'; // Change button text to show loading
}
