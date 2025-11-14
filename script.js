document.addEventListener("DOMContentLoaded", () => {
  const loginBtn = document.getElementById("login-btn");
  const portfolioPage = document.getElementById("portfolio-page");
  const loginPage = document.getElementById("login-page");
  const errorMsg = document.getElementById("login-error");
  const logoutBtn = document.getElementById("logout-btn");

  const validUser = "kristymangubat11@gmail.com";
  const validPass = "kcrubio17";

  // Stay logged in if previously logged in
  if (localStorage.getItem("loggedIn") === "true") {
    loginPage.style.display = "none";
    portfolioPage.style.display = "block";
    logoutBtn.style.display = "inline-block";
  }

  // --- LOGIN FUNCTIONALITY ---
  loginBtn.addEventListener("click", () => {
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();

    if (username === validUser && password === validPass) {
      localStorage.setItem("loggedIn", "true");
      loginPage.style.display = "none";
      portfolioPage.style.display = "block";
      logoutBtn.style.display = "inline-block";
      errorMsg.textContent = ""; // clear error
    } else {
      errorMsg.textContent = "Incorrect username or password!";
    }
  });

  // --- LOGOUT FUNCTIONALITY ---
  logoutBtn.addEventListener("click", () => {
    localStorage.removeItem("loggedIn");
    location.reload();
  });

  // --- NAVIGATION SYSTEM ---
  const navLinks = document.querySelectorAll(".nav-link");
  const sections = document.querySelectorAll(".section");

  navLinks.forEach(link => {
    link.addEventListener("click", e => {
      e.preventDefault();

      navLinks.forEach(l => l.classList.remove("active"));
      sections.forEach(s => s.classList.remove("active"));

      link.classList.add("active");
      const target = link.getAttribute("data-section");
      const targetSection = document.getElementById(target);
      if (targetSection) {
        targetSection.classList.add("active");
      }

      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  });

   // --- TOGGLE BETWEEN LOGIN AND REGISTER FORMS ---
  const toggleLink = document.getElementById('toggleRegister');
  const loginForm = document.getElementById('login-form');
  const registerForm = document.getElementById('register-form');

  // Toggle the forms between login and register
  toggleLink.addEventListener('click', () => {
    loginForm.classList.toggle('hidden-form');
    registerForm.classList.toggle('hidden-form');

    // Change the link text depending on which form is visible
    if (loginForm.classList.contains('hidden-form')) {
      toggleLink.textContent = "Back to Login";
    } else {
      toggleLink.textContent = "Create new account";
    }
  });
});
   
