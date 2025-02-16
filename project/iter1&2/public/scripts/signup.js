document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("signupform").addEventListener("submit", function (event) {
        const dobInput = document.getElementById("dob").value;
        if (!dobInput) return; // Prevents checking empty fields

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
    });
});