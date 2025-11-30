<template>
  <div class="home-wrapper">

    <div class="home-page">
      <section class="hero">
        <h1 class="welcome-title">Welcome to NauticaEdū!</h1>
        <p class="welcome-subtitle">Mari jaga kelestarian laut Indonesia bersama-sama</p>
      </section>
    </div>

    <div class="news-grid">

      <!-- Large 1 -->
      <article class="item large-1" @click="openLink(newsItems.large1.link)">
        <img :src="newsItems.large1.image" :alt="newsItems.large1.title">
        <div class="text-large1">
          <h2>{{ newsItems.large1.title }}</h2>
          <button @click.stop="openLink(newsItems.large1.link)">READ MORE</button>
        </div>
      </article>

      <!-- Large 2 -->
      <article class="item large-2" @click="openLink(newsItems.large2.link)">
        <img :src="newsItems.large2.image" :alt="newsItems.large2.title">
        <div class="text-large2">
          <h2>{{ newsItems.large2.title }}</h2>
          <button @click.stop="openLink(newsItems.large2.link)">READ MORE</button>
        </div>
      </article>

      <!-- Large 3 -->
      <article class="item large-3" @click="openLink(newsItems.large3.link)">
        <img :src="newsItems.large3.image" :alt="newsItems.large3.title">
        <div class="text-large3">
          <h2>{{ newsItems.large3.title }}</h2>
          <button @click.stop="openLink(newsItems.large3.link)">READ MORE</button>
        </div>
      </article>

      <!-- Small row -->
      <div class="small-row">

        <article class="item small-1" @click="openLink(newsItems.small1.link)">
          <img :src="newsItems.small1.image" :alt="newsItems.small1.title">
          <div class="text-small1">
            <h4>{{ newsItems.small1.title }}</h4>
            <button @click.stop="openLink(newsItems.small1.link)">READ MORE</button>
          </div>
        </article>

        <article class="item small-2" @click="openLink(newsItems.small2.link)">
          <img :src="newsItems.small2.image" :alt="newsItems.small2.title">
          <div class="text-small2">
            <h4>{{ newsItems.small2.title }}</h4>
            <button @click.stop="openLink(newsItems.small2.link)">READ MORE</button>
          </div>
        </article>

      </div>

      <p class="teksbawah">
        Tertarik menjadi bagian dalam melindungi laut?
        Mari bergabung dengan komunitas kami atau menjadi volunteer untuk berpartisipasi menjaga laut kita!
        Dapat diakses melalui bagian 
        <router-link to="/community" class="inline-link">community</router-link>.
      </p>

    </div>
  </div>
</template>



<script>
import axios from "axios";

export default {
  name: "Home",
  data() {
    return {
      newsItems: {
        large1: { title: "", image: "", link: "" },
        large2: { title: "", image: "", link: "" },
        large3: { title: "", image: "", link: "" },
        small1: { title: "", image: "", link: "" },
        small2: { title: "", image: "", link: "" },
      }
    }
  },

  mounted() {
    this.loadBerita();
  },

  methods: {

    async loadBerita() {
      try {
        const res = await axios.get("https://web-production-39b5.up.railway.app/api/berita");
        const berita = res.data.data;

        // mapping backend → frontend
        const map = item => ({
          title: item.judul,
          image: item.foto,
          link: item.link
        });

        // isi sesuai index
        this.newsItems.large1 = berita[0] ? map(berita[0]) : {};
        this.newsItems.large2 = berita[1] ? map(berita[1]) : {};
        this.newsItems.large3 = berita[2] ? map(berita[2]) : {};
        this.newsItems.small1 = berita[3] ? map(berita[3]) : {};
        this.newsItems.small2 = berita[4] ? map(berita[4]) : {};

      } catch (error) {
        console.error("Gagal mengambil berita:", error);
      }
    },

    openLink(url) {
      if (url) window.open(url, '_blank');
    },

  }
};
</script>



<style scoped>

@import url('https://fonts.googleapis.com/css2?family=Katibeh&display=swap');

/* BACKGROUND PUTIH HANYA DI HOME */
.home-wrapper {
  background-color: white;

}

.home-page {
  min-height: 100vh;
  background-color: white; 
}

.hero {
  height: 100vh;
  background-image: url('/foto/homefix.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  color: white;
  padding: 0 20px;
}

.welcome-title {
  font-family: "Katibeh", serif;
  font-size: 6rem;
  font-weight: 600;
  margin-bottom: 1rem;
  text-shadow: 3px 3px 6px rgba(0,0,0,0.5);
  line-height: 1.1;
  position: relative;
  z-index: 2;
}

.welcome-subtitle {
  font-size: 2rem;
  text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
  font-weight: 300;
  font-family: "Katibeh", serif;
  font-style: normal;
  position: relative;
  z-index: 2;
}

/* Responsive */
@media (max-width: 768px) {
  .welcome-title {
    font-size: 2.5rem;
  }
  
  .welcome-subtitle {
    font-size: 1.2rem;
  }
}

@media (max-width: 480px) {
  .welcome-title {
    font-size: 2rem;
  }
  
  .welcome-subtitle {
    font-size: 1rem;
  }
}

/*Bagian News*/

.news-grid {
  display: grid;
  font-family: "Playfair Display", serif;
  grid-template-columns: 2fr 1fr;     /* kiri dua bagian, kanan satu bagian */
  grid-template-rows: auto 1fr auto; /* baris: top, middle, bottom */
  gap: 10px;
  background-color: #D9D9D9;
  margin-bottom: 30px;
  align-items: start;
  max-width: 1200px;   /* atur sesuai kebutuhan: 1000px, 1100px, 1200px */
  margin: 80px auto auto;      /* ini membuat kotak berada di tengah */
  padding: 10px;       /* memberi ruang agar tidak nempel ke tepi */
  border-radius: 12px; /* opsional: agar sudut lebih halus */
  position: relative;
  z-index: 2;
}

/* Penempatan item pada grid utama */
.large-1 { grid-column: 1 / -1; height: 380px;/* span full width (kolom 1 sampai akhir) */ }
.large-2 { grid-column: 1 / 2; grid-row: 2 / 3;height: 300px; }
.large-3 { grid-column: 2 / 3; grid-row: 2 / 4; height: 580px; } /* kanan tinggi (menjangkau row 2 dan 3) */

/* small-row: menempati kolom kiri baris paling bawah */
.small-row {
  grid-column: 1 / 2;
  grid-row: 3 / 4;
  display: flex;
  gap: 5px;
}

/* Dua small item berdampingan, masing-masing setengah lebar container */
.small-row .small-1,
.small-row .small-2 {
  flex: 1 1 0;
  grid-column: auto;
  grid-row: auto;
  height: 270px;
}

.small-1 {
  grid-column: 1 / 2;
  grid-row: 3 / 4;
}

/* Gaya umum item */
.item {
  position: relative;
  overflow: hidden;
  border-radius: 6px;
  min-height: 120px;
  background: #111;
  cursor: pointer; /* Tambahkan ini */
  transition: transform 0.3s ease; /* Efek hover opsional */
}

.item:hover {
  transform: scale(1.02); /* Efek hover opsional */
}

/* Pastikan gambar memenuhi kotak dan ter-crop rapi */
.item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display:block;
}

/* teks overlay */
.text-large1 {
  position: absolute;
  top: 14px;
  left: 14px;
  right: 14px;
  font-size: 40px;
  color: white;
  z-index: 2;
  font-family: playfair display, serif;
  text-shadow: 0 3px 10px rgba(0,0,0,0.6);
}

.text-large2 {
  position: absolute;
  top: 14px;
  left: 14px;
  right: 14px;
  font-size: 30px;
  color: white;
  z-index: 2;
  font-family: playfair display, serif;
  text-shadow: 0 3px 10px rgba(0,0,0,0.6);
}

.text-large3 {
  position: absolute;
  left: 14px;
  bottom: 14px;
  text-align: left;
  font-size: 30px;
  font-family: playfair display, serif;
  color: white;
  z-index: 2;
  text-shadow: 0 3px 10px rgba(0,0,0,0.6);
}

.text-small1{
  position: absolute;
  left: 14px;
  bottom: 14px;
  text-align: left;
  font-size: 25px;
  font-family: playfair display, serif;
  color: white;
  z-index: 2;
  text-shadow: 0 3px 10px rgba(0,0,0,0.6);
}

.text-small2{
  position: absolute;
  left: 14px;
  bottom: 14px;
  text-align: left;
  font-size: 25px;
  font-family: playfair display, serif;
  color: white;
  z-index: 2;
  text-shadow: 0 3px 10px rgba(0,0,0,0.6);
}

.item .text {
  position: absolute;
  top: 14px;
  left: 14px;
  right: 14px;
  color: white;
  z-index: 2;
  text-shadow: 0 3px 10px rgba(0,0,0,0.6);
}

/* styling judul dan tanggal */
.item h2, .item h4 {
  margin: 0 0 6px 0;
  line-height: 1.05;
}
.date {
  font-size: 0.75rem;
  letter-spacing: 1px;
  opacity: 0.9;
  margin-bottom: 8px;
  text-transform: uppercase;
}

/* tombol */
.item button {
  margin-top: 8px;
  padding: 7px 12px;
  background: #0b65a8;
  border: none;
  color: white;
  cursor: pointer;
  border-radius: 4px;
}

.teksbawah{
  font-family: karla, serif;
  color: #1e2124;
  font-size: 18px;
}

.inline-link{
  color: #0060C0;
  font-weight: 600;
  text-decoration: underline;
  cursor: pointer;
}

/* responsive: pada layar sempit, ubah jadi satu kolom */
@media (max-width: 900px) {
  .news-grid {
    grid-template-columns: 1fr;
    grid-template-rows: auto;
  }

  .large-3 { grid-column: 1 / -1; grid-row: auto; }
  .large-2 { grid-column: 1 / -1; grid-row: auto; }
  .small-row { grid-column: 1 / -1; flex-direction: row; }
  .small-row .small-1, .small-row .small-2 { flex: 1 1 50%; }
}

/* mobile: stack vertically */
@media (max-width: 480px) {
  .small-row { flex-direction: column; }
  .small-row .small-1, .small-row .small-2 { width: 100%; }
}
</style>