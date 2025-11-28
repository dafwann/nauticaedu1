<template>
  <div class="course-page" :class="{ 'page-loaded': pageLoaded }">
    <h1 class="title">Let's Learn Together!</h1>
    <h2 class="subtitle">Lautan sangat luas dengan berbagai misteri didalamnya!</h2>
    
    <!-- Card Slider -->
    <div class="course-slider" ref="slider">
      <div class="course-card" v-for="course in courses" :key="course.id">
        <div class="card-image">
          <img :src="course.image" :alt="course.title" @load="imageLoaded" />
        </div>
        <div class="card-content">
          <h3>{{ course.title }}</h3>
          <p class="desccourse">{{ course.description }}</p>
          <button @click="openCourse(course.id)" class="btn-detail">Lihat Materi</button>
        </div>
      </div>
    </div>

    <!-- Quiz Button -->
    <div class="quiz-wrapper">
      <button class="btn-quiz" @click="startQuiz">Mulai Quiz</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "CoursePage",
  data() {
    return {
      pageLoaded: false,
      imagesLoaded: 0,
      courses: [
        {
          id: 1,
          title: "Menyelam ke Dunia Laut",
          description: "Mengenal dasar-dasar ekosistem laut dan perannya.",
          image: "/foto/course1.jpg"
        },
        {
          id: 2,
          title: "Siapa Saja Penghuni Laut?",
          description: "Mengenal laut dan perannya dalam kehidupan",
          image: "/foto/course2.jpg"
        },
        {
          id: 3,
          title: "Laut Kita Terancam!",
          description: "Memahami ancaman terhadap ekosistem laut dan cara mengatasinya.",
          image: "/foto/course3.jpg"
        },
        {
          id: 4,
          title: "Selamatkan Laut Kita!",
          description: "Bertindak secara nyata, tidak hanya sekedar tau",
          image: "/foto/course4.jpg"
        }
      ]
    }
  },
  mounted() {
    // Fallback jika gambar tidak load
    setTimeout(() => {
      this.pageLoaded = true;
    }, 500);
  },
  methods: {
    imageLoaded() {
      this.imagesLoaded++;
      if (this.imagesLoaded >= this.courses.length) {
        this.pageLoaded = true;
      }
    },
    openCourse(id) {
      this.$router.push(`/course/${id}`)
    },
    startQuiz() {
      this.$router.push("/quiz")
    }
  }
}
</script>

<style scoped>
/* Tambahkan di bagian atas CSS */
.course-page {
  text-align: center;
  position: relative;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 20px;
  box-sizing: border-box;
  z-index: 1;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.course-page.page-loaded {
  opacity: 1;
}

.course-page::before {
  content: "";
  position: absolute;
  top: 0; left: 0;
  width: 100%;
  height: 100%;
  background: url('/foto/bgcourse.jpg') no-repeat center/cover;
  opacity: 0.5;
  z-index: -1;
}

/* CSS lainnya TETAP SAMA seperti sebelumnya */
.title {
  font-size: 2.5rem;
  padding-top: 30px;
  margin-bottom: 0.5rem;
  font-family: katibeh, serif;
  color: white;
  font-weight: bold;
  line-height: 1.2;
}

.subtitle {
  font-size: 1rem;
  margin-bottom: 2rem;
  font-family: karla, serif;
  color: white;
  line-height: 1;
  max-width: 600px;
}

/* SLIDER */
.course-slider {
  display: flex;
  gap: 15px;
  overflow-x: auto;
  scroll-snap-type: x mandatory;
  padding: 10px 5px 20px;
  width: 100%;
  max-width: 1200px;
  scrollbar-width: none;
  -ms-overflow-style: none;
}

.course-slider::-webkit-scrollbar {
  display: none;
}

.course-card {
  width: 280px;
  height: 340px;
  background: #d9ebff;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 4px 15px rgba(0,0,0,0.15);
  scroll-snap-align: start;
  flex-shrink: 0;
  display: flex;
  flex-direction: column;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  box-sizing: border-box;
}

.course-card:hover {
  transform: translateY(-5px) scale(1.05);;
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

.card-image {
  width: 100%;
  height: 150px;
  overflow: hidden;
  border-radius: 12px;
  object-fit: cover;
  padding: 8px;
  box-sizing: border-box;
}

.card-image img {
  width: 100%;
  height: 100%;
  border-radius: 12px;
  object-fit: cover;
  transition: transform 0.5s ease;
  display: block;
}

.card-content {
  padding: 20px;
  display: flex;
  flex: 1;
  flex-direction: column;
  justify-content: space-between; 
  padding: 15px 20px;
  box-sizing: border-box;
}

.course-card h3 {
  font-size: 1.2rem;
  margin-bottom: 0;
  color: #0056a3;
  font-family: karla, serif;
  line-height: 1.3;
}

.desccourse {
  font-size: 0.9rem;
  color: #656565;
  font-family: karla, serif;
  margin-bottom: 0;
  line-height: 1.4;
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  min-height: 0;
}

.btn-detail {
  background: #0056a3;
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: 0.3s;
  font-family: karla, serif;
  font-size: 0.9rem;
  font-weight: 600;
  margin-top: 0;
}

.btn-detail:hover {
  background: #003d75;
}

/* QUIZ BUTTON */
.quiz-wrapper {
  margin-top: 30px;
  width: 100%;
  max-width: 300px;
}

.btn-quiz {
  background: white;
  color: #0056a3;
  padding: 15px 30px;
  border: none;
  border-radius: 10px;
  font-size: 1rem;
  cursor: pointer;
  transition: 0.3s;
  font-family: karla, serif;
  font-weight: 600;
  width: 100%;
  max-width: 250px;
}

.btn-quiz:hover {
  background: #bed7f4;
}

/* MEDIA QUERIES - TETAP SAMA */
@media (min-width: 768px) {
  .title {
    font-size: 3.5rem;
  }
  
  .subtitle {
    font-size: 1.2rem;
  }
  
  .course-card {
    min-width: 300px;
    height: 400px;
  }
  
  .card-image {
    height: 170px;
  }
  
  .course-card h3 {
    font-size: 1.3rem;
  }
  
  .desccourse {
    font-size: 1rem;
    -webkit-line-clamp: 4;
  }
}

@media (min-width: 1024px) {
  .title {
    font-size: 4.5rem;
  }
  
  .subtitle {
    font-size: 1.3rem;
    margin-bottom: 3rem;
  }
  
  .course-card {
    min-width: 320px;
    height: 420px;
  }
  
  .card-image {
    height: 180px;
  }
  
  .desccourse {
    -webkit-line-clamp: 4;
  }
  
  .btn-quiz {
    padding: 15px 40px;
    font-size: 1.1rem;
  }
}

@media (max-width: 360px) {
  .course-page {
    padding: 15px 10px;
  }
  
  .title {
    font-size: 2rem;
  }
  
  .subtitle {
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
  }
  
  .course-card {
    min-width: 260px;
    height: 360px;
  }
  
  .card-image {
    height: 140px;
  }
  
  .card-content {
    padding: 15px;
  }
  
  .course-card h3 {
    font-size: 1.1rem;
  }
  
  .desccourse {
    font-size: 0.85rem;
    -webkit-line-clamp: 3;
  }
}
</style>