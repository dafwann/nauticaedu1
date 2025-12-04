<template>
  <aside class="sidebar">
    <div class="sidebar-header">
      <h2>NeuticaEdu Admin</h2>
      <p>Panel Administrator</p>
    </div>
    
    <nav class="sidebar-nav">
      <ul>
        <li>
          <router-link 
            to="/admin" 
            class="nav-link"
            :class="{ active: $route.name === 'AdminDashboard' }"
          >
            📊 Dashboard
          </router-link>
        </li>
        <li>
          <router-link 
            to="/admin/users" 
            class="nav-link"
            :class="{ active: $route.name === 'AdminUsers' }"
          >
            👥 Management Pengguna
          </router-link>
        </li>
        <li>
          <router-link 
            to="/admin/berita" 
            class="nav-link"
            :class="{ active: $route.name === 'AdminBerita' }"
          >
            📰 Management Berita
          </router-link>
        </li>
        <li>
          <router-link 
            to="/admin/komunitas" 
            class="nav-link"
            :class="{ active: $route.name === 'AdminKomunitas' }"
          >
            🏘️ Management Komunitas
          </router-link>
        </li>
        <li>
          <router-link 
            to="/admin/volunteer" 
            class="nav-link"
            :class="{ active: $route.name === 'AdminVolunteer' }"
          >
            🤝 Management Volunteer
          </router-link>
        </li>
      </ul>
    </nav>
    
    <div class="sidebar-footer">
      <button @click="logout" class="logout-btn">
        🚪 Logout
      </button>
    </div>
  </aside>
</template>

<script>
import { useRouter } from 'vue-router'

export default {
  name: 'AdminSidebar',
  setup() {
    const router = useRouter()
    
    const logout = () => {
      if (confirm('Yakin ingin logout dari admin panel?')) {
        localStorage.removeItem('isLoggedIn')
        localStorage.removeItem('userData')
        router.push('/login')
      }
    }

    return {
      logout
    }
  }
}
</script>

<style scoped>


.sidebar {
  width: 250px;
  background: linear-gradient(135deg, #0860b8 0%, #003a61 100%);
  color: white;
  display: flex;
  flex-direction: column;
  height: 100vh;
  position: fixed;
  left: 0;
  top: 0;
  box-shadow: 2px 0 10px rgba(0,0,0,0.1);
  font-family: karla, serif;
  z-index: 2;
}

.sidebar-header {
  padding: 20px 10px;
  border-bottom: 1px solid rgba(255,255,255,0.1);
  text-align: center;
  font-family: katibeh, serif;
  
}

.sidebar-header h2 {
  margin: 0 0 5px 0;
  font-size: 18px;
  color: #ecf0f1;
  font-size: 25px;
}

.sidebar-header p {
  margin: 0;
  font-size: 12px;
  color: #bdc3c7;
  opacity: 0.8;
  font-size: 15px;
}

.sidebar-nav {
  flex: 1;
  padding: 20px 0;
  position: relative;
  z-index: 2;
}

.sidebar-nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.sidebar-nav li {
  margin: 5px 0;
}

.nav-link {
  display: block;
  width: 100%;
  padding: 12px 20px;
  background: none;
  border: none;
  color: #bdc3c7;
  text-decoration: none;
  text-align: left;
  cursor: pointer;
  font-size: 14px;
  transition: all 0.3s;
  border-left: 3px solid transparent;
}

.nav-link:hover {
  background: rgba(255,255,255,0.1);
  color: white;
}

.nav-link.active {
  background: rgba(255,255,255,0.1);
  color: white;
  border-left: 3px solid #3498db;
}

.sidebar-footer {
  padding: 20px;
  border-top: 1px solid rgba(255,255,255,0.1);
}

.logout-btn {
  width: 100%;
  padding: 12px;
  background: #e74c3c;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 14px;
  transition: background 0.3s;
}

.logout-btn:hover {
  background: #c0392b;
}
</style>