<template>
  <div class="course4">

    <!-- Hero Section -->
    <section class="hero">
      <div class="container">
        <div class="hero-content">
          <h1>Selamatkan Laut Kita!</h1>
          <p>Langkah kecil yang bisa kamu lakukan hari ini.</p>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <main class="container">
      <div class="content-wrapper">
        <!-- Tips Section -->
        <section class="tips-section">
          <h2>Langkah-langkah Pelestarian</h2>
          
          <div class="tips-grid">
            <div class="tip-card">
              <div class="tip-icon">🔄</div>
              <h3>Kurangi penggunaan plastik sekali pakai</h3>
              <p>Bawa tas belanja sendiri, gunakan botol minum isi ulang, dan hindari sedotan plastik. Sampah kecil yang kamu hindari bisa menyelamatkan satu kehidupan laut.</p>
            </div>
            
            <div class="tip-card">
              <div class="tip-icon">🏷️</div>
              <h3>Pilih produk yang ramah laut</h3>
              <p>Gunakan sunscreen ramah terumbu karang, pilih produk tanpa microplastic, dan dukung brand yang mengedepankan keberlanjutan.</p>
            </div>
            
            <div class="tip-card">
              <div class="tip-icon">🤝</div>
              <h3>Dukung organisasi konservasi</h3>
              <p>Banyak komunitas dan lembaga yang bekerja menjaga laut, mulai dari pembersihan pantai hingga restorasi terumbu karang. Bantuanmu - besar atau kecil - berarti.</p>
            </div>
          </div>
        </section>

        <!-- Success Story Section -->
        <section class="success-section">
          <div class="success-content">
            <div class="success-text">
              <h3>Kisah Sukses: Terumbu Karang Bali yang Pulih</h3>
              <p>Di beberapa kawasan Bali, program revitalisasi terumbu karang berhasil mengembalikan sebagian kehidupan bawah laut. Berkat kerja sama komunitas, penyelam, dan masyarakat, karang yang dulu memutih kini kembali tumbuh dan menjadi rumah bagi ikan-ikan kecil.</p>
              <p class="highlight">Ini bukti bahwa upaya manusia bisa membawa perubahan.</p>
            </div>
            <div class="success-visual">
              <div class="coral-animation">
                <div class="coral coral-1">🌿</div>
                <div class="coral coral-2">🌊</div>
                <div class="coral coral-3">🐠</div>
              </div>
              <div class="image-placeholder">
                <img :src="'/foto/lesson4.jpeg'">
              </div>
            </div>
          </div>
        </section>

        <!-- Pledge Section -->
        <section class="pledge-section">
          <div class="pledge-container">
            <h3>Saya Berjanji Menjaga Laut! 🌊</h3>
            <p class="pledge-subtitle">Bergabunglah dengan gerakan penyelamatan laut dengan membuat komitmen hari ini</p>
            
            <button 
              class="pledge-btn" 
              @click="triggerPledge"
              :class="{ active: isPledging }"
              :disabled="isPledging"
            >
              <span class="btn-text">{{ buttonText }}</span>
              <div class="btn-sparkle" v-for="n in 6" :key="n"></div>
            </button>
          </div>
        </section>
      </div>
    </main>

    <div class="navigation">
      <button @click="$router.back()" class="nav-btn back-btn">Kembali</button>
      <button @click="$router.push('/quiz')" class="nav-btn next-btn">Kerjakan Quiz</button>
    </div>

    <!-- Celebration Overlay -->
    <div class="celebration-overlay" v-if="showCelebration" @click="closeCelebration">
      <div class="celebration-content">
        <!-- Ocean Background -->
        <div class="celebration-ocean">
          <div class="wave"></div>
          <div class="wave"></div>
        </div>

        <!-- Marine Life -->
        <div class="marine-life">
          <div class="swimming-animal dolphin" v-for="n in 3" :key="'dolphin'+n">🐬</div>
          <div class="swimming-animal turtle" v-for="n in 2" :key="'turtle'+n">🐢</div>
          <div class="swimming-animal fish" v-for="n in 8" :key="'fish'+n">🐠</div>
        </div>

        <!-- Celebration Message -->
        <div class="celebration-message">
          <div class="message-icon">🎉</div>
          <h2>Terima Kasih!</h2>
          <p>Mari bersama membuat perbedaan untuk laut kita</p>
          <div class="celebration-emoji">🌊🌟💙</div>
          <button class="close-btn" @click="closeCelebration">Lanjutkan</button>
        </div>

        <!-- Bubbles -->
        <div class="bubbles">
          <div class="bubble" v-for="n in 15" :key="'bubble'+n"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Course4',
  data() {
    return {
      isPledging: false,
      buttonText: 'Saya Berjanji!',
      showCelebration: false
    }
  },
  methods: {
    triggerPledge() {
      if (this.isPledging) return;
      
      this.isPledging = true;
      this.buttonText = 'Membuat Janji...';
      
      // Simulate API call
      setTimeout(() => {
        this.buttonText = 'Berjanji! 🌟';
        this.showCelebration = true;
        
        // Reset button after celebration
        setTimeout(() => {
          this.isPledging = false;
          this.buttonText = 'Saya Berjanji!';
        }, 3000);
      }, 2000);
    },
    
    closeCelebration() {
      this.showCelebration = false;
    }
  }
}
</script>

<style scoped>
.course4{
  background-color: #735936;
}

.course4::before {
        content: ""; position: absolute; 
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('/foto/bgc4.jpg') no-repeat top center;
        background-size: contain;
        background-repeat: no-repeat;
        z-index: 0;
        pointer-events: none;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.6;
  color: #333;
  background: #f8fafc;
}

.container {
  max-width: 1000px;
  margin: 0 auto;
  padding: 0 20px;
}
/* Hero Section */
.hero {
  color: white;
  padding: 100px 0 80px;
  margin-top: 7px;
  position: relative;
  overflow: hidden;
}

.hero-content {
  text-align: center;
  max-width: 800px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}

.hero h1 {
  font-size: 3.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
  line-height: 1.2;
}

.hero p {
  font-size: 1.25rem;
  opacity: 0.9;
  margin-bottom: 2rem;
}

/* Main Content */
.content-wrapper {
  padding: 4rem 0;
}

/* Tips Section */
.tips-section {
  margin-bottom: 4rem;
}

.tips-section h2 {
  text-align: center;
  font-size: 2.5rem;
  color: whitesmoke;
  margin-bottom: 3rem;
  position: relative;
}


.tips-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;

}

.tip-card {
  background: rgba(255, 255, 255, 0.5);
  padding: 2rem;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  text-align: center;
  transition: transform 0.3s, box-shadow 0.3s;
  border: 1px solid #f1f5f9;
  z-index: 2;
}

.tip-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

.tip-icon {
  font-size: 3rem;
  margin-bottom: 1rem;
}

.tip-card h3 {
  color: #1e40af;
  margin-bottom: 1rem;
  font-size: 1.25rem;
}

.tip-card p {
  color: #64748b;
  line-height: 1.6;
}

/* Success Section */
.success-section {
  background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
  padding: 4rem 2rem;
  border-radius: 20px;
  margin-bottom: 4rem;
  border: 1px solid #bae6fd;
}

.success-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  align-items: center;
  max-width: 1000px;
  margin: 0 auto;
}

.success-text h3 {
  color: #1e40af;
  font-size: 2rem;
  margin-bottom: 1.5rem;
  line-height: 1.3;
}

.success-text p {
  color: #475569;
  margin-bottom: 1rem;
  line-height: 1.6;
}

.highlight {
  color: #dc2626;
  font-weight: 600;
  font-size: 1.1rem;
}

.success-visual {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
}

.coral-animation {
  position: relative;
  height: 100px;
  width: 100%;
}

.coral {
  position: absolute;
  font-size: 2rem;
  animation: coral-sway 3s ease-in-out infinite;
}

.coral-1 { left: 20%; animation-delay: 0s; }
.coral-2 { left: 50%; animation-delay: 1s; }
.coral-3 { left: 80%; animation-delay: 2s; }

@keyframes coral-sway {
  0%, 100% { transform: translateY(0px) rotate(-5deg); }
  50% { transform: translateY(-10px) rotate(5deg); }
}

.image-placeholder {
  width: 100%;
  height: 200px;
  background: #e0f2fe;
  border: 2px dashed #06b6d4;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #1e40af;
  font-weight: 500;
}

/* Pledge Section */
.pledge-section {
  background: white;
  padding: 4rem 2rem;
  border-radius: 20px;
  box-shadow: 0 8px 40px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.pledge-container {
  max-width: 600px;
  margin: 0 auto;
}

.pledge-section h3 {
  color: #1e40af;
  font-size: 2.5rem;
  margin-bottom: 1rem;
}

.pledge-subtitle {
  color: #64748b;
  font-size: 1.1rem;
  margin-bottom: 3rem;
}

/* Pledge Button */
.pledge-btn {
  background: linear-gradient(135deg, #1e40af, #06b6d4);
  color: white;
  border: none;
  padding: 1.5rem 3rem;
  font-size: 1.25rem;
  font-weight: 600;
  border-radius: 50px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition: all 0.3s;
  box-shadow: 0 8px 25px rgba(30, 64, 175, 0.3);
  margin-bottom: 3rem;
  min-width: 250px;
}

.pledge-btn:hover:not(.active) {
  transform: translateY(-3px);
  box-shadow: 0 12px 35px rgba(30, 64, 175, 0.4);
}

.pledge-btn.active {
  animation: buttonPulse 1s infinite;
  background: linear-gradient(135deg, #059669, #10b981);
}

.pledge-btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
  transform: none;
}

.btn-sparkle {
  position: absolute;
  width: 20px;
  height: 20px;
  background: white;
  border-radius: 50%;
  animation: sparkleFloat 2s ease-in-out infinite;
  opacity: 0;
}

.btn-sparkle:nth-child(1) { top: 20%; left: 20%; animation-delay: 0s; }
.btn-sparkle:nth-child(2) { top: 60%; left: 80%; animation-delay: 0.5s; }
.btn-sparkle:nth-child(3) { top: 80%; left: 40%; animation-delay: 1s; }
.btn-sparkle:nth-child(4) { top: 30%; left: 70%; animation-delay: 1.5s; }
.btn-sparkle:nth-child(5) { top: 70%; left: 10%; animation-delay: 0.2s; }
.btn-sparkle:nth-child(6) { top: 10%; left: 50%; animation-delay: 0.8s; }

@keyframes buttonPulse {
  0%, 100% {
    box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.7);
  }
  70% {
    box-shadow: 0 0 0 20px rgba(5, 150, 105, 0);
  }
}

@keyframes sparkleFloat {
  0%, 100% {
    transform: translateY(0) scale(0);
    opacity: 0;
  }
  50% {
    transform: translateY(-20px) scale(1);
    opacity: 1;
  }
}

/* Pledge Stats */
.pledge-stats {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
  margin-top: 2rem;
}

.stat {
  text-align: center;
}

.stat-number {
  font-size: 2.5rem;
  font-weight: 700;
  color: #1e40af;
  margin-bottom: 0.5rem;
}

.stat-label {
  color: #64748b;
  font-size: 0.9rem;
}

.navigation {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        max-width: 1000px;
        margin: 40px auto 0 auto;
        padding: 0 20px;
    }

    .nav-btn {
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-family: karla, serif;
        font-size: 1rem;
        cursor: pointer;
        transition: 0.3s;
        margin-bottom: 50px;
        z-index: 2;
    }

    .back-btn {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .next-btn {
        background: #0056a3;
        color: white;
    }

    .nav-btn:hover {
        transform: translateY(-2px);
    }

/* Celebration Overlay */
.celebration-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.8);
  z-index: 2000;
  display: flex;
  align-items: center;
  justify-content: center;
  animation: fadeIn 0.3s ease;
}

.celebration-content {
  position: relative;
  width: 90%;
  max-width: 500px;
  background: linear-gradient(135deg, #1e40af, #06b6d4);
  border-radius: 24px;
  padding: 3rem;
  text-align: center;
  color: white;
  overflow: hidden;
  animation: scaleIn 0.5s ease;
}

.celebration-ocean {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 30%;
  overflow: hidden;
}

.wave {
  position: absolute;
  bottom: 0;
  width: 200%;
  height: 100%;
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z' fill='%23ffffff' opacity='0.1'%3E%3C/path%3E%3C/svg%3E");
  animation: waveMove 10s linear infinite;
}

.wave:nth-child(2) {
  animation-delay: -5s;
  opacity: 0.5;
}

.marine-life {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
}

.swimming-animal {
  position: absolute;
  font-size: 2rem;
  animation: swimAcross 8s linear infinite;
}

.dolphin { top: 30%; animation-delay: 0s; }
.turtle { top: 50%; animation-delay: 2s; }
.fish { top: 70%; animation-delay: 1s; }

.bubbles {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
}

.bubble {
  position: absolute;
  background: rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  animation: bubbleRise 4s ease-in infinite;
  bottom: -20px;
}

.celebration-message {
  position: relative;
  z-index: 2;
}

.message-icon {
  font-size: 4rem;
  margin-bottom: 1rem;
  animation: bounce 2s ease-in-out infinite;
}

.celebration-message h2 {
  font-size: 2.5rem;
  margin-bottom: 1rem;
}

.celebration-message p {
  font-size: 1.1rem;
  margin-bottom: 2rem;
  opacity: 0.9;
}

.celebration-emoji {
  font-size: 2rem;
  margin-bottom: 2rem;
  animation: pulse 2s ease-in-out infinite;
}

.close-btn {
  background: rgba(255, 255, 255, 0.2);
  color: white;
  border: 2px solid white;
  padding: 0.75rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s;
  backdrop-filter: blur(10px);
}

.close-btn:hover {
  background: white;
  color: #1e40af;
}

/* Animations */
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes scaleIn {
  from { transform: scale(0.8); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}

@keyframes waveMove {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}

@keyframes swimAcross {
  0% { transform: translateX(-100px); }
  100% { transform: translateX(calc(100vw + 100px)); }
}

@keyframes bubbleRise {
  0% { transform: translateY(0) scale(0.5); opacity: 0; }
  50% { opacity: 1; }
  100% { transform: translateY(-100vh) scale(1.5); opacity: 0; }
}

@keyframes bounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-20px); }
}

@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.1); }
}

/* Responsive Design */
@media (max-width: 768px) {
  .navbar {
    flex-direction: column;
    gap: 1rem;
  }
  
  .nav-links {
    gap: 1rem;
  }
  
  .hero h1 {
    font-size: 2.5rem;
  }
  
  .success-content {
    grid-template-columns: 1fr;
    gap: 2rem;
  }
  
  .tips-grid {
    grid-template-columns: 1fr;
  }
  
  .pledge-stats {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  
  .celebration-content {
    padding: 2rem;
    margin: 1rem;
  }
  
  .celebration-message h2 {
    font-size: 2rem;
  }
}
</style>