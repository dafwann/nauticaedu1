<template>
    <div class="profile-page">

        <!-- MAIN CONTAINER -->
        <main class="container">

            <!-- PROFILE CARD -->
            <section class="card profile-card animate-on-scroll">
                <div class="profile-left">

                    <div class="avatar">
                        <img v-if="user.avatar" :src="user.avatar" alt="Profile" class="avatar-image" />
                        <div v-else class="avatar-placeholder">
                            {{ user.username ? user.username.charAt(0).toUpperCase() : 'U' }}
                        </div>
                    </div>

                    <div class="profile-meta">
                        <h2 class="username">{{ user.username }}</h2>
                        <p class="email">{{ user.email }}</p>
                    </div>
                </div>
                
                <div class="profile-actions">
                    <button class="btn logout" @click="logout">Logout</button>
                </div>
            </section>

            <!-- QUICK ACTIONS -->
            <section class="card actions-card animate-on-scroll">
                <h3>Aksi Cepat</h3>
                <div class="actions-row">
                    <router-link class="action-btn" to="/course">Lanjutkan Course</router-link>
                    <router-link class="action-btn" to="/community">Komunitas</router-link>
                    <router-link class="action-btn" to="/aboutus">Tentang Kami</router-link>
                </div>
            </section>

        </main>
    </div>
</template>

<script>
export default {
    name: 'ProfilePage',
    data() {
        return {
            user: { 
                username: 'Guest',
                email: 'guest@example.com',
                avatar: ''
            },
            loaded: false // untuk menunggu load data
        }
    },

    computed: {
        isLoggedIn() {
            return localStorage.getItem('isLoggedIn') === 'true'
        }
    },

    watch: {
        isLoggedIn(newVal) {
            if (!newVal && this.loaded) {
                this.$router.push('/login')
            }
        }
    },

    mounted() {
        this.loadUserData()
        this.initScrollAnimations()
    },

    methods: {
        loadUserData() {
            if (!this.isLoggedIn) {
                this.$router.push('/login')
                return
            }

            const savedUserData = localStorage.getItem('userData')
            if (savedUserData) {
                const u = JSON.parse(savedUserData)
                this.user = {
                    username: u.username || 'Username',
                    email: u.email || 'No email',
                    avatar: u.avatar || ''
                }
            }
            this.loaded = true
        },

        logout() {
            localStorage.removeItem('userData')
            localStorage.removeItem('isLoggedIn')
            localStorage.removeItem('role')
            this.$router.push('/login')
        },

        initScrollAnimations() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible')
                        observer.unobserve(entry.target)
                    }
                })
            }, { threshold: 0.12 })

            document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el))
        }
    }
}
</script>


<style scoped>
.profile-page {
    position: relative;
    min-height: 100vh;
}

.profile-page::before {
    content: "";
    position: absolute;
    inset: 0;
    background: url('/foto/bgprofile.jpg') no-repeat center top;
    background-size: cover;
    z-index: -1;   /* jalan aman */
}

.container {
    padding-top: 80px;
    max-width: 1100px;
    margin: 0 auto 14px auto;
    width: calc(80% - 80px);
    display: grid;
    grid-template-columns: 1fr;
    gap: 18px;
    z-index: 2;
    position: relative;
    flex: 1;
    min-height: calc(50vh - 50px);
}

.card {
    background: rgba(255,255,255,0.95);
    border-radius: 12px;
    padding: 10px 14px; /* lebih tipis */
    box-shadow: 0 6px 20px rgba(11,91,168,0.06);
}


.profile-card {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
}

.profile-left {
    display: flex;
    align-items: center;
    gap: 14px;
    flex: 1;
}

.avatar {
    width: 84px;
    height: 84px;
    border-radius: 50%;
    background: linear-gradient(135deg,#dcecff,#bfe0ff);
    box-shadow: 0 6px 12px rgba(0,0,0,0.08);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.avatar-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.avatar-placeholder {
    font-size: 2rem;
    font-weight: bold;
    color: #004b8f;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}

.profile-meta {
    flex: 1;
}

.username {
    font-size: 20px;
    margin: 0;
    display: flex;
    align-items: center;
}

.email {
    margin: 6px 0 0 0;
    color: #41627a;
}

.profile-actions {
    flex-shrink: 0;
}

.profile-actions .btn.logout {
    background: #ff5c3b;
    color: #fff;
    border: none;
    padding: 10px 14px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.3s ease;
}

.profile-actions .btn.logout:hover {
    background: #e04a2d;
}

.actions-row {
    display: flex;
    gap: 12px;
}

.action-btn {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 8px;
    background: #eef5ff;
    border-radius: 10px;
    text-decoration: none;
    color: #084a86;
    font-weight: 700;
    transition: all 0.3s ease;
}

.action-btn:hover {
    background: #dce9ff;
    transform: translateY(-1px);
}

/* ANIMATION */
.animate-on-scroll {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s ease-out, transform 0.5s ease-out;
}

.animate-on-scroll.is-visible {
    opacity: 1;
    transform: translateY(0);
}

/* RESPONSIVE */
@media (max-width: 600px) {
    .container { 
        width: calc(100% - 28px); 
        margin: 12px auto;
        padding-top: 30px;
        overflow-y: auto;
    }
    
    .profile-card { 
        flex-direction: column; 
        align-items: flex-start;
        gap: 16px;
    }
    
    .profile-actions { 
        width: 100%; 
        display: flex; 
        justify-content: flex-end; 
        margin-top: 8px;
    }
    
    .actions-row { 
        flex-direction: column;
    }
    
    .action-btn { 
        width: 100%;
    }
}

@media (max-width: 400px) {
    .avatar {
        width: 70px;
        height: 70px;
    }
    
    .avatar-placeholder {
        font-size: 1.5rem;
    }
}

</style>