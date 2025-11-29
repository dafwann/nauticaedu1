<template>
  <div class="login-page">
    <div class="login-container">
      <!-- Header -->
      <div class="login-header">
        <h1 class="login-title">NauticaEdu</h1>
      </div>

      <!-- Login Form -->
      <div class="login-form-container">
        <form class="login-form" @submit.prevent="handleLogin">

          <!-- Error Message -->
          <div v-if="errorMessage" class="error-message">
            ⚠️ {{ errorMessage }}
          </div>

          <!-- Email/Username Input -->
          <div class="input-group">
            <label for="email" class="form-label">Email or Username</label>
            <input
              type="text"
              id="email"
              v-model="loginData.email"
              class="form-input"
              :class="{ 'error-input': errors.email }"
              placeholder="Enter your email or username"
              @input="clearError('email')"
            >
            <p v-if="errors.email" class="error">{{ errors.email }}</p>
          </div>

          <!-- Password Input -->
          <div class="input-group">
            <label for="password" class="form-label">Password</label>
            <div class="password-wrapper">
              <input
                :type="showPassword ? 'text' : 'password'"
                id="password"
                v-model="loginData.password"
                class="form-input"
                :class="{ 'error-input': errors.password }"
                placeholder="Enter your password"
                @input="clearError('password')"
              >
              <svg @click="showPassword = !showPassword" class="eye-icon" viewBox="0 0 24 24">
                <path v-if="!showPassword"
                  d="M12 4.5C7 4.5 2.7 7.6 1 12c1.7 4.4 6 7.5 11 7.5s9.3-3.1 11-7.5c-1.7-4.4-6-7.5-11-7.5zm0 12A4.5 4.5 0 1 1 12 7.5a4.5 4.5 0 0 1 0 9z"/>
                <path v-else
                  d="M3 3l18 18M10.6 10.6a3 3 0 0 0 4.2 4.2M6.7 6.7A9.8 9.8 0 0 1 12 4.5c5 0 9.3 3.1 11 7.5a12 12 0 0 1-5.3 5.8"/>
              </svg>
            </div>
            <p v-if="errors.password" class="error">{{ errors.password }}</p>
          </div>

          <!-- Register Link -->
          <div class="register-link">
            <span>Don't have an Account? </span>
            <router-link to="/register" class="register-text">Sign Up</router-link>   
            <br>                                         
            <span>Forget Password? </span>
            <a href="mailto:nauticaedu123@gmail.com" class="register-text">Reset Password</a>

          </div>

          <!-- Login Button -->
          <button type="submit" class="login-button" :disabled="isLoading">
            <span v-if="isLoading">🔄 Loading...</span>
            <span v-else>Login</span>
          </button>

        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: 'LoginPage',
  data() {
    return {
      loginData: {
        email: '',
        password: ''
      },
      errors: {},
      errorMessage: '',
      isLoading: false,
      showPassword: false
    }
  },
  methods: {
    clearError(field) {
      this.errors[field] = ''
      this.errorMessage = ''
    },

    validateForm() {
      this.errors = {}
      let isValid = true

      if (!this.loginData.email.trim()) {
        this.errors.email = 'Email or username is required'
        isValid = false
      }

      if (!this.loginData.password.trim()) {
        this.errors.password = 'Password is required'
        isValid = false
      }

      return isValid
    },

    async handleLogin() {
      if (!this.validateForm()) return

      this.isLoading = true
      this.errorMessage = ""

      try {
        const res = await axios.post("https://web-production-39b5.up.railway.app/api/login", {
          email: this.loginData.email,
          password: this.loginData.password
        })

        // Simpan login di localStorage
        localStorage.setItem("token", res.data.token)
        localStorage.setItem("isLoggedIn", "true") // harus string
        localStorage.setItem("userData", JSON.stringify(res.data.user)) // sesuai key router guard

        // Redirect sesuai role
        if (res.data.user.role === 'admin') {
          this.$router.push('/admin')
        } else {
          this.$router.push('/profile')
        }

      } catch (err) {
        if (err.response?.status === 422) {
          this.errors = err.response.data.errors
        } else {
          this.errorMessage = err.response?.data?.message || "Login failed"
        }
      } finally {
        this.isLoading = false
      }
    }
  }
}
</script>



<style scoped>
.login-page {
    display: flex;
    width: 100%;
    height: 100%;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    position: relative;
    margin: 0 !important;
    padding: 0 !important;
    overflow: hidden !important;
    background-image: url('/foto/aboutus.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

/* Login Container */
.login-container {
    background: rgba(251, 253, 254, 0.3) !important;
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    width: 100%;
    max-width: 450px;
    position: relative;
    z-index: 2;
}

/* Login Header */
.login-header {
    background: linear-gradient(135deg, rgba(65, 128, 255, 0.5) 0%, rgba(116, 200, 239, 0.5) 100%);
    backdrop-filter: blur(10px);
    padding: 40px 20px;
    padding-bottom: 30px;
    text-align: center;
    border-radius: 0;
    color: white;
    margin: -32px -32px 32px -32px;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}

.login-title {
    font-family: "Katibeh", serif;
    font-size: 3rem;
    font-weight: 400;
    margin: 0;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
}

/* Login Form */
.login-form-container {
    padding: 32px;
}

.input-group {
    margin-bottom: 15px;
}

.form-label {
    display: block;
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 6px;
    color: #003f83;
    text-transform: none; /* Remove lowercase */
}

.form-input {
    width: 100%;
    padding: 12px;
    border: 1px solid #d4d7dd;
    border-radius: 10px;
    font-size: 15px;
    outline: none;
    transition: 0.2s;
    box-sizing: border-box;
    background: #fafafa;
}

.form-input:focus {
    border-color: #003f83;
    box-shadow: 0 0 0 2px rgba(0, 63, 131, 0.15);
    background: white;
    transform: none; /* Remove translateY */
}

.form-input::placeholder {
    color: #999;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Password Wrapper - SAMA DENGAN REGISTER */
.password-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.eye-icon {
    width: 22px;
    height: 22px;
    position: absolute;
    right: 12px;
    cursor: pointer;
    stroke: #6b7280;
    fill: none;
}

/* Error Styles - SAMA DENGAN REGISTER */
.error {
    color: #e11d48;
    font-size: 13px;
    margin-top: 6px;
    margin-bottom: 0;
}

.error-input {
    border-color: #e11d48 !important;
    background: #fef2f2 !important;
}

.error-input:focus {
    border-color: #e11d48 !important;
    box-shadow: 0 0 0 2px rgba(225, 29, 72, 0.15) !important;
}

.error-message {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
    padding: 12px 16px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Register Link */
.register-link {
    text-align: center;
    margin: 20px 0;
    font-size: 14px;
    color: #666;
}

.register-text {
    color: #003f83;
    text-decoration: none;
    font-weight: 600;
    cursor: pointer;
}

.register-text:hover {
    color: #002752;
    text-decoration: underline;
}

/* Login Button */
.login-button {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, rgba(65, 128, 255, 0.9) 0%, rgba(116, 200, 239, 0.9) 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.login-button:hover:not(:disabled) {
    background: #3d9bff;
    transform: translateY(-3px);
}

.login-button:active:not(:disabled) {
    transform: translateY(-1px);
}

/* Loading State */
.login-button:disabled {
    background: #cccccc !important;
    cursor: not-allowed !important;
    transform: none !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .login-page {
        padding: 15px;
    }

    .login-container {
        max-width: 400px;
    }
    
    .login-header {
        padding: 30px 20px;
        margin: -24px -24px 20px -24px;
    }
    
    .login-title {
        font-size: 2.5rem;
    }
    
    .login-form-container {
        padding: 24px;
    }
}

@media (max-width: 480px) {
    .login-page {
        padding: 10px;
    }
    
    .login-container {
        border-radius: 15px;
    }
    
    .login-header {
        padding: 25px 20px;
        margin: -20px -20px 20px -20px;
    }
    
    .login-title {
        font-size: 2.2rem;
    }
    
    .login-form-container {
        padding: 20px;
    }
    
    .form-input {
        padding: 12px;
        font-size: 14px;
    }
    
    .login-button {
        padding: 12px;
        font-size: 15px;
    }
}
</style>