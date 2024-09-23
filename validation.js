    function validate() {
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
        // const stringRegex = /^[a-zA-Z]+[a-zA-Z0-9 ]*$/;
        const stringRegex = /^[a-zA-Z ]+$/;
        const collegeNameRegex = /^[a-zA-Z ]+$/;

        const teamNameRegex = /^[a-zA-Z][a-zA-Z0-9]{4,}$/;  // Team name must start with string and can be followed by numbers
        const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
        const mobileRegex = /^[0-9]{10}$/;

        // Clear existing error messages
        document.querySelectorAll('.error').forEach(el => el.innerHTML = '');

        // Validation flags
        let isValid = true;

        // Team Name validation
        if (!teamNameRegex.test(teamName)) {
            showError("teamName", "Team Name must start with a letter and be at least 5 characters long.");
            isValid = false;
        }


        // College Name validation
        if (!collegeNameRegex.test(collegeName)) {
            showError("collegeName", "Please provide a valid college name");
            isValid = false;
        }
        if(collegeName.length<10){
            // showError("collegeName", "Please provide a valid college name");
            isValid = false;
        }

        // Team Leader validation
        if (!stringRegex.test(teamLeader)) {
            showError("teamLeader", "Team Leader must contain only letters.");
            isValid = false;
        }

        // Member Two validation (optional)
        if (memberTwo && !stringRegex.test(memberTwo)) {
            showError("memberTwo", "Member Two must contain only letters.");
            isValid = false;
        }

        // Member Three validation (optional)
        if (memberThree && !stringRegex.test(memberThree)) {
            showError("memberThree", "Member Three must contain only letters.");
            isValid = false;
        }

        // Email validation
        if (!emailRegex.test(email)) {
            showError("email", "Email must be a valid Gmail address.");
            isValid = false;
        }

        // Mobile number validation
        if (!mobileRegex.test(mobileNumber)) {
            // showError("mobileNumber", "Provide valid mobile number");
            isValid = false;
        }if (mobileNumber.length<10) {
            showError("mobileNumber", "Provide valid mobile number");
            isValid = false;
        }

        // If all validation passes, submit form with loading indicator
        if (isValid) {
            showLoadingIndicator();

            // Simulate submission delay for loading (remove in production)
            setTimeout(() => {
                document.getElementById('registrationForm').submit(); // Submit form after validation
            }, 2000); // Adjust timeout if needed
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

