document.addEventListener("DOMContentLoaded", function () {
    // Validate Sign Up form
    document.getElementById("signupform").addEventListener("submit", function (event) {
        //Get the values from the form
        const dobInput = document.getElementById("dob").value;
        const emailInput = document.getElementById("email").value;
        const telnoInput = document.getElementById("telno").value;
        const addressInput = document.getElementById("address").value;
        const cityInput = document.getElementById("city").value;
        const postalcodeInput = document.getElementById("postalcode").value;
        if (!dobInput) return; // Prevents checking empty fields
        if (!emailInput) return; // Prevents checking empty fields
        if (!telnoInput) return; // Prevents checking empty fields
        if (!addressInput) return; // Prevents checking empty fields
        if (!cityInput) return; // Prevents checking empty fields
        if (!postalcodeInput) return; // Prevents checking empty fields

        // Validate Date of Birth
        const dob = new Date(dobInput);
        const today = new Date();
        const age = today.getFullYear() - dob.getFullYear();
        const monthDiff = today.getMonth() - dob.getMonth();
        const dayDiff = today.getDate() - dob.getDate();

        // Check if the user is under 18
        if (age < 18 || (age === 18 && (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)))) {
            alert("You must be at least 18 years old to sign up.");
            event.preventDefault(); // Prevent form submission
        }

        //Validate Email
        const emailReg = new RegExp("^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$");
        const telnoReg = new RegExp("^[1-9][0-9]{9}$");
        const addressReg = new RegExp("^[1-9][0-9]* [a-zA-Z\s]+ *[a-zA-Z\s]* *[a-zA-Z\s]* *[a-zA-Z\s]*$");
        const cityReg = new RegExp("^[a-zA-Z]+");
        const postalcodeReg = new RegExp("^[a-zA-Z][0-9][a-zA-Z][0-9][a-zA-Z][0-9]$");

        if (!emailReg.test(emailInput)) {
            alert("Invalid Email Address.")
            event.preventDefault();
        }
        //Validate Telephone Number

        else if (!telnoReg.test(telnoInput)) {
            alert("Invalid Telephone Number.")
            event.preventDefault();
        }
        //Validate Address
        
        else if (!addressReg.test(addressInput)) {
            alert("Invalid Address.")
            event.preventDefault();
        }
        //Validate City
    
        else if (!cityReg.test(cityInput)) {
            alert("Invalid City Entered.")
            event.preventDefault();
        }
        //Validate Postal Code

        else if (!postalcodeReg.test(postalcodeInput)) {
            alert("Invalid Postal Code.")
            event.preventDefault();
        }
    });
});