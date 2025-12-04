<template>
  <div>
    <header class="main-header">
      <div class="logo">NauticaEdū</div>
      <nav class="nav-scroll">
        <a href="#home" data-ection="home">Home</a>
        <a href="#course" data-section="course">Course</a>
        <a href="#community" data-section="community">Community</a>
        <a href="#aboutus" data-section="aboutus">About Us</a>
      </nav>
      <div class="profile-icon">
        <svg class="profile-svg" viewBox="0 0 24 24">
          <circle cx="12" cy="7" r="5"/>
          <path d="M12 14c-6 0-10 3-10 7h20c0-4-4-7-10-7z"/>
        </svg>      
      </div>
    </header>
    
    <section id="home" class="hero">
        <h1></h1>
    </section>
    
    <main>
      <section id="course">
        <h2>Dampak Kerusakan Laut</h2>
        <p>Kerusakan laut berdampak pada:</p>
        <ul>
          <li>Penurunan keanekaragaman hayati laut.</li>
          <li>Kesulitan nelayan dalam mencari ikan.</li>
          <li>Kerusakan ekosistem terumbu karang.</li>
          <li>Meningkatnya masalah iklim global.</li>
        </ul>
      </section>

      <section id="community">
        <h2>Studi Kasus Lokal</h2>
        <p>Beberapa contoh nyata kerusakan laut di Indonesia:</p>
        <ul>
          <li>Limbah tambak udang di Pantai Yogyakarta menyebabkan kematian massal ikan.</li>
          <li>Penumpukan sampah plastik di Laut Jawa merusak hutan mangrove.</li>
          <li>Pencemaran limbah nikel di Perairan Halmahera Timur.</li>
          <li>Pencemaran minyak di Teluk Lampung mengancam kehidupan pesisir.</li>
        </ul>
      </section>

      <section id="aboutus">
        <h2>Aksi Nyata yang Bisa Kamu Lakukan</h2>
        <p>Berikut beberapa cara mudah untuk ikut menjaga laut:</p>
        <ul>
          <li>Kurangi penggunaan plastik sekali pakai, gunakan botol dan tas daur ulang.</li>
          <li>Ikut kegiatan bersih-bersih pantai bersama komunitas.</li>
          <li>Jaga terumbu karang dan mangrove saat berwisata.</li>
          <li>Gunakan produk perikanan yang berkelanjutan.</li>
          <li>Sebarkan informasi penting tentang laut ke orang sekitar.</li>
        </ul>
        <p><em>Mulai dari hal kecil yang kita lakukan bersama, akan berdampak besar untuk laut kita!</em></p>
      </section>
    </main>

    <footer>
      &copy; 2025 Modul Edukasi Laut Kita Terancam - Semua hak cipta dilindungi.
    </footer>
  </div>
</template>


<script>
  import { onMounted } from "vue";

  export default {
    setup() {
      onMounted(() => {

        /* --- NAV ACTIVE ON CLICK --- */
        document.querySelectorAll('.nav-scroll a').forEach(a => {
          a.addEventListener('click', function () {
            document.querySelectorAll('.nav-scroll a')
              .forEach(link => link.classList.remove('active'));
            this.classList.add('active');
          });
        });

        /* --- NAV ACTIVE ON SCROLL (SCROLL SPY) --- */
        const about = document.querySelector("#aboutus");

        window.addEventListener("scroll", () => {
          let scrollPos = window.scrollY + 150;
          let sections = document.querySelectorAll("section");

          sections.forEach(sec => {
            if (
              scrollPos > sec.offsetTop &&
              scrollPos < sec.offsetTop + sec.offsetHeight
            ) {
              let id = sec.getAttribute("id");

              document.querySelectorAll(".nav-scroll a").forEach(a => {
                a.classList.remove("active");
                if (a.dataset.section === id) {
                  a.classList.add("active");
                }
              });
            }
          });

        });
        
      });
    }
  };
</script>



<style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0; padding: 0;
      background: #5BA6FA;
      background: -moz-linear-gradient(top, #5BA6FA 0%, #004B85 69%, #144E75 100%);
      background: -webkit-linear-gradient(top, #5BA6FA 0%, #004B85 69%, #144E75 100%);
      background: linear-gradient(to bottom, #5BA6FA 0%, #004B85 69%, #144E75 100%);
      color: #004d40;
    }

    .main-header {
      position: fixed !important;
      top: 0;
      left: 0;
      width: 100%;
      padding: 10px 20px !important;
      background: rgba(20, 90, 150, 0.55); /* semi-transparent ocean */
      backdrop-filter: blur(10px); /* GLASS EFFECT */
      -webkit-backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.25);

      display: flex !important;
      align-items: center;        /* vertikal sejajar */
      justify-content: space-between !important;  /* jarak kiri–kanan */
      box-sizing: border-box;
      z-index: 1000;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }


    .logo {
      display: flex;
      font-size: 32px;
      font-weight: bold;
      color: white;
      font-family: 'Treasure Map Deadhand', serif; /* bisa diganti font lainnya */
      line-height: 1;
      white-space: nowrap;
    }

    .nav-scroll{
      display: flex;
      gap: 40px;
      overflow-x: auto;        /* scroll ke samping */
      white-space: nowrap;     /* item tidak turun ke bawah */
      padding: 6px 0;
      scrollbar-width: none; /* hide scrollbar (firefox) */
      white-space: nowrap;   
    }

    .nav-scroll::-webkit-scrollbar {
      display: none;           /* hide scrollbar (chrome, safari) */
    }

    .nav-scroll a {
      color: white;
      text-decoration: none;
      font-size: 18px;
      border-radius: 8px;
      transition: 0.25s ease;
    }

    .nav-scroll a:hover {
      color: #0060C0; 
    }
    
    /* ACTIVE STATE */
    .nav-scroll a.active {
      color: #0060C0;          
      font-weight: 600;
    }

    .profile-icon {
      display: flex;
      align-items: center;
      cursor: pointer;
    }

    .profile-svg {
      width: 35px;
      height: 35px;
      fill: white;
      transition: 0.25s ease;
    }

    .profile-icon:hover .profile-svg {
      fill: #0060C0;
    }


    /*Aturan Mobile*/
    @media (max-width: 650px) {
      .main-header {
        padding: 12px 15px;
        gap: 10px;
      }

      .logo {
        font-size: 22px;
      }
    
      .nav-scroll {
        flex: 1;
        margin: 0 10px;
      }

      .nav-scroll a {
        font-size: 16px;
      }

      .profile-icon img {
        width: 32px;
      }
    }

    .hero {
      height: 350px;

      background-image: url('/foto/contohhome.jpeg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }   

    .hero h1 { /* Teks Welcome */
      position: absolute;
      top: 45%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      font-size: 42px;
      font-weight: 600;
    }

    main {
      max-width: 900px;
      margin: 2rem auto;
      margin-top: 120px;
      padding: 0 1rem;
      padding-bottom: 120px;
    }

    section {
      background: white;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      border-radius: 8px;
      padding: 1.5rem 2rem;
      margin-bottom: 2rem;
    }

    h2 {
      color: #00796b;
      border-bottom: 3px solid #004d40;
      padding-bottom: 0.3rem;
    }

    ul {
      line-height: 1.6;
    }

    footer {
      background: #0b5ba8;
      color: white;
      text-align: center;
      padding: 1rem 2rem;
      position: fixed;
      bottom: 0;
      width: 100%;
      font-size: 0.9rem;
    }

    .highlight {
      color: #d84315;
      font-weight: bold;
    }

</style>