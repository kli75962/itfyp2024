function setFormMessage(formElement, type, message) {
    const messageElement = formElement.querySelector(".form__message");

    messageElement.textContent = message;
    messageElement.classList.remove("form__message--success", "form__message--error");
    messageElement.classList.add(`form__message--${type}`);
}

function setInputError(inputElement, message) {
    inputElement.classList.add("form__input--error");
    inputElement.parentElement.querySelector(".form__input-error-message").textContent = message;
}

function clearInputError(inputElement) {
    inputElement.classList.remove("form__input--error")
    inputElement.parentElement.querySelector(".form__input-error-message").textContent = "";
}

document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector("#login");
    const createAccountForm = document.querySelector("#createAccount");
    const customerCreateAccountForm = document.querySelector("#customerCreateAccount");
    const employeeCreateAccount = document.querySelector("#employeeCreateAccount");

    // Handle between two form
    // Hide loginForm when createAccountForm appear
    document.querySelector("#linkCreateAccount").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.add("form--hidden");
        createAccountForm.classList.remove("form--hidden");
    });
    
    // Hide createAccountForm when loginForm appear
    document.querySelector("#linkLogin").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.remove("form--hidden");
        createAccountForm.classList.add("form--hidden");
    });

    loginForm.addEventListener("submit", e => {
        e.preventDefault();
        const loginUsername = document.getElementById("loginUsername").value;
        const loginPassword = document.getElementById("loginPassword").value;
      
        // Perform your AJAX/Fetch login
        if (loginUsername === "customer" && loginPassword === "customer") {
          setFormMessage(loginForm, "success", "Login success!");
          // Wait for 2 seconds and then redirect to customerMain.php
          setTimeout(() => {
            window.location.href='booking.php';
          }, 2000);
        } else if (loginUsername === "employee" && loginPassword === "employee") {
          setFormMessage(loginForm, "success", "Login success!");
          // Wait for 2 seconds and then redirect to restaurantMenu.php
          setTimeout(() => {
            window.location.href = "";
          }, 2000);
        } else {
          setFormMessage(loginForm, "error", "Invalid username/password combination!");
        }
      });

    // Transder to specific registration form
    createAccountForm.addEventListener("submit", e => {
        e.preventDefault();
        const registrationType = document.getElementById("userType").value;
    
        if (registrationType === "customer") {
            createAccountForm.classList.add("form--hidden");
            customerCreateAccountForm.classList.remove("form--hidden");
        } else {
            createAccountForm.classList.add("form--hidden");
            employeeCreateAccount.classList.remove("form--hidden");
        }
    });

    // Check customer registration
    customerCreateAccountForm.addEventListener("submit", e => {
        e.preventDefault();
        const signupUsernameC = document.getElementById("signupUsernameC").value;
        const signupEmailC = document.getElementById("signupEmailC").value;
        const signupPhoneNumberC = document.getElementById("signupPhoneNumberC").value;
        const signupPasswordC = document.getElementById("signupPasswordC").value;
        const signupPasswordConfirmC = document.getElementById("signupPasswordConfirmC").value;
        const signupTermAndConditionC = document.getElementById("termsCheckboxC").checked;
    
        // Perform your AJAX/Fetch login
        if (signupUsernameC && signupEmailC && signupPhoneNumberC && signupPasswordC && signupPasswordConfirmC && signupTermAndConditionC) {
            setFormMessage(customerCreateAccountForm, "success", "Account created successfully!");
        } else {
            setFormMessage(customerCreateAccountForm, "error", "Information is not completed! Please try again");
        }
    });

    // Check employee registration
    employeeCreateAccount.addEventListener("submit", e => {
        e.preventDefault();
        const signupUsernameE = document.getElementById("signupUsernameE").value;
        const signupPasswordE = document.getElementById("signupPasswordE").value;
        const signupPasswordConfirmE = document.getElementById("signupPasswordConfirmE").value;
        const signupTermAndConditionE = document.getElementById("termsCheckboxE").checked;

        // Perform your AJAX/Fetch login
        if (signupUsernameE && signupPasswordE && signupPasswordConfirmE && signupTermAndConditionE) {
            setFormMessage(employeeCreateAccount, "success", "Account created successfully!");
        } else {
            setFormMessage(employeeCreateAccount, "error", "Information is not completed! Please try again");
        }
    });

    // Handle terms and condition form
    document.getElementById("customertermAndCondition").addEventListener("click", function(event) {
        event.preventDefault();
        customerCreateAccountForm.classList.add("form--hidden");
        document.getElementById("termsForm").style.display = "block";
        p = customerCreateAccountForm;
    });

    document.getElementById("employeetermAndCondition").addEventListener("click", function(event) {
        event.preventDefault();
        employeeCreateAccount.classList.add("form--hidden");
        document.getElementById("termsForm").style.display = "block";
        p = employeeCreateAccount;
    });

    document.querySelector(".policy__button").addEventListener("click", function(event) {
        event.preventDefault();
        document.getElementById("termsForm").style.display = "none";
        p.classList.remove("form--hidden")
    });

    document.querySelectorAll(".form__input").forEach(inputElement => {
        function validateUsername(inputElement) {
            const username = inputElement.value.trim();
        
            if (username === "") {
                setInputError(inputElement, "Username is required! Please enter a username.");
            } else if (username.length < 10) {
                setInputError(inputElement, "Username must be at least 10 characters in length.");
            } else {
                clearInputError(inputElement);
            }
        }
        
        const usernameInputC = document.getElementById("signupUsernameC");
        usernameInputC.addEventListener("blur", e => {
            validateUsername(e.target);
        });
        
        // Verify Employee ID
        function validateEmployeeID(inputElement) {
            const employeeID = inputElement.value.trim();
        
            if (employeeID === "") {
                setInputError(inputElement, "Employee ID is required! Please enter a employee ID.");
            } else if (employeeID.length < 6 || employeeID != "s%%%%%") {
                setInputError(inputElement, "Employee must be 1 letter with 5 characters in length.");
            } else {
                clearInputError(inputElement);
            }
        }

        const usernameInputE = document.getElementById("signupUsernameE");
        usernameInputE.addEventListener("blur", e => {
            validateEmployeeID(e.target);
        });

        function validateEmail(inputElement) {
            const email = inputElement.value.trim();
        
            if (email === "") {
                setInputError(inputElement, "Email is required! Please enter an email address.");
            } else if (!isValidEmail(email)) {
                setInputError(inputElement, "Invalid email format! Please enter a valid email address.");
            } else {
                clearInputError(inputElement);
            }
        }
        
        const emailInputC = document.getElementById("signupEmailC");
        emailInputC.addEventListener("blur", e => {
            validateEmail(e.target);
        });
        
        // Check email input
        function isValidEmail(email) {
            // Use a regular expression to validate email format
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validatePhoneNumber(inputElement) {
            const phoneNumber = inputElement.value.trim();
        
            if (phoneNumber === "") {
                setInputError(inputElement, "Phone number is required! Please enter your number.");
            } else if (phoneNumber.length !== 8) {
                setInputError(inputElement, "Phone number must be 8 digits in length.");
            } else {
                clearInputError(inputElement);
            }
        }
        
        const phoneNumberInputC = document.getElementById("signupPhoneNumberC");
        phoneNumberInputC.addEventListener("blur", e => {
            validatePhoneNumber(e.target);
        });

        // Checking password
        function validatePassword(inputElement) {
            const password = inputElement.value;
        
            if (password === "") {
                setInputError(inputElement, "Password is required! Please enter a password.");
            } else if (password.length < 13) {
                setInputError(inputElement, "Password must be at least 13 characters in length.");
            } else if (!containsCharacterAndNumber(password)) {
                setInputError(inputElement, "Password must contain both characters and numbers.");
            } else {
                clearInputError(inputElement);
            }
        }
        
        const passwordInputC = document.getElementById("signupPasswordC");
        passwordInputC.addEventListener("blur", e => {
            validatePassword(e.target);
        });
        
        const passwordInputE = document.getElementById("signupPasswordE");
        passwordInputE.addEventListener("blur", e => {
            validatePassword(e.target);
        });
        
        
        function containsCharacterAndNumber(password) {
            const hasCharacter = /[a-zA-Z]/.test(password);
            const hasNumber = /\d/.test(password);
            return hasCharacter && hasNumber;
        }

        // Confirm password, matching two passwords
        const passwordElementC = document.getElementById("signupPasswordC");
        const confirmPasswordElementC = document.getElementById("signupPasswordConfirmC");

        confirmPasswordElementC.addEventListener("blur", e => {
            if (e.target.id === "signupPasswordConfirmC") {
                const confirmPassword = confirmPasswordElementC.value.trim();
                const password = passwordElementC.value.trim();

                if (confirmPassword === "") {
                    setInputError(confirmPasswordElementC, "Confirm password is required! Please try again.");
                } else if (confirmPassword !== password) {
                    setInputError(confirmPasswordElementC, "Two passwords do not match! Please try again.");
                } else {
                    clearInputError(confirmPasswordElementC);
                }
            }
        });

        const passwordElementE = document.getElementById("signupPasswordE");
        const confirmPasswordElementE = document.getElementById("signupPasswordConfirmE");

        confirmPasswordElementE.addEventListener("blur", e => {
            if (e.target.id === "signupPasswordConfirmE") {
                const confirmPassword = confirmPasswordElementE.value.trim();
                const password = passwordElementE.value.trim();

                if (confirmPassword === "") {
                    setInputError(confirmPasswordElementE, "Confirm password is required! Please try again.");
                } else if (confirmPassword !== password) {
                    setInputError(confirmPasswordElementE, "Two passwords do not match! Please try again.");
                } else {
                    clearInputError(confirmPasswordElementE);
                }
            }
        });

        // Deleting error message when user input again
        inputElement.addEventListener("input", e => {
            clearInputError(inputElement);
        });
    });
});