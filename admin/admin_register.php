<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar Admin - Coffee Shop GyRess</title>
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #f3f3f3;
      font-family: 'Segoe UI', sans-serif;
    }

    .register-container {
      background: #fff;
      padding: 2.5rem 3rem;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .register-container h2 {
      margin-bottom: 1.8rem;
      color: #5a3f2b;
      font-size: 1.8rem;
    }

    .register-container input {
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

    .error, .success {
      margin-top: 1rem;
      font-size: 0.95rem;
    }

    .error {
      color: red;
    }

    .success {
      color: green;
    }

    .login-link {
      margin-top: 1.4rem;
      font-size: 0.95rem;
    }

    .login-link a {
      color: #6f4e37;
      text-decoration: none;
      font-weight: bold;
    }

    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h2>Daftar Admin</h2>
    <form id="adminRegisterForm">
      <input type="email" id="adminEmail" placeholder="Email Admin" required />
      <input type="password" id="adminPassword" placeholder="Password" required />
      <button type="submit" class="btn">Daftar</button>
    </form>
    <div class="error" id="errorMessage"></div>
    <div class="success" id="successMessage"></div>

    <div class="login-link">
      Sudah punya akun? <a href="login-admin.php">Login di sini</a>
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

    document.getElementById("adminRegisterForm").addEventListener("submit", function (e) {
      e.preventDefault();

      const email = document.getElementById("adminEmail").value.trim();
      const password = document.getElementById("adminPassword").value;
      const errorMessage = document.getElementById("errorMessage");
      const successMessage = document.getElementById("successMessage");

      errorMessage.textContent = '';
      successMessage.textContent = '';

      auth.createUserWithEmailAndPassword(email, password)
        .then((userCredential) => {
          successMessage.textContent = "Pendaftaran berhasil! Mengarahkan ke halaman login...";
          
          // Tunggu 2 detik, lalu redirect
          setTimeout(() => {
            window.location.href = "login-admin.php";
          }, 2000);
        })
        .catch((error) => {
          errorMessage.textContent = "Pendaftaran gagal: " + error.message;
        });
    });
  </script>
</body>
</html>
