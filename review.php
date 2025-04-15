<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Review - Coffee GyRess</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css" />

  <!-- Feather Icons -->
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body style="background: url('images/menu-bg.jpg') no-repeat; background-size: cover; background-position: center;">

  <!-- HEADER -->
  <header class="header">
    <div id="menu-btn" class="fas fa-bars"></div>

    <a href="index.html" class="logo">coffee <i class="fas fa-mug-hot"></i></a>

    <nav class="navbar">
      <a href="index.html">home</a>
      <a href="about.html">about</a>
       <a href="#" onclick="return cekLogin()">Menu</a>
      <a href="#" class="active">review</a>
    </nav>
  </header>

  <!-- REVIEW SECTION -->
  <section class="review" id="review">
    <h1 class="heading">Penilain <span>Tentang kopi kami</span></h1>

    <div class="box-container" style="background-color: rgba(0,0,0,0.5); padding: 2rem; border-radius: 1rem; max-width: 800px; margin: auto;">
      <form id="review-form">
        <input type="text" placeholder="Nama Anda" id="reviewer-name" required
          style="width: 100%; padding: 1rem; margin-bottom: 1rem; border: none; border-radius: 0.5rem;" />
        <textarea placeholder="Tulis ulasan Anda..." id="review-text" required
          style="width: 100%; padding: 1rem; height: 150px; margin-bottom: 1rem; border: none; border-radius: 0.5rem;"></textarea>

        <select id="review-rating" required
          style="width: 100%; padding: 1rem; margin-bottom: 1rem; border: none; border-radius: 0.5rem;">
          <option value="">Pilih Rating</option>
          <option value="1">⭐ 1</option>
          <option value="2">⭐ 2</option>
          <option value="3">⭐ 3</option>
          <option value="4">⭐ 4</option>
          <option value="5">⭐ 5</option>
        </select>

        <button type="submit"
          style="padding: 0.75rem 2rem; background-color: #d2a679; color: white; border: none; border-radius: 0.5rem; font-weight: bold;">Kirim Ulasan</button>
      </form>
    </div>

    <h1 class="heading">Ulasan <span>Pelanggan</span></h1>

    <!-- SWIPER SLIDER UNTUK ULASAN -->
    <div class="swiper review-slider" style="padding: 2rem;">
      <div class="swiper-wrapper" id="review-list">
        <!-- Ulasan dari Firebase akan dimasukkan ke sini -->
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </section>

  <!-- FOOTER -->
  <section class="footer" style="background-color: #f7f1e3; color: #3e2f24; padding: 2rem 1rem; font-family: 'Segoe UI', sans-serif;">
  <div class="box-container" style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 1.5rem; max-width: 1100px; margin: auto;">

    <!-- Quick Links -->
    <div class="box" style="flex: 1 1 250px; min-width: 250px;">
      <h3 style="font-size: 1.8rem; margin-bottom: 1rem; color: #5c3d2e;">Quick Links</h3>
      <a href="#home" style="display: block; margin-bottom: 0.8rem; font-size: 1.3rem; color: #3e2f24;">
        <i class="fas fa-arrow-right" style="margin-right: 8px;"></i> Home
      </a>
      <a href="#about" style="display: block; margin-bottom: 0.8rem; font-size: 1.3rem; color: #3e2f24;">
        <i class="fas fa-arrow-right" style="margin-right: 8px;"></i> About
      </a>
      <a href="#menu" style="display: block; margin-bottom: 0.8rem; font-size: 1.3rem; color: #3e2f24;">
        <i class="fas fa-arrow-right" style="margin-right: 8px;"></i> Menu
      </a>
      <a href="#review" style="display: block; font-size: 1.3rem; color: #3e2f24;">
        <i class="fas fa-arrow-right" style="margin-right: 8px;"></i> Review
      </a>
    </div>

    <!-- Contact Info -->
    <div class="box" style="flex: 1 1 250px; min-width: 250px;">
      <h3 style="font-size: 1.8rem; margin-bottom: 1rem; color: #5c3d2e;">Contact Info</h3>
      <a href="https://wa.me/6285931106769" target="_blank" style="display: block; margin-bottom: 0.8rem; font-size: 1.3rem; color: #3e2f24;">
        <i class="fab fa-whatsapp" style="margin-right: 8px;"></i> +62 859-3110-6769
      </a>
      <a href="mailto:dilanparamaraja1@gmail.com" style="display: block; font-size: 1.3rem; color: #3e2f24;">
        <i class="fas fa-envelope" style="margin-right: 8px;"></i> dilanparamaraja1@gmail.com
      </a>
    </div>

    <!-- Social Media -->
    <div class="box" style="flex: 1 1 250px; min-width: 250px;">
      <h3 style="font-size: 1.8rem; margin-bottom: 1rem; color: #5c3d2e;">Follow Us</h3>
      <a href="#" style="display: block; margin-bottom: 0.8rem; font-size: 1.3rem; color: #3e2f24;">
        <i class="fab fa-facebook-f" style="margin-right: 8px;"></i> Facebook
      </a>
      <a href="#" style="display: block; margin-bottom: 0.8rem; font-size: 1.3rem; color: #3e2f24;">
        <i class="fab fa-instagram" style="margin-right: 8px;"></i> Instagram
      </a>
      <a href="https://wa.me/6287812249416" target="_blank" style="display: block; font-size: 1.3rem; color: #3e2f24;">
        <i class="fab fa-whatsapp" style="margin-right: 8px;"></i> WhatsApp
      </a>
    </div>

  </div>

  <!-- Credit -->
  <div class="credit" style="text-align: center; margin-top: 2rem; font-size: 1.2rem; color: #3e2f24;">
    Created by <span style="color: #b06d3c; font-weight: bold;">Moch Sagara Dhylan</span> | All rights reserved
  </div>
</section>

  <!-- Feather Icons -->
  <script>feather.replace();

    function cekLogin() {
        const userEmail = localStorage.getItem("userEmail");

        if (!userEmail) {
          alert("Silakan login terlebih dahulu untuk mengakses menu.");
          window.location.href = "login.html";
        } else {
          window.location.href = "menu.html";
        }
      }
  </script>

  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

  <!-- Firebase Realtime Database Logic -->
  <script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.22.2/firebase-app.js";
    import { getDatabase, ref, push, onValue } from "https://www.gstatic.com/firebasejs/9.22.2/firebase-database.js";

    const firebaseConfig = {
      apiKey: "AIzaSyAFdZxpR7gwEryIuXMqI81o5K4g5plU9cs",
      authDomain: "coffeshopgr.firebaseapp.com",
      projectId: "coffeshopgr",
      storageBucket: "coffeshopgr.appspot.com",
      messagingSenderId: "725990170884",
      appId: "1:725990170884:web:f56410ecc5d914a84ab051",
      measurementId: "G-NYE45K98WJ"
    };

    const app = initializeApp(firebaseConfig);
    const db = getDatabase(app);

    const reviewForm = document.getElementById('review-form');
    const nameInput = document.getElementById('reviewer-name');
    const reviewInput = document.getElementById('review-text');
    const ratingInput = document.getElementById('review-rating');
    const reviewList = document.getElementById('review-list');

    reviewForm.addEventListener('submit', (e) => {
      e.preventDefault();

      const timestamp = Date.now();

      push(ref(db, "ulasan"), {
        nama: nameInput.value,
        ulasan: reviewInput.value,
        rating: ratingInput.value,
        waktu: timestamp
      });

      reviewForm.reset();
    });

    onValue(ref(db, "ulasan"), (snapshot) => {
      reviewList.innerHTML = "";
      snapshot.forEach((child) => {
        const data = child.val();

        const waktu = new Date(data.waktu);
        const waktuFormatted = waktu.toLocaleString("id-ID", {
          day: "2-digit", month: "short", year: "numeric",
          hour: "2-digit", minute: "2-digit"
        });

        const ratingBintang = "★".repeat(data.rating || 0) + "☆".repeat(5 - (data.rating || 0));

        const div = document.createElement("div");
        div.className = "swiper-slide box";
        div.innerHTML = `
          <i class="fas fa-quote-left"></i>
          <h3>${data.nama}</h3>
          <p>${data.ulasan}</p>
          <p style="color: #ffc107; font-size: 1.2rem;">${ratingBintang}</p>
          <p style="font-size: 0.8rem; color: #eee;">${waktuFormatted}</p>
        `;
        reviewList.appendChild(div);
      });
    });

  </script>

  <!-- Custom Script -->
  <script src="js/script.js"></script>
</body>
</html>
