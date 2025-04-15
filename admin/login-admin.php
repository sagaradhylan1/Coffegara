<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Admin - Coffee Shop GyRess</title>
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #f3f3f3;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
      background: #fff;
      padding: 2.5rem 3rem;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .login-container h2 {
      margin-bottom: 1.8rem;
      color: #5a3f2b;
      font-size: 1.8rem;
    }

    .login-container input {
      width: 100%;
      padding: 0.9rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }

    .btn {
      width: 100%;
      padding: 0.9rem;
      border: none;
      background-color: #6f4e37;
      color: white;
      font-size: 1.1rem;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #5a3f2b;
    }

    .error {
      color: red;
      margin-top: 1rem;
      font-size: 0.95rem;
    }

    .register-link {
      margin-top: 1.4rem;
      font-size: 0.95rem;
    }

    .register-link a {
      color: #6f4e37;
      text-decoration: none;
      font-weight: bold;
    }

    .register-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login Admin</h2>
    <form id="adminLoginForm">
      <input type="email" id="adminEmail" placeholder="Email Admin" required />
      <input type="password" id="adminPassword" placeholder="Password" required />
      <button type="submit" class="btn">Login</button>
    </form>
    <div class="error" id="errorMessage"></div>

   <div class="register-link">
  Belum mempunyai akun? <a href="admin_register.php">Daftar di sini</a>
</div>
  </div>

  <!-- Firebase SDK -->
  <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-auth-compat.js"></script>

  <script>
    const firebaseConfig = {
      apiKey: "AIzaSyAFdZxpR7gwEryIuXMqI81o5K4g5plU9cs",
      authDomain: "coffeshopgr.firebaseapp.com",
      projectId: "coffeshopgr",
      storageBucket: "coffeshopgr.appspot.com",
      messagingSenderId: "725990170884",
      appId: "1:725990170884:web:f56410ecc5d914a84ab051",
    };

    firebase.initializeApp(firebaseConfig);
    const auth = firebase.auth();

    const allowedAdminEmails = ["admin@coffeegyr.com", "admin2@example.com"];

    document.getElementById("adminLoginForm").addEventListener("submit", function (e) {
      e.preventDefault();

      const email = document.getElementById("adminEmail").value.trim();
      const password = document.getElementById("adminPassword").value;
      const errorMessage = document.getElementById("errorMessage");

      auth.signInWithEmailAndPassword(email, password)
        .then((userCredential) => {
          if (allowedAdminEmails.includes(email)) {
            alert("Login admin berhasil!");
            window.location.href = "admin.php";
          } else {
            auth.signOut();
            errorMessage.textContent = "Akun ini tidak memiliki akses admin.";
          }
        })
        .catch((error) => {
          errorMessage.textContent = "Login gagal: " + error.message;
        });
    });
  </script>
</body>
</html>
