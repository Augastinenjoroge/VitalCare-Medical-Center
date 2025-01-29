document.addEventListener("DOMContentLoaded", function() {
    const signInSection = document.querySelector(".sign-in");
    const signUpSection = document.querySelector(".signup");

    const signInLink = document.querySelector(".sign-in .signup-image-link");
    const signUpLink = document.querySelector(".signup .signup-image-link");
    
    signInLink.addEventListener("click", function(event) {
        event.preventDefault();
        signUpSection.style.display = "block";
        signInSection.style.display = "none";
    });
    
    signUpLink.addEventListener("click", function(event) {
        event.preventDefault();
        signUpSection.style.display = "none";
        signInSection.style.display = "block";
    });

    // Initially, display only the sign-up form
    signInSection.style.display = "block";
    signUpSection.style.display = "none";
    
});
