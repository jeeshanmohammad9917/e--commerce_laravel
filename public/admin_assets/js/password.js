const passwordField = document.getElementById("password");
  const togglePassword = document.getElementById("togglePassword");

  togglePassword.addEventListener("click", function() {
      if (passwordField.type === "password") {
          passwordField.type = "text";
          togglePassword.classList.remove("fa-eye-slash");
          togglePassword.classList.add("fa-eye");
      } else {
          passwordField.type = "password";
          togglePassword.classList.remove("fa-eye");
          togglePassword.classList.add("fa-eye-slash");
      }
  });