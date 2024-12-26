// Show and hide the navigation menu
function showmenu() {
    const navLinks = document.getElementById("navlinks");
    navLinks.style.right = "0";
}

function hidemenu() {
    const navLinks = document.getElementById("navlinks");
    navLinks.style.right = "-200px";
}

// Dynamic greeting based on the time of the day
function displayGreeting() {
    const currentTime = new Date().getHours();
    let greeting;

    if (currentTime < 12) {
        greeting = "Good Morning!";
    } else if (currentTime < 18) {
        greeting = "Good Afternoon!";
    } else {
        greeting = "Good Evening!";
    }

    // Display greeting at the top of the page
    const header = document.querySelector(".hedder nav");
    const greetingElement = document.createElement("p");
    greetingElement.textContent = greeting;
    greetingElement.style.color = "white";
    greetingElement.style.textAlign = "center";
    greetingElement.style.fontSize = "18px";
    header.insertBefore(greetingElement, header.firstChild);
}

// Scroll-to-top button functionality
function createScrollToTopButton() {
    const button = document.createElement("button");
    button.textContent = "↑";
    button.id = "scrollToTop";
    button.style.position = "fixed";
    button.style.bottom = "20px";
    button.style.right = "20px";
    button.style.backgroundColor = "green";
    button.style.color = "white";
    button.style.border = "none";
    button.style.padding = "10px";
    button.style.cursor = "pointer";
    button.style.display = "none"; // Initially hidden
    document.body.appendChild(button);

    // Show button on scroll
    window.addEventListener("scroll", () => {
        if (window.scrollY > 300) {
            button.style.display = "block";
        } else {
            button.style.display = "none";
        }
    });

    // Scroll to top on click
    button.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
}

// Initialize the dynamic features on page load
window.onload = () => {
    displayGreeting();
    createScrollToTopButton();
};
