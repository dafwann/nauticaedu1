<template>
    <div class="register-page">

        <div class="register-card">
            <div class="register-header">
                <h1 class="register-title">NauticaEdu</h1>
            </div>

            <h2 class="title">Reset Your Password</h2>

            <form @submit.prevent="submitReset" class="form">

                <!-- Email -->
                <div class="input-group">
                    <label>Email</label>
                    <input
                        v-model="email"
                        type="email"
                        placeholder="Enter your email"
                    />
                </div>

                <!-- New Password -->
                <div class="input-group">
                    <label>New Password</label>
                    <input
                        v-model="password"
                        type="password"
                        placeholder="Enter new password"
                    />
                    <p v-if="error" class="error">{{ error }}</p>
                </div>

                <button class="submit-btn">Reset Password</button>

            </form>

            <p class="login-link">
                Remember your password?
                <router-link to="/login">Login</router-link>
            </p>

        </div>

    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            email: "",
            password: "",
            error: ""
        };
    },

    methods: {
        async submitReset() {
            this.error = "";

            if (!this.email) {
                this.error = "Email is required";
                return;
            }

            if (!this.password || this.password.length < 6) {
                this.error = "Password must be at least 6 characters";
                return;
            }

            try {
                const res = await axios.post("https://web-production-39b5.up.railway.app/api/reset-password", {
                    email: this.email,
                    password: this.password
                });

                alert("Password reset successfully!");
                this.$router.push("/login");

            } catch (err) {
                if (err.response) {
                    this.error = err.response.data.message;
                } else {
                    this.error = "Server error. Try again.";
                }
            }
        }
    }
};
</script>


<style scoped>
/* Copy-paste semua style dari register page */
.register-page {
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

.register-header {
    background: linear-gradient(135deg, rgba(65, 128, 255, 0.5) 0%, rgba(116, 200, 239, 0.5) 100%);
    backdrop-filter: blur(10px);
    padding: 40px 20px;
    text-align: center;
    border-radius: 0;
    color: white;
    margin: -32px -32px 20px -32px;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}

.register-title {
    font-family: "Katibeh", serif;
    font-size: 3rem;
    font-weight: 400;
    margin: 0;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
}

.register-card {
    width: 420px;
    padding: 32px;
    background: rgba(251, 253, 254, 0.3) !important;
    border-radius: 20px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    backdrop-filter: blur(10px);
    overflow: hidden;
    position: relative;
    z-index: 2;
}

.title {
    font-family: "Katibeh", serif;
    font-size: 1.8rem;
    color: #003f83;
    margin: 0;
    text-align: center;
    font-weight: 700;
    margin-bottom: 28px;
}

.input-group {
    margin-bottom: 15px;
}

label {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 6px;
    color: #003f83;
}

input {
    width: 390px;
    padding: 12px;
    border: 1px solid #d4d7dd;
    border-radius: 10px;
    font-size: 15px;
    outline: none;
    transition: 0.2s;
}

input:focus {
    border-color: #003f83;
    box-shadow: 0 0 0 2px rgba(99,102,241,0.15);
}

.error {
    color: #e11d48;
    font-size: 13px;
    margin-top: 6px;
}

.submit-btn {
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
    margin-top: 10px;
}

.submit-btn:hover {
    background: #3d9bff;
    transition: all 0.3s ease;
    transform: translateY(-3px);
}

.login-link {
    text-align: center;
    margin-top: 16px;
    font-size: 14px;
    color: #666;
}

.login-link a {
    color: #003f83;
    cursor: pointer;
    font-weight: 600;
}

@media (max-width: 480px) {
    .register-card {
        width: 100%;
        padding: 24px;
    }
}
</style>
