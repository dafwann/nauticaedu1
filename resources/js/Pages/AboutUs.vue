<template>
  <div class="about-page">

    <div class="white-container">
      
      <section class="about-header">
        <h1 class="about-title">ABOUT US</h1>
      </section>

      <div class="image-section">
        <div class="image-container">
          <img :src="aboutUsImage" class="about-image" />
        </div>
      </div>

      <div class="text-section">
        <p class="about-description">
          Nautica Edu adalah aplikasi edukasi dan aksi lingkungan yang berfokus pada pelestarian laut Indonesia. 
          Aplikasi ini memanfaatkan teknologi digital untuk mengajak masyarakat khususnya generasi muda belajar 
          tentang ekosistem laut sekaligus berpartisipasi dalam kegiatan pelestarian. Dengan menggabungkan fitur 
          pembelajaran, berita lingkungan terbaru, dan komunitas, Nautica Edu bertujuan menumbuhkan rasa peduli, 
          cinta, dan tanggung jawab terhadap kekayaan laut Indonesia.
        </p>
        <p class="contact">Contact Us: nauticaedu@gmail.com</p>
      </div>

    </div>

    <section class="team-section">
      <div class="team-overlay">

        <h2>Bertemu dengan Team Pengelola</h2>

        <div class="team-cards">
          <div class="card" v-for="(member, index) in members" :key="index">

            <div class="card-bg" :style="{ background: member.color }"></div>

            <div class="avatar">
              <div class="circle">
                <img :src="member.photo" :alt="member.name" class="member-photo" />
              </div>
            </div>

            <div class="name-container">
              <div class="name">{{ member.name }}</div>
              <div class="full-name">{{ member.fullName }}</div>
            </div>
            
            <div class="role">{{ member.role }}</div>

            <div class="icons">
              <a v-if="member.socialLinks.facebook" :href="member.socialLinks.facebook" target="_blank" class="icon-link">
                <img :src="facebookIcon" alt="Facebook" class="social-icon" />
              </a>
              <a v-if="member.socialLinks.instagram" :href="member.socialLinks.instagram" target="_blank" class="icon-link">
                <img :src="instagramIcon" alt="Instagram" class="social-icon" />
              </a>
              <a v-if="member.socialLinks.linkedin" :href="member.socialLinks.linkedin" target="_blank" class="icon-link">
                <img :src="linkedinIcon" alt="LinkedIn" class="social-icon" />
              </a>
            </div>

          </div>
        </div>

      </div>
    </section>

  </div>
</template>

<script>
export default {
  name: "AboutUs",
  data() {
    return {
      aboutUsImage: "/foto/aboutus.jpg",
      facebookIcon: "/foto/facebook.png",
      instagramIcon: "/foto/instagram.png", 
      linkedinIcon: "/foto/linkedin.png",
      members: [
        { 
          name: "MUTIARA",
          fullName: "",
          photo: "/foto/tiara.jpg",
          role: "Mahasiswa",
          color: "#93C5FF",
          socialLinks: {
            facebook: "mutiaraa.hy@gmail.com",
            instagram: "https://www.instagram.com/gitu._.4?igsh=MXAwb3V3emNjbzhjag==",
            linkedin: "https://www.linkedin.com/in/username"
          }
        },
        { 
          name: "IMTYAS QANITA RAHMAN", 
          fullName: "",
          photo: "/foto/tyas.jpg", 
          role: "Mahasiswa",
          color: "#5BA6FA",
          socialLinks: {
            facebook: "imtyasrahman@gmail.com",
            instagram: "https://www.instagram.com/imtysqnitarr?igsh=bHhjNGZ5MW9lbmN5",
            linkedin: "https://www.linkedin.com/in/imtyas-qanita-rahman-ba5687348?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app"
          }
        },
        {
          name: "CHELSEA ELYSIA CHANDEAN", 
          fullName: "",
          photo: "/foto/chelsea.jpg", 
          role: "Mahasiswa",
          color: "#4186D4",
          socialLinks: {
            facebook: "https://www.facebook.com/username",
            instagram: "https://www.instagram.com/username",
            linkedin: "https://www.linkedin.com/in/username"
          }
        },
        { 
          name: "ZALSABILA TUN NURAODIAH N", 
          fullName: "",
          photo: "/foto/zalsa.jpg",
          role: "Mahasiswa", 
          color: "#FFE8A7",
          socialLinks: {
            facebook: "d121241082zalsabilatunn@gmail.com",
            instagram: "https://instagram.com/zalsaatun",
            linkedin: "www.linkedin.com/in/zalsabila-tun-70470a336"
          }
        }, 
        { 
          name: "ANDI MUH. DAFFA' DERMAWAN", 
          fullName: "",
          photo: "/foto/foto_daffa.jpg",
          role: "Mahasiswa", 
          color: "#DDB300",
          socialLinks: {
            facebook: "https://www.facebook.com/username",
            instagram: "https://www.instagram.com/daffadermwn_",
            linkedin: "https://www.linkedin.com/in/username"
          }
        } 
      ]
    };
  }
};
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.about-page {
  min-height: 100vh;
  padding-top: 80px;
  padding-bottom: 100px;
  background-image: url("/foto/communitybg.jpg");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

.white-container {
  background: rgba(255, 255, 255, 0.95);
  border-radius: 20px;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
  width: 95%;
  max-width: 1200px;
  margin: 0 auto;
  overflow: hidden;
  backdrop-filter: blur(5px);
}

.about-header {
  padding: 50px 40px 30px 40px;
  text-align: right;
}

.about-title {
  font-size: 3rem;
  font-weight: 700;
  color: #004B85;
}

.image-section {
  padding: 20px;
  display: flex;
  justify-content: center;
}

.image-container {
  width: 100%;
  max-width: 900px;
  height: 350px;
  border-radius: 12px;
  overflow: hidden;
}

.about-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.text-section {
  padding: 40px;
}

.about-description {
  font-size: 1.1rem;
  line-height: 1.7;
  max-width: 900px;
  margin: 0 auto;
}

.contact {
  text-align: center;
  margin-top: 50px;
  font-size: 1.2rem;
  color: #656565;
  padding: 15px;
  border-radius: 10px;
  font-weight: 600;
}

.team-section {
  margin-top: 60px;
  padding: 80px 20px;
  background-image: url('/foto/background-team.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  position: relative;
  min-height: 100vh;
}

.team-overlay {
  text-align: center;
  position: relative;
  z-index: 2;
}

.team-section h2 {
  color: #003f6b;
  font-size: 3.0rem;
  font-weight: bold;
  margin-bottom: 40px;
  text-shadow: 0 2px 4px rgb(22, 83, 128);
}

.team-cards {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 25px;
  position: relative;
  z-index: 2;
}

.card {
  width: 220px;
  background: white;
  border-radius: 20px;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
  padding-bottom: 25px;
  text-align: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.card:hover {
  transform: translateY(-8px);
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
}

.card-bg {
  height: 120px;
  border-radius: 16px 16px 0 0;
  width: 100%;
}

.avatar {
  margin-top: -45px;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  margin-bottom: 15px;
}

.circle {
  width: 90px;
  height: 90px;
  border-radius: 50%;
  background: linear-gradient(#fff, #f2f2f2);
  border: 4px solid white;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  overflow: hidden; 
}

.member-photo {
  width: 100%;
  height: 100%;
  object-fit: cover; 
  object-position: center; 
}

.name-container {
  margin-bottom: 8px;
  min-height: 50px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  padding: 0 15px;
}

.name {
  font-size: 1.1rem;
  color: #004B85;
  font-weight: bold;
  margin-bottom: 2px;
  line-height: 1.2;
}

.full-name {
  font-size: 0.9rem;
  color: #004B85;
  font-weight: 500;
  line-height: 1.2;
}

.role {
  font-size: 1.1rem; 
  color: #004B85; 
  margin-bottom: 15px;
  font-weight: 600; 
  text-transform: uppercase; 
  letter-spacing: 0.5px; 
}

.icons {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin-top: auto;
  width: 100%;
  padding: 0 15px;
}

.icon-link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: #f0f8ff;
  transition: all 0.3s ease;
  text-decoration: none;
  border: 2px solid #e3f2fd;
  padding: 6px;
}

.social-icon {
  width: 20px;
  height: 20px;
  object-fit: contain;
  transition: all 0.3s ease;
}

.icon-link:hover {
  background: #004B85;
  transform: scale(1.1);
  border-color: #004B85;
}

.icon-link:hover .social-icon {
  filter: brightness(0) invert(1);
}

/* Responsive Design */
@media (max-width: 768px) {
  .team-section {
    padding: 60px 15px;
    background-attachment: scroll;
  }
  
  .team-cards {
    gap: 20px;
  }
  
  .card {
    width: 170px;
  }
  
  .team-section h2 {
    font-size: 2rem;
  }
  
  .circle {
    width: 80px;
    height: 80px;
  }
  
  .name {
    font-size: 1rem;
  }
  
  .full-name {
    font-size: 0.8rem;
  }
  
  .role {
    font-size: 1rem; 
  }
  
  .icons {
    gap: 8px;
  }
  
  .icon-link {
    width: 28px;
    height: 28px;
  }
  
  .social-icon {
    width: 14px;
    height: 14px;
  }
  
  .about-title {
    font-size: 2rem;
  }
  
  .about-header {
    padding: 30px 20px 20px 20px;
  }
  
  .text-section {
    padding: 20px;
  }
  
  .image-container {
    height: 250px;
  }
}

@media (max-width: 480px) {
  .team-cards {
    gap: 15px;
  }
  
  .card {
    width: 150px;
  }
  
  .circle {
    width: 70px;
    height: 70px;
  }
  
  .name {
    font-size: 0.9rem;
  }
  
  .full-name {
    font-size: 0.75rem;
  }
  
  .role {
    font-size: 0.9rem; 
  }
}
</style>