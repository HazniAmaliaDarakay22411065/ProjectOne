document.addEventListener("DOMContentLoaded", function () {
    // Toggle Password Visibility
    const togglePassword = document.querySelector("#togglePassword");
    const passwordInput = document.querySelector("input[name='password']");
    const eyeIcon = document.getElementById("eyeIcon");

    if (togglePassword && passwordInput && eyeIcon) {
        togglePassword.addEventListener("click", function () {
            const type = passwordInput.type === "password" ? "text" : "password";
            passwordInput.type = type;

            eyeIcon.classList.toggle("bi-eye-slash");
        });
    }

    // Perhitungan angka
    const counters = document.querySelectorAll("strong[id$='-count']");

    function animateCounter(counter) {
        const target = +counter.getAttribute("data-target");
        let current = 0;
        const increment = Math.ceil(target / 100);
        const duration = 2000;
        const intervalTime = duration / (target / increment);

        function updateCounter() {
            current += increment;
            if (current >= target) {
                counter.innerText = target;
            } else {
                counter.innerText = current;
                setTimeout(updateCounter, intervalTime);
            }
        }

        updateCounter();
    }

    function handleScrollAnimation() {
        counters.forEach(counter => {
            const rect = counter.getBoundingClientRect();
            if (rect.top < window.innerHeight && counter.innerText === "0") {
                animateCounter(counter);
            }
        });
    }

    window.addEventListener("scroll", handleScrollAnimation);
    handleScrollAnimation();

    
}); 