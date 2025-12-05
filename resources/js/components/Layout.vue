<template>
  <div class="app-layout">
    <!-- Marine Background -->
    <div class="marine-background">
      <div class="floating-fish fish-1">🐠</div>
      <div class="floating-fish fish-2">🐡</div>
      <div class="floating-fish fish-3">🐟</div>
      <div class="floating-fish fish-4">🦈</div>
    </div>

    <!-- Header -->
    <header v-if="!shouldHideHeader" class="main-header">
      <div class="logo">NauticaEdū</div>
      
      <nav class="nav-scroll">
        <router-link to="/">Home</router-link>
        <router-link to="/course">Course</router-link>
        <router-link to="/community">Community</router-link>
        <router-link to="/aboutus">About Us</router-link>
      </nav>
      
      <!-- Profile/Login Icon -->
      <div class="profile-icon" @click="handleProfileClick">
        <div v-if="isLoggedIn" class="profile-circle">
          <svg class="profile-svg" viewBox="0 0 24 24">
            <circle cx="12" cy="7" r="5"/>
            <path d="M12 14c-6 0-10 3-10 7h20c0-4-4-7-10-7z"/>
          </svg>
        </div>
        <div v-else class="login-icon">
          <svg class="login-svg" viewBox="0 0 24 24">
            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
          </svg>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main :class="['main-content', { 'no-header': shouldHideHeader }]">
      <!-- Bubble Animation -->
      <div class="bubbles-container" v-if="showBubbles">
        <div 
          v-for="bubble in bubbles" 
          :key="bubble.id" 
          :class="['bubble', `bubble-${bubble.size}`]"
          :style="{
            left: bubble.position + '%',
            animationDelay: bubble.delay + 's',
            animationDuration: bubble.duration + 's'
          }"
        >
          <div class="bubble-shine"></div>
        </div>
      </div>

      <!-- Router View -->
      <router-view v-slot="{ Component }">
          <template v-if="!hasError">
            <transition name="page-fade" mode="out-in">
              <component :is="Component" />
            </transition>
          </template>
          <template v-else>
            <div class="error-fallback">
              <h2>⚠️ Terjadi Kesalahan</h2>
              <p>Maaf, terjadi masalah saat memuat halaman.</p>
              <button @click="resetError" class="retry-button">Coba Lagi</button>
            </div>
          </template>
      </router-view>
    </main>


    <!-- Footer
    <footer v-if="!isAuthPage" class="main-footer">
      &copy; 2025 Modul Edukasi Laut Kita Terancam - Semua hak cipta dilindungi.
    </footer>-->
  </div>
</template>

<script>
import { ref, onMounted, watch, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'

export default {
  name: 'AppLayout',
  setup() {
    const route = useRoute()
    const router = useRouter()
    
    const showBubbles = ref(false)
    const bubbles = ref([])
    const isLoggedIn = ref(false)
    const hasError = ref(false)

    // Computed property to check if header should be hidden
    const shouldHideHeader = computed(() => {
      const routeName = route.name?.toString() || ''
      const routePath = route.path?.toString() || ''
      
      console.log('🔄 Route Detection:', {
        routeName: routeName,
        routePath: routePath,
        isAuthPage: ['Login', 'Register'].includes(routeName),
        isAdminPage: routePath.startsWith('/admin'),
        shouldHideHeader: ['Login', 'Register'].includes(routeName) || routePath.startsWith('/admin')
      })
      
      // Hide header untuk auth pages DAN admin pages
      const isAuthPage = ['Login', 'Register'].includes(routeName)
      const isAdminPage = routePath.startsWith('/admin')
      
      return isAuthPage || isAdminPage
    })

    // Check login status dengan error handling
    const checkLoginStatus = () => {
      try {
        const user = localStorage.getItem('user')
        isLoggedIn.value = !!user
      } catch (error) {
        console.error('Error checking login status:', error)
        isLoggedIn.value = false
      }
    }

    // Handle profile icon click tanpa cek login
    const handleProfileClick = () => {
      router.push('/profile')
    }

    // Update login status dengan error handling
    const updateLoginStatus = (status) => {
      try {
        isLoggedIn.value = status
        if (status) {
          localStorage.setItem('user', 'logged_in')
        } else {
          localStorage.removeItem('user')
          localStorage.removeItem('userData')
        }
      } catch (error) {
        console.error('Error updating login status:', error)
        throw new Error('Gagal memperbarui status login')
      }
    }

    // Generate bubbles dengan error handling
    const generateBubbles = () => {
      try {
        const newBubbles = []
        for (let i = 0; i < 15; i++) {
          newBubbles.push({
            id: i,
            size: Math.floor(Math.random() * 4) + 1,
            position: Math.random() * 100,
            delay: Math.random() * 2,
            duration: Math.random() * 3 + 2
          })
        }
        bubbles.value = newBubbles
      } catch (error) {
        console.error('Error generating bubbles:', error)
        bubbles.value = []
      }
    }

    // Reset error state
    const resetError = () => {
      hasError.value = false
      window.location.reload()
    }

    // Error handler untuk global errors
    const handleGlobalError = (error) => {
      console.error('Global error caught:', error)
      hasError.value = true
    }

    // Initialize on mount
    onMounted(() => {
      try {
        checkLoginStatus()
        window.updateLoginStatus = updateLoginStatus
        
        // Add global error handler
        window.addEventListener('error', handleGlobalError)
        window.addEventListener('unhandledrejection', handleGlobalError)
      } catch (error) {
        console.error('Error during component mount:', error)
        hasError.value = true
      }
    })

    // Cleanup event listeners
    const cleanup = () => {
      window.removeEventListener('error', handleGlobalError)
      window.removeEventListener('unhandledrejection', handleGlobalError)
    }

    // Watch route changes untuk bubble animation
    watch(route, (to, from) => {
      try {
        // Only show bubbles on non-admin, non-auth pages
        if (!shouldHideHeader.value) {
          showBubbles.value = true
          generateBubbles()
          setTimeout(() => {
            showBubbles.value = false
          }, 2000)
        }
        
        // Reset error state on route change
        hasError.value = false
      } catch (error) {
        console.error('Error during route change:', error)
        hasError.value = true
      }
    })

    return {
      showBubbles,
      bubbles,
      isLoggedIn,
      shouldHideHeader, 
      hasError,
      handleProfileClick,
      updateLoginStatus,
      resetError
    }
  },
  
  // Vue error handler
  errorCaptured(err, instance, info) {
    console.error('Error captured in Layout:', err, info)
    this.hasError = true
    return false // Prevent propagation
  },
  
  // Cleanup
  beforeUnmount() {
    window.removeEventListener('error', this.handleGlobalError)
    window.removeEventListener('unhandledrejection', this.handleGlobalError)
  }
}
</script>


<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Katibeh&display=swap');

.app-layout {
  min-height: 100vh;
  position: relative;
  overflow-x: hidden;
}

/* Marine Background */
.marine-background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: 1;
}



@keyframes wave-animation {
  0% { transform: translateX(0); }
  50% { transform: translateX(-50%); }
  100% { transform: translateX(0); }
}

.floating-fish {
  position: absolute;
  font-size: 32px;
  animation: float-fish 20s ease-in-out infinite;
  filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.3));
  z-index: 1;
}

.fish-1 {
  top: 15%;
  left: 5%;
  animation-delay: 0s;
  animation-duration: 25s;
}
.fish-2 {
  top: 65%;
  left: 85%;
  animation-delay: -7s;
  animation-duration: 30s;
}
.fish-3 {
  top: 35%;
  left: 70%;
  animation-delay: -12s;
  animation-duration: 22s;
}
.fish-4 {
  top: 55%;
  left: 15%;
  animation-delay: -18s;
  animation-duration: 28s;
}

@keyframes float-fish {
  0%, 100% {
    transform: translateX(0) translateY(0) rotateY(0deg);
  }
  25% {
    transform: translateX(20vw) translateY(-5vh) rotateY(0deg);
  }
  50% {
    transform: translateX(40vw) translateY(3vh) rotateY(180deg);
  }
  75% {
    transform: translateX(20vw) translateY(-2vh) rotateY(180deg);
  }
}

/* Header Styles */
.main-header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  padding: 5px 10px;
  background-color: rgba(189, 219, 253, 0.5);
  backdrop-filter: blur(5px);
  /*border-bottom: 1px solid rgba(255, 255, 255, 0.1);*/
  display: flex;
  align-items: center;
  justify-content: space-between;
  z-index: 1000;
  box-shadow: 0 2px 15px rgba(0,0,0,0.01);
  box-sizing: border-box;
}

.logo {
  font-size: 40px;
  flex: 0 0 250px !important; /* grow, shrink, basis */
  flex-shrink: 0; /* Tidak boleh mengecil */
  display: flex;
  align-items: center;
  justify-content: left;
  font-weight: bold;
  color: white;
  font-family: "Katibeh", serif;
  white-space: nowrap;
  text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
}

/* NAVBAR DI TENGAH */
.nav-scroll {
  display: flex;
  gap: 90px;
  overflow-x: auto;
  white-space: nowrap;
  padding: 6px 0;
  scrollbar-width: none;
}


.nav-scroll::-webkit-scrollbar {
  display: none;
}

.nav-scroll a {
  color: white;
  text-decoration: none;
  font-size: 18px;
  font-weight: 500;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  border-radius: 8px;
  transition: 0.25s ease;
}

.nav-scroll a:hover,
.nav-scroll a.router-link-active {
  color: #0060C0;
  font-weight: 600;
}

/* Profile Icon Styles */
.profile-icon {
  display: flex;
  align-items: center;
  cursor: pointer;
  flex-shrink: 0;
}

.login-icon,
.profile-circle {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid rgba(255, 255, 255, 0.3);
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
}

.login-icon:hover,
.profile-circle:hover {
  background: rgba(255, 255, 255, 0.3);
  border-color: rgba(255, 255, 255, 0.5);
  transform: scale(1.05);
}

.login-svg,
.profile-svg {
  width: 24px;
  height: 24px;
  fill: white;
}

/* Main Content */
.main-content {
  min-height: calc(100vh - 120px);
  padding-top: 0px;
  position: relative;
}

/* Bubble Animation */
.bubbles-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: 999;
}

.bubble {
  position: absolute;
  bottom: -50px;
  border-radius: 50%;
  animation: bubble-rise linear forwards;
  background: radial-gradient(
    circle at 30% 30%,
    rgba(255, 255, 255, 0.9) 0%,
    rgba(255, 255, 255, 0.7) 20%,
    rgba(255, 255, 255, 0.4) 60%,
    rgba(255, 255, 255, 0.2) 100%
  );
  box-shadow: 0 0 10px rgba(255, 255, 255, 0.6);
}

.bubble-1 { width: 12px; height: 12px; }
.bubble-2 { width: 18px; height: 18px; }
.bubble-3 { width: 24px; height: 24px; }
.bubble-4 { width: 30px; height: 30px; }

.bubble-shine {
  width: 30%;
  height: 30%;
  background: rgba(255, 255, 255, 0.9);
  border-radius: 50%;
  position: absolute;
  top: 20%;
  left: 20%;
  animation: shine-sparkle 2s ease-in-out infinite;
}

@keyframes bubble-rise {
  0% { transform: translateY(0) scale(0.8); opacity: 0.8; }
  50% { transform: translateY(-50vh) scale(1.1); opacity: 1; }
  100% { transform: translateY(-100vh) scale(0.9); opacity: 0; }
}

@keyframes shine-sparkle {
  0%, 100% { opacity: 0.7; transform: scale(1); }
  50% { opacity: 1; transform: scale(1.2); }
}

/* Page Transition */
.page-fade-enter-active,
.page-fade-leave-active {
  transition: opacity 0.3s ease;
}

.page-fade-enter-from,
.page-fade-leave-to {
  opacity: 0;
}

/* Footer
.main-footer {
  background: #0b5ba8;
  color: white;
  text-align: center;
  padding: 20px;
  font-size: 0.9rem;
}*/

/* Responsive Design */
@media (max-width: 768px) {
  .main-header {
    padding: 10px 15px;
  }

  .logo {
    font-size: 30px;
  }

  .nav-scroll {
    gap: 20px;
  }

  .nav-scroll a {
    font-size: 16px;
    padding: 6px 12px;
  }

  .login-icon,
  .profile-circle {
    width: 40px;
    height: 40px;
  }

  .login-svg,
  .profile-svg {
    width: 20px;
    height: 20px;
  }

  .main-content {
    padding-top: 0px;
  }
}

@media (max-width: 480px) {
  .nav-scroll {
    gap: 20px;
  }
  
  .nav-scroll a {
    font-size: 14px;
    padding: 4px 8px;
  }
  
  .logo {
    font-size: 30px;
  }

  .main-content.no-header {
    padding-top: 0 !important;
    min-height: 100vh;
  }

  .main-content.auth-layout {
    padding-top: 0 !important;
    min-height: 100vh;
  }

  /* Error Fallback Styles */
  .error-fallback {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 50vh;
    text-align: center;
    padding: 40px 20px;
  }

  .error-fallback h2 {
    color: #f44336;
    margin-bottom: 15px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .error-fallback p {
    color: #666;
    margin-bottom: 25px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .retry-button {
    background: #00796b;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    cursor: pointer;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .retry-button:hover {
    background: #004d40;
    transform: translateY(-2px);
  }

  .main-content.no-header {
  padding-top: 0 !important; /* Untuk auth pages */
}

}
</style>