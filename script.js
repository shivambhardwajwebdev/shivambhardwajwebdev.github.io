document.addEventListener("DOMContentLoaded", function() {

    // --- 1. Active Page Link Highlighter ---
    // Get the current page's file name (e.g., "contact.html")
    const currentPage = window.location.pathname.split("/").pop() || "index.html";

    // Get all navigation links
    const navLinks = document.querySelectorAll("nav a");

    navLinks.forEach(link => {
        // Get the link's file name
        const linkPage = link.getAttribute("href").split("/").pop();

        // Remove any existing 'active' class
        link.classList.remove("active");

        // If the link's page matches the current page, add 'active' class
        if (linkPage === currentPage) {
            link.classList.add("active");
        }
    });


    // --- 2. Contact Form Status Handler ---
    // Check if we are on the contact page
    const formStatus = document.getElementById("form-status");
    if (formStatus) {
        
        // Get the URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        if (status === 'success') {
            formStatus.innerHTML = "Thanks! Your message has been sent successfully.";
            formStatus.className = 'status-success';
        } else if (status === 'error') {
            formStatus.innerHTML = "Please fill out all fields correctly.";
            formStatus.className = 'status-error';
        } else if (status === 'server-error') {
            formStatus.innerHTML = "Oops! Something went wrong on our end. Please try again later.";
            formStatus.className = 'status-error';
        }
    }

});