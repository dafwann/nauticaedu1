<template>
    <div class="course-page">
        <!-- Hero Banner -->
        <section class="hero-section">
            <h1 class="hero-title">Laut Kita Terancam!</h1>
        </section>

        <!-- Mengapa Laut Penting -->
        <section class="content-section">
            <h2>Mengapa Laut Penting?</h2>
            <p>
                Laut bukan hanya tempat liburan atau keindahan alam, tapi juga sumber kehidupan. 
                Laut menyediakan makanan, mengatur iklim, dan menjaga keseimbangan ekosistem bumi. 
                Namun, laut kita sedang dalam bahaya karena berbagai ancaman dari aktivitas manusia 
                dan perubahan lingkungan.
            </p>
        </section>

        <!-- Ancaman Utama -->
        <section class="content-section">
            <h2>Apa Saja Ancaman untuk Laut Kita?</h2>
            <p>Mari kita lihat beberapa ancaman utama yang membuat laut terancam:</p>

            <div class="threat-list">

                <!-- 1 -->
                <div class="threat-item">
                    <img :src="'/foto/lesson3.1.jpg'" class="threat-img" />
                    <div class="threat-content">
                        <strong>Pencemaran Laut:</strong> Plastik, limbah industri, dan tumpahan minyak 
                        masuk ke laut, membuat habitat laut tercemar dan membahayakan makhluk laut.
                    </div>
                </div>

                <!-- 2 -->
                <div class="threat-item">
                    <img :src="'/foto/lesson3.2.jpg'" class="threat-img" />
                    <div class="threat-content">
                        <strong>Penangkapan Ikan Berlebihan:</strong> Nelayan menangkap ikan lebih banyak 
                        dari yang bisa pulih, membuat populasi ikan menurun drastis.
                    </div>
                </div>

                <!-- 3 -->
                <div class="threat-item">
                    <img :src="'/foto/lesson3.3.jpg'" class="threat-img" />
                    <div class="threat-content">
                        <strong>Pemanasan Global:</strong> Suhu laut meningkat karena emisi gas rumah kaca, 
                        menyebabkan terumbu karang memutih dan rusak.
                    </div>
                </div>

                <!-- 4 -->
                <div class="threat-item">
                    <img :src="'/foto/lesson3.4.jpg'" class="threat-img" />
                    <div class="threat-content">
                        <strong>Kehilangan Habitat:</strong> Penggundulan hutan mangrove dan rusaknya 
                        terumbu karang menyebabkan hilangnya tempat tinggal bagi banyak organisme laut.
                    </div>
                </div>

            </div>
        </section>

        <!-- Dampak Kerusakan -->
        <section class="content-section">
            <h2>Dampak Kerusakan Laut Terhadap Kita</h2>
            <p>
                Kerusakan laut bukan hanya masalah alam, tapi juga masalah manusia. 
                Berikut dampak nyata yang terjadi:
            </p>

            <ul class="impact-list">
                <li>Penurunan stok ikan berdampak pada mata pencaharian nelayan.</li>
                <li>Hilangnya terumbu karang mengurangi keanekaragaman hayati laut.</li>
                <li>Laut yang tercemar membahayakan air laut dan hasil tangkapan ikan menjadi tidak aman.</li>
                <li>Pemanasan laut mempercepat perubahan iklim yang berpengaruh pada cuaca ekstrem.</li>
            </ul>
        </section>
        
        <div class="navigation">
                <button @click="$router.back()" class="nav-btn back-btn">Kembali</button>
                <button @click="$router.push('/course/4')" class="nav-btn next-btn">Lanjut ke Bab 4</button>
            </div>
    </div>
</template>

<script>
export default {
    name: "Course3",
    data() {
        return {
            // Data bisa ditambahkan di sini jika diperlukan
        }
    }
}
</script>

<style scoped>

    .course-page {
        background: #08223B;
        color: white;
        font-family: 'Katibeh','Segoe UI', sans-serif;
        padding-bottom: 30px;
        position: relative;
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .course-page::before {
        content: ""; position: absolute; 
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('/foto/bgc3.jpg') no-repeat top center;
        background-size: contain;
        background-repeat: no-repeat;
        z-index: 0;
        pointer-events: none;
    }

    .hero-section,
    .content-section {
        position: relative;
        z-index: 2;
    }

    /* HERO SECTION */
    .hero-section {
        position: relative;
        height: 260px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 0 20px;
        z-index: 2;
        width: 100%;
        max-width: 100%;
    }


    .hero-title {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        font-size: 40px;
        width: 100%;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        font-family: katibeh, serif;
        z-index: 3;
    }

    /* CONTENT SECTION */
    .content-section {
        position: relative;
        z-index: 2;
        max-width: 1000px;
        margin: 0 auto;
    }

    .content-section h2 {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 15px;
        text-align: left;
        color: white;
        font-family: katibeh, serif;
    }

    .content-section p {
        line-height: 1.7;
        text-align: justify;
        font-size: 16px;
        font-family: karla, serif;
    }

    /* THREATS LIST - LAYOUT FIXED */
    .threat-list {
        margin-top: 25px;
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .threat-item {
        display: flex;
        align-items: center;
        gap: 25px;
        padding: 20px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Item ganjil (1,3) - gambar di kiri, teks di kanan */
    .threat-item:nth-child(odd) {
        flex-direction: row;
    }

    .threat-item:nth-child(odd) .threat-img {
        grid-area: image;
    }

    .threat-item:nth-child(odd) .threat-content {
        grid-area: content;
    }

    /* Item genap (2,4) - teks di kiri, gambar di kanan */
    .threat-item:nth-child(even) {
        flex-direction: row-reverse;
    }

    .threat-item:nth-child(even) .threat-img {
        grid-area: image;
    }

    .threat-item:nth-child(even) .threat-content {
        grid-area: content;
    }

    .threat-img {
        width: 260px;
        height: 90px;
        border-radius: 45px;
        object-fit: cover;
        flex-shrink: 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .threat-content {
        line-height: 1.6;
        text-align: left;
        min-width: 0; /* Penting untuk text wrapping */
        padding: 5px 0;
        flex: 1;
        font-family: karla, serif;
    }

    .threat-content strong {
        color: whitesmoke;
        display: block;
        margin-bottom: 8px;
        font-size: 17px;
        font-weight: 600;
        font-family: katibeh, serif;
    }

    /* IMPACT LIST */
    .impact-list {
        margin-top: 15px;
        line-height: 1.8;
        padding-left: 20px;
        font-family: karla, serif;
    }

    .impact-list li {
        margin-bottom: 12px;
        text-align: left;
        position: relative;
        padding-left: 10px;
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

    /* ========== RESPONSIVE DESIGN ========== */

    /* Tablet */
    @media (max-width: 768px) {
        .hero-section {
            height: 200px;
        }
        
        .hero-title {
            font-size: 24px;
        }
        
        .content-section {
            width: 95%;
            margin: 30px auto;
        }
        
        .content-section h2 {
            font-size: 20px;
        }
        
        .content-section p {
            font-size: 15px;
            text-align: left;
        }
        
        /* Threat item layout untuk tablet */
        .threat-list {
            gap: 25px;
        }
        
        .threat-item {
            grid-template-columns: 120px 1fr !important;
            gap: 20px;
            padding: 15px;
            flex-direction: column !important;
        }
        
        .threat-img {
            width: 100%;
            max-width: 220px;
            height: 90px;
            border-radius: 45px;
            margin: 0 auto;
        }
        
        .threat-content strong {
            margin-bottom: 8px;
            font-size: 16px;
        }
    }

    /* Mobile */
    @media (max-width: 480px) {
        .course-page {
            padding-bottom: 60px;
        }
        
        .hero-section {
            height: 180px;
            padding: 0 15px;
        }
        
        .hero-title {
            font-size: 22px;
        }
        
        .content-section {
            width: 100%;
            margin: 25px auto;
            padding: 0 10px;
        }
        
        .content-section h2 {
            font-size: 18px;
            margin-bottom: 12px;
        }
        
        .content-section p {
            font-size: 14px;
            line-height: 1.6;
        }
        
        /* Threat item layout stack untuk mobile */
        .threat-list {
            gap: 20px;
        }
        
        .threat-item {
            grid-template-columns: 1fr !important;
            grid-template-rows: auto auto;
            grid-template-areas: "image" "content" !important;
            gap: 15px;
            padding: 15px;
            text-align: center;
        }
        
        .threat-content {
            text-align: center;
        }
        
        .threat-img {
            width: 100%;
            max-width: 200px;
            height: 80px;
            border-radius: 40px;
            margin: 0 auto;
        }
        
        /* Impact list untuk mobile */
        .impact-list {
            padding-left: 15px;
        }
        
        .impact-list li {
            font-size: 14px;
            margin-bottom: 8px;
        }
    }

    /* Small Mobile */
    @media (max-width: 360px) {
        .hero-section {
            height: 160px;
        }
        
        .hero-title {
            font-size: 20px;
        }
        
        .content-section h2 {
            font-size: 17px;
        }
        
        .content-section p {
            font-size: 13px;
        }
        
        .threat-img {
            height: 70px;
            border-radius: 35px;
        }
        
        .impact-list li {
            font-size: 13px;
        }
    }
</style>