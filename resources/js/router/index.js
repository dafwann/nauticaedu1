import { createRouter, createWebHistory } from 'vue-router'

// Pages
const Home = () => import('../Pages/Home.vue')
const Course = () => import('../Pages/Course.vue')
const Community = () => import('../Pages/Community.vue')
const AboutUs = () => import('../Pages/AboutUs.vue')
const Profile = () => import('../Pages/Profile.vue')
const Quiz = () => import('../Pages/Quiz.vue')
const Login = () => import('../Pages/Login.vue')
const Register = () => import('../Pages/Register.vue')
const ResetPassword = () => import('../Pages/Reset-password.vue')

// Course pages
const Course1 = () => import('../Pages/Course1.vue')
const Course2 = () => import('../Pages/Course2.vue')
const Course3 = () => import('../Pages/Course3.vue')
const Course4 = () => import('../Pages/Course4.vue')

// Admin pages
const AdminLayout = () => import('../components/AdminLayout.vue')
const AdminDashboard = () => import('../Pages/admin/Dashboard.vue')
const AdminUsers = () => import('../Pages/admin/Users.vue')
const AdminBerita = () => import('../Pages/admin/Berita.vue')
const AdminKomunitas = () => import('../Pages/admin/Komunitas.vue')
const AdminVolunteer = () => import('../Pages/admin/Volunteer.vue')

const routes = [
  { path: '/', name: 'Home', component: Home },
  { path: '/course', name: 'Course', component: Course },
  { path: '/community', name: 'Community', component: Community },
  { path: '/aboutus', name: 'AboutUs', component: AboutUs },
  { path: '/profile', name: 'Profile', component: Profile },
  { path: '/quiz', name: 'Quiz', component: Quiz },

  { path: '/course/1', name: 'Course1', component: Course1 },
  { path: '/course/2', name: 'Course2', component: Course2 },
  { path: '/course/3', name: 'Course3', component: Course3 },
  { path: '/course/4', name: 'Course4', component: Course4 },

  { path: '/login', name: 'Login', component: Login },
  { path: '/register', name: 'Register', component: Register },

  // ✅ hanya admin bisa akses
  { path: '/reset-password', name: 'ResetPassword', component: ResetPassword, meta: { requiresAdmin: true } },

  // Admin routes
  {
    path: '/admin',
    component: AdminLayout,
    meta: { requiresAdmin: true },
    children: [
      { path: '', name: 'AdminDashboard', component: AdminDashboard },
      { path: 'users', name: 'AdminUsers', component: AdminUsers },
      { path: 'berita', name: 'AdminBerita', component: AdminBerita },
      { path: 'komunitas', name: 'AdminKomunitas', component: AdminKomunitas },
      { path: 'volunteer', name: 'AdminVolunteer', component: AdminVolunteer },
    ]
  }
]



const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior() {
    return new Promise((resolve) => {
      setTimeout(() => resolve({ top: 0, behavior: 'smooth' }), 100)
    })
  }
})


// Route guard
router.beforeEach((to, from, next) => {
  const isLoggedIn = localStorage.getItem('isLoggedIn')
  const userData = localStorage.getItem('userData')

  if (to.meta.requiresAdmin) {
    if (!isLoggedIn) return next('/login')

    try {
      const user = JSON.parse(userData)
      if (user.role !== 'admin') return next('/') // non-admin dialihkan
    } catch (e) {
      return next('/login')
    }
  }

  next()
})

export default router
