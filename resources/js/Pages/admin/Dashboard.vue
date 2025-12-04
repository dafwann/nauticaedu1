<template>
  <div class="admin-dashboard">
    <!-- Header Section -->
    <div class="dashboard-header">
      <div class="header-content">
        <div class="header-text">
          <h1>📊 Dashboard Admin</h1>
          <p>Selamat datang di panel administrator</p>
          <div class="last-update" v-if="lastUpdateTime">
            🔄 Terupdate: {{ lastUpdateTime }}
          </div>
        </div>

        <!-- Profile -->
        <div class="admin-profile">
          <div class="profile-card">
            <div class="avatar">{{ userInitials }}</div>
            <div class="profile-details">
              <h4>{{ userData.name }}</h4>
              <p>{{ userData.email }}</p>
              <span class="role-badge">{{ userData.role }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-section">
      <div class="stats-container">
        <div class="stats-header">
          <h2>Statistik Platform</h2>

          <div class="stats-actions">
            <!-- BACK BUTTON -->
            <router-link to="/profile" class="refresh-btn back-btn">
              ⬅ Back
            </router-link>


            <!-- REFRESH BUTTON -->
            <button @click="fetchStats" class="refresh-btn" :disabled="loading">
              {{ loading ? "🔄 Memuat..." : "🔄 Refresh" }}
            </button>
          </div>
        </div>


        <div class="stats-grid">
          <!-- USERS -->
          <div class="stat-card">
            <div class="stat-icon">🙆</div>
            <div class="stat-content">
              <div class="stat-number">{{ stats.totalUsers.toLocaleString() }}</div>
              <div class="stat-label">Total Pengguna</div>
            </div>
          </div>

          <!-- BERITA -->
          <div class="stat-card">
            <div class="stat-icon">🗞</div>
            <div class="stat-content">
              <div class="stat-number">{{ stats.totalNews.toLocaleString() }}</div>
              <div class="stat-label">Berita Publik</div>
            </div>
          </div>

          <!-- KOMUNITAS -->
          <div class="stat-card">
            <div class="stat-icon">🏘</div>
            <div class="stat-content">
              <div class="stat-number">{{ stats.totalCommunities.toLocaleString() }}</div>
              <div class="stat-label">Komunitas Aktif</div>
            </div>
          </div>

          <!-- EVENT / VOLUNTEER -->
          <div class="stat-card">
            <div class="stat-icon">🎗</div>
            <div class="stat-content">
              <div class="stat-number">{{ stats.totalVolunteers.toLocaleString() }}</div>
              <div class="stat-label">Relawan Aktif</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="main-content">
      <div class="content-section">
        <h2>Quick Actions</h2>
        <div class="actions-grid">
          <router-link to="/admin/users" class="action-card">
            <div class="action-icon">👥</div>
            <div class="action-content">
              <h3>Kelola Pengguna</h3>
              <p>Management data pengguna</p>
            </div>
          </router-link>

          <router-link to="/admin/berita" class="action-card">
            <div class="action-icon">📰</div>
            <div class="action-content">
              <h3>Kelola Berita</h3>
              <p>Management konten berita</p>
            </div>
          </router-link>

          <router-link to="/admin/komunitas" class="action-card">
            <div class="action-icon">🏘️</div>
            <div class="action-content">
              <h3>Kelola Komunitas</h3>
              <p>Management komunitas</p>
            </div>
          </router-link>

          <router-link to="/admin/volunteer" class="action-card">
            <div class="action-icon">🤝</div>
            <div class="action-content">
              <h3>Kelola Volunteer</h3>
              <p>Management kegiatan & volunteer</p>
            </div>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, onUnmounted, computed } from "vue";
import axios from "axios";

export default {
  name: "AdminDashboard",

  setup() {
    // User data from localStorage
    const userData = ref({
      name: "Administrator",
      email: "admin@ecolearn.com",
      role: "Super Admin",
    });

    const stats = ref({
      totalUsers: 0,
      totalNews: 0,
      totalCommunities: 0,
      totalVolunteers: 0,
    });

    const lastUpdateTime = ref("");
    const loading = ref(false);
    let autoUpdateInterval = null;

    const userInitials = computed(() => {
      if (!userData.value.name) return "A";
      return userData.value.name
        .split(" ")
        .map((w) => w[0])
        .join("")
        .toUpperCase()
        .substring(0, 2);
    });

    const fetchUserData = () => {
      try {
        const stored = localStorage.getItem("userData");
        if (stored) {
          const parsed = JSON.parse(stored);
          userData.value = {
            ...userData.value,
            ...parsed,
            name: parsed.username || parsed.name || "Administrator",
          };
        }
      } catch (e) {
        console.error("User Data Error:", e);
      }
    };

    // 🔥 FETCH REAL DATA DARI BACKEND
    const fetchStats = async () => {
      loading.value = true

      try {
        const res = await fetch("https://web-production-39b5.up.railway.app/api/admin/stats")
        const data = await res.json()

        stats.value = {
          totalUsers: data.totalUsers,
          totalNews: data.totalNews,
          totalCommunities: data.totalCommunities,
          totalVolunteers: data.totalVolunteers,
          userGrowth: 0,
          newsGrowth: 0,
          communityGrowth: 0,
          volunteerGrowth: 0
        }

        lastUpdateTime.value = new Date().toLocaleTimeString('id-ID')
      } catch (error) {
        console.error(error)
      } finally {
        loading.value = false
      }
    }


    const startAutoUpdate = () => {
      autoUpdateInterval = setInterval(fetchStats, 30000);
    };

    const stopAutoUpdate = () => {
      if (autoUpdateInterval) clearInterval(autoUpdateInterval);
    };

    onMounted(() => {
      fetchUserData();
      fetchStats();
      startAutoUpdate();
    });

    onUnmounted(() => stopAutoUpdate());

    return {
      stats,
      userData,
      userInitials,
      loading,
      lastUpdateTime,
      fetchStats,
    };
  },
};
</script>



<style scoped>
* {
    font-family: "Karla", sans-serif !important;
}

/* Base Layout */
.admin-dashboard {
  min-height: 100vh;
  background: #f8f9fa;
  font-family: karla, serif;
}

/* Header */
.dashboard-header {
  background: white;
  padding: 24px 30px;
  border-bottom: 1px solid #e9ecef;
  box-shadow: 0 1px 3px rgba(0,0,0,0.1);

}

.header-content {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  max-width: 1200px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}

.header-text h1 {
  margin: 0 0 8px 0;
  font-size: 28px;
  color: #2c3e50;
  font-weight: 700;
}

.header-text p {
  margin: 0 0 6px 0;
  color: #6c757d;
  font-size: 16px;
}

.last-update {
  font-size: 12px;
  color: #95a5a6;
}

/* Profile */
.admin-profile {
  flex-shrink: 0;
}

.profile-card {
  display: flex;
  align-items: center;
  gap: 15px;
  padding: 16px 20px;
  background: #f8f9fa;
  border-radius: 12px;
  border: 1px solid #e9ecef;
  min-width: 280px;
}

.stats-actions {
  display: flex;
  align-items: center;
  gap: 10px; /* jarak antar tombol */
}

.back-btn {
  background: #e0e0e0;
}

.avatar {
  width: 50px;
  height: 50px;
  background: linear-gradient(135deg, #3498db, #2c3e50);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: bold;
  font-size: 16px;
  flex-shrink: 0;
}

.profile-details h4 {
  margin: 0 0 4px 0;
  font-size: 16px;
  color: #2c3e50;
  font-weight: 600;
}

.profile-details p {
  margin: 0 0 6px 0;
  font-size: 14px;
  color: #6c757d;
}

.role-badge {
  background: #27ae60;
  color: white;
  padding: 4px 10px;
  border-radius: 12px;
  font-size: 12px;
  font-weight: 500;
}

/* Statistics Section */
.stats-section {
  padding: 30px;
  background: #f8f9fa;
  font-family: karla, serif;
}

.stats-container {
  max-width: 1200px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}

.stats-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}

.stats-header h2 {
  margin: 0;
  font-size: 24px;
  color: #2c3e50;
  font-weight: 600;
}

.refresh-btn {
  background: #3498db;
  color: white;
  border: none;
  padding: 10px 16px;
  border-radius: 8px;
  font-size: 14px;
  cursor: pointer;
  transition: background 0.3s;
  display: flex;
  align-items: center;
  gap: 8px;
}

.refresh-btn:hover:not(:disabled) {
  background: #2980b9;
}

.refresh-btn:disabled {
  background: #bdc3c7;
  cursor: not-allowed;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}

.stat-card {
  background: white;
  padding: 24px;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  border: 1px solid #e9ecef;
  display: flex;
  align-items: center;
  gap: 16px;
  transition: all 0.3s ease;
  position: relative;
  z-index: 2;
}

.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.12);
}

.stat-icon {
  font-size: 32px;
  padding: 16px;
  background: #f8f9fa;
  border-radius: 12px;
  width: 70px;
  height: 70px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.stat-content {
  flex: 1;
}

.stat-number {
  font-size: 32px;
  font-weight: 700;
  color: #2c3e50;
  line-height: 1;
  margin-bottom: 8px;
}

.stat-label {
  font-size: 14px;
  color: #6c757d;
  font-weight: 500;
  margin-bottom: 8px;
}

.stat-trend {
  font-size: 12px;
  font-weight: 600;
  padding: 4px 8px;
  border-radius: 12px;
  display: inline-block;
}

.stat-trend.positive {
  background: #e8f5e8;
  color: #27ae60;
}

.stat-trend.negative {
  background: #fde8e8;
  color: #e74c3c;
}

.stat-trend.neutral {
  background: #f8f9fa;
  color: #6c757d;
}

/* Main Content */
.main-content {
  padding: 0 30px 30px;
  max-width: 1200px;
  margin: 0 auto;
}

.content-section {
  background: white;
  border-radius: 12px;
  padding: 24px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  border: 1px solid #e9ecef;
  position: relative;
  z-index: 2;
}

.content-section h2 {
  margin: 0 0 20px 0;
  font-size: 24px;
  color: #2c3e50;
  font-weight: 600;
}

.actions-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
}

.action-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 16px;
  padding: 24px;
  background: #f8f9fa;
  border-radius: 10px;
  text-decoration: none;
  color: inherit;
  border: 1px solid #e9ecef;
  transition: all 0.3s ease;
  text-align: center;
  position: relative;
  z-index: 2;
}

.action-card:hover {
  background: #3498db;
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
}

.action-icon {
  font-size: 32px;
  padding: 16px;
  background: white;
  border-radius: 12px;
  width: 70px;
  height: 70px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.action-card:hover .action-icon {
  background: rgba(255,255,255,0.2);
}

.action-content h3 {
  margin: 0 0 8px 0;
  font-size: 16px;
  font-weight: 600;
}

.action-content p {
  margin: 0;
  font-size: 12px;
  opacity: 0.8;
}

/* Responsive Design */
@media (max-width: 1024px) {
  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .actions-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .dashboard-header {
    padding: 20px;
  }
  
  .header-content {
    flex-direction: column;
    gap: 16px;
  }
  
  .profile-card {
    width: 100%;
    min-width: auto;
  }
  
  .stats-section {
    padding: 20px;
  }
  
  .main-content {
    padding: 0 20px 20px;
  }
  
  .stats-grid {
    grid-template-columns: 1fr;
  }
  
  .actions-grid {
    grid-template-columns: 1fr;
  }
  
  .content-section {
    padding: 20px;
  }
}

@media (max-width: 480px) {
  .header-text h1 {
    font-size: 24px;
  }
  
  .stat-card {
    padding: 20px;
  }
  
  .stat-number {
    font-size: 28px;
  }
  
  .action-card {
    padding: 20px;
  }
}
</style>