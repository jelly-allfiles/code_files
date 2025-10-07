
        // Password strength validation
        const passwordInput = document.getElementById("password");
        const passwordError = document.getElementById("password-error");
        const submitBtn = document.getElementById("submit-btn");

        function checkPasswordStrength(password) {
            const regex = /^(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
            return regex.test(password);
        }

        passwordInput.addEventListener("input", function () {
            const password = passwordInput.value;

            if (checkPasswordStrength(password)) {
                passwordError.style.display = "none";
                submitBtn.disabled = false;
            } else {
                passwordError.style.display = "inline";
                submitBtn.disabled = true;
            }
        });
  