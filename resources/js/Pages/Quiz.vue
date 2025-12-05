<template>
    <div class="page-root" :style="pageBgStyle">
        <!-- START SCREEN -->
        <div v-if="step === 'start'" class="overlay-center">
        <div class="modal-start" v-motion="fadeScale">
            <h2>Waktunya QUIZ!!!</h2>
            <p>Silahkan menjawab Quiz sesuai materi yang telah kamu pelajari!</p>
            <p class="big">R U READY???</p>
            <div class="start-actions">
            <button class="btn btn-ghost" @click="goHome">NO!</button>
            <button class="btn btn-primary" @click="begin">YES!</button>
            </div>
        </div>
        </div>

        <div v-if="step === 'quiz'" class="quiz-wrapper">
        <div class="quiz-card" v-motion="fadeInUp">
            <div class="quiz-image-wrap">
            <img :src="current.image" alt="soal" class="quiz-image" />
            </div>

            <div class="question-box">
            <div class="header-row">
                <div class="progress">
                <div class="progress-bar">
                    <div class="progress-fill" :style="{ width: progressPercent + '%' }"></div>
                </div>
                <div class="progress-text">Soal {{ currentIndex + 1 }} / {{ questions.length }}</div>
                </div>
            </div>

            <h3 class="soal-title">SOAL {{ currentIndex + 1 }}</h3>
            <p class="soal-text">{{ current.text }}</p>

            <div class="options-grid">
                <label v-for="(opt, i) in current.options" :key="i"
                    :class="['option', { selected: answers[currentIndex] === opt, correct: showAnswer && opt === current.correct, wrong: showAnswer && answers[currentIndex] === opt && opt !== current.correct }]"
                >
                <input type="radio" :name="'q'+currentIndex" :value="opt" v-model="answers[currentIndex]" />
                <span class="opt-text">{{ opt }}</span>
                </label>
            </div>

            <div class="actions-row">
                <button class="btn btn-outline" @click="prevQuestion" :disabled="currentIndex===0">
                Sebelumnya
                </button>

                <div class="center-btn">
                <button 
                    v-if="!showAnswer" 
                    class="btn btn-primary" 
                    @click="checkAnswer" 
                    :disabled="!answers[currentIndex]">
                    Submit
                </button>
                </div>

                <div class="right-btn">
                <button 
                    v-if="showAnswer" 
                    class="btn btn-primary next-btn" 
                    @click="nextOrFinish">
                    {{ nextLabel }}
                </button>
                </div>
            </div>
            </div>
        </div>
        </div>

        <div v-if="step === 'finish'" class="overlay-center">
        <div class="finish-box">
            <h1 class="finish-title">SELAMATT!! QUIZNYA UDAH KELAR!</h1>
            <p class="finish-sub">You did a wonderful job!!</p>
            
            <div class="score-display" v-if="score !== undefined">
                <p class="score-text">Skor: {{ score }}/{{ questions.length }}</p>
            </div>
            
            <div class="countdown-timer">
                <p>Kembali ke halaman course dalam <span class="countdown-number">{{ countdown }}</span> detik</p>
            </div>

            <div class="finish-actions">
                <button class="btn btn-primary" @click="redirectToCourse">
                    Kembali ke Course Sekarang
                </button>
            </div>
        </div>
        </div>
        <div v-if="showQuit" class="overlay-center">
        <div class="modal-confirm" v-motion="fadeScale">
            <p>Yakin mau keluar? Progress quiz akan hilang.</p>
            <div style="display:flex; gap:12px; justify-content:center; margin-top:12px;">
            <button class="btn btn-ghost" @click="showQuit=false">Batal</button>
            <button class="btn btn-danger" @click="quitToStart">Ya, keluar</button>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Quiz",
    data() {
        return {
        step: "start",
        currentIndex: 0,
        answers: [],
        showAnswer: false,
        showQuit: false,
        score: 0,
        redirectTimer: null,
        countdownSeconds: 5,
        countdownInterval: null,
        questions: [
            {
            image: "/foto/quiz1.png",
            text: "Laut disebut sebagai jantung Bumi karena...",
            options: [
                "A. Menjadi sumber minyak terbesar",
                "B. Mengatur cuaca dan menyimpan panas",
                "C. Memiliki warna biru",
                "D. Hanya menjadi tempat wisata"
            ],
            correct: "B. Mengatur cuaca dan menyimpan panas"
            },
            {
            image: "/foto/quiz2.png",
            text: "Rantai makanan yang benar adalah...",
            options: [
                "A. Ikan Besar → Plankton → Hiu",
                "B. Hiu → Tuna → Ikan Kecil",
                "C. Plankton → Ikan Kecil → Ikan Besar → Hiu → pengurai",
                "D. Hiu → Ikan Besar → Ikan Kecil"
            ],
            correct: "C. Plankton → Ikan Kecil → Ikan Besar → Hiu → pengurai"
            },
            {
            image: "/foto/quiz3.png",
            text: "Penangkapan ikan berlebihan menyebabkan...",
            options: [
                "A. Populasi ikan meningkat",
                "B. Populasi ikan menurun",
                "C. Terumbu karang tumbuh pesat",
                "D. Laut menjadi lebih bersih"
            ],
            correct: "B. Populasi ikan menurun"
            },
            {
            image: "/foto/quiz4.png",
            text: "Laut yang tercemar berdampak pada manusia berupa...",
            options: [
                "A. Ikan menjadi lebih besar",
                "B. Air laut aman diminum",
                "C. Hasil tangkapan tidak aman",
                "D. Tugas nelayan lebih mudah"
            ],
            correct: "C. Hasil tangkapan tidak aman"
            },
            {
            image: "/foto/quiz5.png",
            text: "Upaya sederhana menyelamatkan laut adalah...",
            options: [
                "A. Menggunakan plastik lebih banyak",
                "B. Mendukung produk microplastic",
                "C. Membawa botol minum isi ulang",
                "D. Menggunakan sunscreen berbahaya"
            ],
            correct: "C. Membawa botol minum isi ulang"
            }
        ]
        };
    },
    computed: {
        current() {
        return this.questions[this.currentIndex];
        },
        progressPercent() {
        return Math.round(((this.currentIndex) / this.questions.length) * 100);
        },
        nextLabel() {
        return this.currentIndex < this.questions.length - 1 ? "Selanjutnya" : "Selesai";
        },
        resultMessage() {
        const p = Math.round((this.score / this.questions.length) * 100);
        if (p === 100) return "Perfect! Kamu hebat!";
        if (p >= 80) return "Keren! Hampir sempurna!";
        if (p >= 50) return "Bagus, terus belajar ya!";
        return "Terus coba lagi, pelajari materi lebih lanjut.";
        },
        pageBgStyle() {
        return {
            backgroundImage: "url('/foto/quizbg.jpg')",
            backgroundSize: "cover",
            backgroundPosition: "center",
            minHeight: "100vh"
        };
        },
        countdown() {
        return this.countdownSeconds;
        }
    },
    methods: {
        begin() {
        this.step = "quiz";
        this.currentIndex = 0;
        this.answers = Array(this.questions.length).fill(null);
        this.showAnswer = false;
        this.score = 0;
        },
        checkAnswer() {
        if (!this.answers[this.currentIndex]) return;
        this.showAnswer = true;
        if (this.answers[this.currentIndex] === this.current.correct) {
            this.score = this.automaticScore();
        }
        },
        nextOrFinish() {
        this.showAnswer = false;
        if (this.currentIndex < this.questions.length - 1) {
            this.currentIndex++;
        } else {
            this.score = this.automaticScore();
            this.step = "finish";
            
            // Mulai countdown untuk redirect
            this.startCountdown();
        }
        },
        startCountdown() {
            // Reset countdown
            this.countdownSeconds = 5;
            
            // Mulai interval untuk update countdown
            this.countdownInterval = setInterval(() => {
                this.countdownSeconds--;
                
                // Jika countdown habis, redirect
                if (this.countdownSeconds <= 0) {
                    this.redirectToCourse();
                }
            }, 1000); // Update setiap 1 detik
        },
        nextQuestion() {
        if (!this.showAnswer) {
            if (!this.answers[this.currentIndex]) {
            return;
            }
            this.checkAnswer();
            return;
        }
        this.nextOrFinish();
        },
        prevQuestion() {
        if (this.currentIndex > 0) {
            this.currentIndex--;
            this.showAnswer = false;
        }
        },
        automaticScore() {
        return this.answers.reduce((acc, ans, idx) => acc + (ans === this.questions[idx].correct ? 1 : 0), 0);
        },
        restart() {
        this.step = "start";
        this.currentIndex = 0;
        this.answers = [];
        this.showAnswer = false;
        this.score = 0;
        this.clearTimers();
        },
        goHome() {
        this.clearTimers();
        if (this.$router) {
            this.$router.push("/course");
        } else {
            this.restart();
        }
        },
        openQuitConfirm() {
        this.showQuit = true;
        },
        quitToStart() {
        this.showQuit = false;
        this.restart();
        },
        redirectToCourse() {
            // Hapus semua timer
            this.clearTimers();
            
            // Redirect ke halaman course
            if (this.$router) {
                this.$router.push("/course");
            } else {
                console.log("Redirect ke course");
                window.location.href = "/course";
            }
        },
        clearTimers() {
            // Hapus interval countdown
            if (this.countdownInterval) {
                clearInterval(this.countdownInterval);
                this.countdownInterval = null;
            }
            
            // Hapus redirect timer
            if (this.redirectTimer) {
                clearTimeout(this.redirectTimer);
                this.redirectTimer = null;
            }
        }
    },
    beforeDestroy() {
        // Bersihkan timer saat komponen dihancurkan
        this.clearTimers();
    }
};
</script>

<style scoped>
    .page-root {
    display: block;
    padding: 60px 30px 120px;
    box-sizing: border-box;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    color: #023b5b;
    }

    .overlay-center {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 20px;
    }

    .modal-start, .modal-finish, .modal-confirm {
    width: min(1100px, 95%);
    max-width: 1100px;
    min-height: 300px;
    background: white;
    padding: 48px;
    border-radius: 14px;
    box-shadow: 0 18px 40px rgba(2, 45, 70, 0.25);
    text-align: center;
    }

    .modal-start h2 {
    font-size: 37px;       
    margin-bottom: 15px;
    font-weight: 800;
    text-align: center;   
    }

    .modal-start p { 
    margin:15px 0;
    color:#163a56;
    font-size: 27px;
    text-align: center;
    }

    .modal-start .big { 
    font-size: 30px;       
    font-weight: 700;
    margin-top: 15px;
    text-align: center;
    }


    .start-actions, .finish-actions {
    margin-top: 50px;   
    display:flex;
    justify-content:center;
    gap:28px; 
    }

    .quiz-wrapper {
    display:flex;
    justify-content:center;
    padding: 30px 10px;
    position: relative;
    z-index: 2;
    }

    .quiz-card {
    width: 900px;
    background: white;
    border-radius: 8px;
    text-align: center;
    overflow: hidden;
    margin-top: 0px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }

    .quiz-image-wrap {
    width: 100%;
    height: 320px;
    background: #e6f2fb;
    display:flex;
    justify-content:center;
    align-items:center;
    }

    .quiz-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display:block;
    }

    .question-box {
    background: white;
    padding: 35px;
    box-shadow: none;
    margin: 0;
    }

    .header-row {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-bottom: 12px;
    }

    .progress { display:flex; flex-direction:column; align-items:flex-start; gap:8px; }

    .progress-bar {
    width: 260px;
    height: 8px;
    background: #eef6fb;
    border-radius: 8px;
    overflow: hidden;
    }

    .progress-fill {
    height:100%;
    background: linear-gradient(90deg,#5aa6ff,#2d82ff);
    width:0%;
    transition: width .5s ease;
    }

    .progress-text { font-size: 13px; color: #2c5b7a; }

    .soal-title {
    text-align: center;
    font-weight: 900;
    font-size: 22px;
    margin-bottom: 10px;
    letter-spacing: 1px;
    }

    .soal-text {
    text-align:center;
    margin: 8px 0 20px;
    color: #1d3f53;
    font-size: 16px;
    line-height:1.6;
    max-width:760px;
    margin-left:auto; margin-right:auto;
    }

    .options-grid {
    display:flex;
    flex-direction:column;
    gap:12px;
    margin:20px auto 25px;
    width: 100%;
    max-width: none;
    }

    .option {
    display:flex;
    align-items:center;
    gap:15px;
    padding:16px 20px;
    border-radius:12px;
    background:#fbfbfb;
    border:2px solid #eef4f8;
    cursor:pointer;
    transition: all .18s ease;
    width: 100%;
    box-sizing: border-box;
    }
    .option input[type="radio"] { 
    margin-right:8px; 
    transform: scale(1.2);
    }

    .option .opt-text {
    color: #000;
    font-size: 18px;
    font-weight: 500;
    }

    .option:hover { 
    background: #f0f8ff;
    border-color: #cfeaff;
    }

    .option.selected { background:#eef8ff; border-color:#0a74ff; }
    .option.correct { background:#e7ffee; border-color:#28a745; }
    .option.wrong { background:#ffefef; border-color:#dc3545; opacity:0.95; }

    .actions-row {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    align-items: center;
    margin-top: 30px;
    gap: 15px;
    width: 100%;
    }

    .actions-row > button:first-child {
    justify-self: start;
    font-size: 18px;
    padding: 14px 28px;
    }

    .center-btn .btn {
    font-size: 18px;
    padding: 14px 32px;
    }

    .right-btn {
    justify-self: end;
    margin-left: auto;
    }

    .next-btn {
    font-size: 18px;
    padding: 14px 32px;
    margin-left: auto;
    }

    .btn {
    padding: 14px 28px;
    border-radius: 25px;
    border: none;
    cursor: pointer;
    font-size: 18px;
    font-weight: 600;
    transition: all 0.3s ease;
    min-width: 140px;
    }

    .btn-primary { 
    background: #0a74ff; 
    color: #fff; 
    box-shadow: 0 8px 24px rgba(10,116,255,0.18); 
    }
    .btn-primary:hover {
    background: #0056cc;
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(10,116,255,0.25);
    }

    .btn-outline { 
    background: transparent; 
    border: 2px solid #cfe9ff; 
    color: #123a50; 
    font-size: 18px;
    padding: 14px 28px;
    }
    .btn-outline:hover {
    background: #f0f8ff;
    border-color: #0a74ff;
    }

    .btn-ghost { background:#eef4f8; color:#123a50; }
    .btn-danger { background:#ff5c6c; color:#fff; }

    .modal-start .btn {
    font-size: 22px;     
    padding: 16px 40px;    
    border-radius: 40px;  
    }

    .result-score { font-size:20px; margin:14px 0; }
    .result-msg { color:#11455b; margin-bottom:18px; font-size: px;}

    @media (max-width: 920px) {
    .quiz-image-wrap { 
        width: 100%;
        height: 320px;
        background: transparent;
    }
    .question-box { 
        width: 94%; 
        padding: 18px; 
        margin-top:-30px; 
        transform:translateY(-12px); 
    }
    .progress-bar { width: 180px; }
    .modal-start, .modal-finish { width: 92%; padding:20px; }
    
    .options-grid {
        gap: 10px;
        margin: 15px auto 20px;
    }
    
    .option {
        padding: 14px 16px;
    }
    
    .option .opt-text {
        font-size: 16px;
    }
    
    .actions-row {
        grid-template-columns: 1fr;
        gap: 15px;
        justify-items: center;
    }
    
    .actions-row > button:first-child,
    .center-btn,
    .right-btn {
        justify-self: center;
        width: 100%;
        max-width: 280px;
    }
    
    .btn {
        width: 100%;
        max-width: 280px;
        font-size: 16px;
        padding: 12px 24px;
    }

    .right-btn {
        margin-left: 0;
    }
    }

    .finish-box {
    width: min(900px, 90%);
    background: white;
    padding: 60px 40px;
    border-radius: 14px;
    box-shadow: 0 18px 40px rgba(2, 45, 70, 0.25);
    text-align: center;
    }

    .finish-title {
    font-size: 32px;
    font-weight: 800;
    margin-bottom: 25px;
    }

    .finish-sub {
    font-size: 30px;
    font-weight: 500;
    margin-bottom: 40px;
    }

    .score-display {
    margin: 20px 0;
    }

    .score-text {
    font-size: 28px;
    font-weight: 700;
    color: #0a74ff;
    margin-bottom: 30px;
    }

    .countdown-timer {
    margin: 25px 0 35px;
    font-size: 20px;
    color: #666;
    }

    .countdown-number {
    font-weight: 800;
    color: #0a74ff;
    font-size: 26px;
    margin: 0 5px;
    }

    .finish-actions {
    margin-top: 20px;
    }

    .finish-actions .btn-primary {
    padding: 16px 38px;
    font-size: 20px;
    border-radius: 30px;
    }

</style>