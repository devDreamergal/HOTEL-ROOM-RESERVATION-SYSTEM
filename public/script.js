document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("reservationForm");

    form.addEventListener("submit", submitForm);
});

function submitForm(event) {
     event.preventDefault(); // Prevent default form submission behavior
 // Capture form data
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const roomType = document.getElementById("roomType").value;

    // Here, you can add your logic to handle form data, such as sending it to a server
    // For demonstration, we will log the data and simulate a successful booking

    console.log("Name:", name);
    console.log("Email:", email);
    console.log("Room Type:", roomType);

    // Simulate room booking success and redirect
    const successMessage = `Room booking successful for ${name}! Room type: ${roomType}`;
    alert(successMessage);

    // Redirect to a confirmation page or another relevant page
    window.location.href = "confirmation.html"; // Change this to your desired URL
}

document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("reservationForm");

    form.addEventListener("submit", submitForm);
});

function submitForm(event) {
    event.preventDefault(); // Prevent default form submission behavior

    // Capture form data
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const roomType = document.getElementById("roomType").value;

    // For demonstration, we will log the data and simulate a successful booking
    console.log("Name:", name);
    console.log("Email:", email);
    console.log("Room Type:", roomType);

    // Provide immediate feedback to the user
    const feedbackDiv = document.getElementById("feedback");
    feedbackDiv.style.display = "block";

    // Simulate a delay (e.g., for server processing) and then redirect
    setTimeout(() => {
        // Redirect to a confirmation page or another relevant page
        window.location.href = "confirmation.html"; // Change this to your desired URL
    }, 3000); // Redirect after 3 seconds
}
