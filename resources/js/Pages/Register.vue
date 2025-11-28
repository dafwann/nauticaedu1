<template>
    <div class="register-page">

        <div class="register-card">
            <div class="register-header">
                <h1 class="register-title">NauticaEdu</h1>
            </div>

            <h2 class="title">Create Your Account</h2>

            <form @submit.prevent="submitForm" class="form">

                <!-- Email -->
                <div class="input-group">
                    <label>Email</label>
                    <input v-model="form.email" type="email" placeholder="Enter your email" />
                    <p v-if="errors.email" class="error">{{ errors.email }}</p>
                </div>

                <!-- Username -->
                <div class="input-group">
                    <label>Username</label>
                    <input v-model="form.username" type="text" placeholder="Enter your username" />
                    <p v-if="errors.username" class="error">{{ errors.username }}</p>
                </div>

                <!-- Password -->
                <div class="input-group">
                    <label>Password</label>
                    <div class="password-wrapper">
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            v-model="form.password"
                            placeholder="Create a secure password"
                        />

                        <svg @click="showPassword = !showPassword" class="eye-icon" viewBox="0 0 24 24">
                            <path v-if="!showPassword"
                                d="M12 4.5C7 4.5 2.7 7.6 1 12c1.7 4.4 6 7.5 11 7.5s9.3-3.1 11-7.5c-1.7-4.4-6-7.5-11-7.5zm0 12A4.5 4.5 0 1 1 12 7.5a4.5 4.5 0 0 1 0 9z"/>
                            <path v-else
                                d="M3 3l18 18M10.6 10.6a3 3 0 0 0 4.2 4.2M6.7 6.7A9.8 9.8 0 0 1 12 4.5c5 0 9.3 3.1 11 7.5a12 12 0 0 1-5.3 5.8"/>
                        </svg>
                    </div>

                    <p v-if="errors.password" class="error">{{ errors.password }}</p>
                </div>

                <button type="submit" class="submit-btn">Register</button>

            </form>

            <p class="login-link">
                Already have an account?
                <a @click="$router.push('/login')">Login</a>
            </p>

        </div>

    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            form: {
                email: "",
                username: "",
                password: ""
            },
            errors: {},
            showPassword: false,
        };
    },

    methods: {
        validatePassword(pw) {
            const rules = [
                { regex: /.{8,}/, message: "Password must be at least 8 characters long" },
                { regex: /[A-Z]/, message: "Password must include at least one uppercase letter" },
                { regex: /[a-z]/, message: "Password must include at least one lowercase letter" },
                { regex: /[0-9]/, message: "Password must include at least one number" },
                { regex: /[^A-Za-z0-9]/, message: "Password must include one special character" }
            ];

            for (const r of rules) {
                if (!r.regex.test(pw)) return r.message;
            }
            return null;
        },

        async submitForm() {
            this.errors = {};

            // Frontend validation
            if (!this.form.username) this.errors.username = "Username is required";
            if (!this.form.email) this.errors.email = "Email is required";

            const pwError = this.validatePassword(this.form.password);
            if (pwError) this.errors.password = pwError;

            if (Object.keys(this.errors).length > 0) return;

            try {
                const res = await axios.post("http://127.0.0.1:8000/api/register", {
                    email: this.form.email,
                    username: this.form.username,
                    password: this.form.password,
                });

                alert(res.data.message);

                // langsung redirect ke login (tanpa verify)
                this.$router.push("/login");

            } catch (err) {
                if (err.response?.status === 422) {
                    this.errors = err.response.data.errors;
                } else {
                    alert(err.response?.data?.message || "Terjadi kesalahan");
                }
            }
        }
    }
}
</script>


<style scoped>
    /* ===== PAGE WRAPPER ===== */
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
        border-top-left-radius: 20px;   /* biar rounded dengan card */
        border-top-right-radius: 20px;  /* biar rounded dengan card */
    }

    .register-title {
        font-family: "Katibeh", serif;
        font-size: 3rem;
        font-weight: 400;
        margin: 0;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
    }

    /* ===== CARD ===== */
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

    /* ===== TITLE ===== */
    .title {
        font-family: "Katibeh", serif;
        font-size: 1.8rem;
        color: #003f83;
        margin: 0;
        text-align: center;
        font-weight: 700;
        margin-bottom: 28px;
    }

    /* ===== FORM ===== */
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

    /* ===== PASSWORD WRAPPER ===== */
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

    /* ===== ERROR TEXT ===== */
    .error {
        color: #e11d48;
        font-size: 13px;
        margin-top: 6px;
    }

    /* ===== BUTTON ===== */
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
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .submit-btn:hover {
        background: #3d9bff;
        transition: all 0.3s ease;
        transform: translateY(-3px);
    }

    /* ===== LINK TO LOGIN ===== */
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

    /* ===== RESPONSIVE ===== */
    @media (max-width: 480px) {
    .register-card {
        width: 100%;
        padding: 24px;
    }
    }
</style>