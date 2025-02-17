$(document).ready(function() {
    $('#signupform, #signinform').submit(function(event) {
        event.preventDefault();
        const form = $(this);
        const actionUrl = form.attr('action');
        const formData = form.serialize();

        // Validate Sign Up form
        if (form.attr('id') === 'signupform') {
            const dobInput = $('#dob').val();
            const emailInput = $('#email').val();
            const telnoInput = $('#telno').val();
            const addressInput = $('#address').val();
            const cityInput = $('#city').val();
            const postalcodeInput = $('#postalcode').val();

            if (!dobInput || !emailInput || !telnoInput || !addressInput || !cityInput || !postalcodeInput) {
                return; // Prevents checking empty fields
            }

            // Validate Date of Birth
            const dob = new Date(dobInput);
            const today = new Date();
            const age = today.getFullYear() - dob.getFullYear();
            const monthDiff = today.getMonth() - dob.getMonth();
            const dayDiff = today.getDate() - dob.getDate();

            if (age < 18 || (age === 18 && (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)))) {
                alert("You must be at least 18 years old to sign up.");
                return; // Prevent form submission
            }

            // Validate Email
            const emailReg = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            const telnoReg = /^[1-9][0-9]{9}$/;
            const addressReg = /^[1-9][0-9]* [a-zA-Z\s]+ *[a-zA-Z\s]* *[a-zA-Z\s]* *[a-zA-Z\s]*$/;
            const cityReg = /^[a-zA-Z]+$/;
            const postalcodeReg = /^[a-zA-Z][0-9][a-zA-Z][0-9][a-zA-Z][0-9]$/;

            if (!emailReg.test(emailInput)) {
                alert("Invalid Email Address.");
                return; // Prevent form submission
            } else if (!telnoReg.test(telnoInput)) {
                alert("Invalid Telephone Number.");
                return; // Prevent form submission
            } else if (!addressReg.test(addressInput)) {
                alert("Invalid Address.");
                return; // Prevent form submission
            } else if (!cityReg.test(cityInput)) {
                alert("Invalid City Entered.");
                return; // Prevent form submission
            } else if (!postalcodeReg.test(postalcodeInput)) {
                alert("Invalid Postal Code.");
                return; // Prevent form submission
            }
        }

        $.post(actionUrl, formData, function(response) {
            if (response.redirect) {
                window.location.href = response.redirect;
            } else {
                alert('An error occurred. Please try again.');
            }
        }).fail(function() {
            alert('An error occurred. Please try again.');
        });
    });
});