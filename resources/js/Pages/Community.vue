<template>
  <div class="community-page">
    <div class="page-content">
      <section>
        <h2>Community</h2>

        <p class="desc-text">
          Mari bergabung dengan komunitas maupun volunteer kami dan jadi bagian <br>
          dalam pelestarian dan pencegahan kerusakan ekosistem laut!<br>
          Setiap bantuan sangat berarti bagi laut kita.
        </p>

        <div class="info-section">
          <h3>Info Komunitas Kami:</h3>
          
          <div class="scroll-container" ref="communityScroll" @wheel="handleCommunityWheel">
            <div class="content-card" v-for="(card, index) in communityCards" :key="index">
              <div class="card-image-container">
                <img :src="card.image" class="card-image" :alt="card.nama" />
                <div class="card-content-bottom">
                  <div class="card-links">
                    <span 
                      class="card-link"
                      @click="handleLinkClick(card.link)"
                    >
                      {{ card.nama }} →
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="info-section">
          <h3>Info Volunteer:</h3>
          
          <div class="scroll-container" ref="volunteerScroll" @wheel="handleVolunteerWheel">
            <div class="content-card" v-for="(card, index) in volunteerCards" :key="index">
              <div class="card-image-container">
                <img :src="card.image" class="card-image" :alt="card.nama" />
                <div class="card-content-bottom">
                  <div class="card-links">
                    <span 
                      class="card-link"
                      @click="handleLinkClick(card.link)"
                    >
                      {{ card.nama }} →
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <p class="footer-text">
          <i class="fas fa-envelope"></i>
          Contact Us: {{ contactEmail }}
        </p>
      </section>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Community",

  data() {
    return {
      contactEmail: "nauticaedu@gmail.com",
      communityCards: [],
      volunteerCards: []
    };
  },

  mounted() {
    this.loadCommunityFromAPI();
    this.loadVolunteerFromAPI();
  },

  methods: {
    async loadCommunityFromAPI() {
      try {
        const response = await axios.get("https://web-production-39b5.up.railway.app/api/komunitas");
        const data = response.data.data;

        this.communityCards = data
          .filter(item => item.status === "aktif")
          .map(item => ({
            nama: item.nama,
            image: item.foto,
            link: item.link
          }));
      } catch (err) {
        console.error("Gagal load komunitas", err);
      }
    },

    async loadVolunteerFromAPI() {
      try {
        const response = await axios.get("https://web-production-39b5.up.railway.app/api/events");
        const data = response.data.data;

        this.volunteerCards = data
          .filter(item => item.status === "aktif")
          .map(item => ({
            nama: item.nama,
            image: item.foto,
            link: item.link
          }));
      } catch (err) {
        console.error("Gagal load volunteer", err);
      }
    },

    handleCommunityWheel(event) {
      if (event.deltaY !== 0) {
        event.preventDefault();
        this.$refs.communityScroll.scrollLeft += event.deltaY;
      }
    },

    handleVolunteerWheel(event) {
      if (event.deltaY !== 0) {
        event.preventDefault();
        this.$refs.volunteerScroll.scrollLeft += event.deltaY;
      }
    },

    handleLinkClick(url) {
      if (url) {
        window.open(url, "_blank");
      }
    }
  }
};
</script>


<style scoped>
.community-page {
  font-family: katibeh, serif;
  min-height: 100vh;
  padding-top: 80px;
  padding-bottom: 100px;
  background-image: url("/foto/communitybg.jpg");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

.page-content {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem 1rem;
  z-index: 2;
  position: relative;
}

section {
  background: rgb(255, 255, 255, 0.92);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
  border-radius: 15px;
  padding: 2rem 2.5rem;
  margin-bottom: 2rem;
}

h2 {
  font-family: katibeh, serif;
  color: #0060C0;
  font-weight: bold;
  font-size: 4rem;
  text-align: center;
  margin-bottom: 2rem;
  letter-spacing: 1px;
}

h3 {
  color: #000;
  font-size: 2.2rem;
  margin-bottom: 1.5rem;
  padding-bottom: 0px;
  font-weight: 600;
}

.desc-text {
  text-align: center;
  font-size: 1.8rem;
  margin-bottom: 3rem;
  color: #000;
  line-height: 1.6;
  font-weight: 500;
}

.info-section {
  margin-bottom: 4rem;
}

.scroll-container {
  display: flex;
  overflow-x: auto;
  gap: 20px;
  padding: 20px 15px;
  scroll-behavior: smooth;
  align-items: center;
  min-height: 500px;
}

.scroll-container::-webkit-scrollbar {
  display: none;
}

.scroll-container {
  -ms-overflow-style: none;
  scrollbar-width: none;
}

.content-card {
  flex: 0 0 auto;
  width: 255px;
  height: 450px;
  overflow: hidden;
  position: relative;
  border: 3px solid rgb(185, 186, 190);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border-radius: 0;
}

.content-card:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.35);
  border-color: rgb(11, 83, 179);
}

.card-image-container {
  width: 100%;
  height: 100%;
  position: relative;
}

.card-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  border-radius: 0;
  transition: transform 0.3s ease;
}

.content-card:hover .card-image {
  transform: scale(1.0);
}

.card-content-bottom {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(255, 255, 255, 0);
  padding: 15px 10px;
  text-align: center;
}

.card-links {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.card-link {
  font-size: 1.2rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  color: white;
  line-height: 1.2;
  padding: 2px 0;
  text-align: left;
}

.card-link:hover {
  color: #36d6fa;
  text-decoration: none;
  transform: translateX(5px);
}

.footer-text {
  text-align: center;
  margin-top: 50px;
  font-size: 1.2rem;
  color: #656565;
  padding: 15px;
  border-radius: 10px;
  font-weight: 600;
}

.footer-text i {
  color: #1a73e8;
  margin-right: 10px;
}
</style>