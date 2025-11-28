<template>
    <div class="course-detail">
        <div class="course-header">
            <h1>Siapa saja Penghuni Laut?</h1>
            <p class="subtitle">“Dari ikan kecil hingga paus biru — semua punya peran penting.”</p>
        </div>

        <div class="content-wrapper">
            <div class="main-content">
                <div class="content-section">
                <p>Laut bukan hanya tempat bagi ikan, tapi rumah bagi jutaan makhluk hidup dengan bentuk dan peran yang berbeda-beda!<br></br>Beberapa di antaranya:</p>
                </div>

                <div class="content-section">
                    <div class="feature-grid">
                        <div class="feature-item" style="--bg-img: url('/foto/lesson2,1.jpg')">
                            <div class="feature-text">
                                <h3>Plankton</h3>
                                <p>makhluk mikroskopis yang menjadi makanan utama bagi banyak hewan laut.</p>
                        
                            </div>
                        </div>
                        <div class="feature-item" style="--bg-img: url('/foto/lesson2.2.jpg')">
                            <div class="feature-text">
                                <h3>Ikan</h3>
                                <p>penghuni laut paling dikenal, dari ikan badut kecil hingga hiu besar!</p>
                            </div>
                        </div>
                        <div class="feature-item" style="--bg-img: url('/foto/lesson2.3.jpg')">
                            <div class="feature-text">
                                <h3>Karang</h3>
                                <p>tampak seperti tumbuhan, padahal sebenarnya hewan yang hidup berkoloni dan membentuk terumbu.</p>
                            </div>
                            
                        </div>
                        <div class="feature-item" style="--bg-img: url('/foto/lesson2.4.jpg')">
                            <div class="feature-text">
                                <h3>Mamalia Laut</h3>
                                <p>seperti lumba-lumba, anjing laut, dan paus biru yang bernapas dengan paru-paru seperti manusia.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-section">
                    <h2>Rantai Makanan Laut — Semua Saling Terhubung</h2>
                    <img :src="'/foto/rantaimakanan.png'" class="rantaimakanan"></img>
                </div>
            </div>

            <div class="navigation">
                <button @click="$router.back()" class="nav-btn back-btn">Kembali</button>
                <button @click="$router.push('/course/3')" class="nav-btn next-btn">Lanjut ke Bab 3</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
    name: "Course2"
    }
</script>

<style scoped>
    .course-detail {
        min-height: 100vh;
        color: white;
        background-color: #001629;

    }

    .course-detail::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('/foto/bgc2.jpg') no-repeat top center;
        background-size: contain; /* atau contain tergantung kebutuhan */
        background-repeat: no-repeat;
        z-index: 0;
        opacity: 0.8;
    }


    .course-header {
        padding-top: 170px;
        text-align: center;
        margin-bottom: 40px;
        position: relative;
        z-index: 2;
    }

    .course-header h1 {
        font-size: 2.5rem;
        font-family: katibeh, serif;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .subtitle {
        font-size: 1.2rem;
        font-family: karla, serif;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .content-wrapper {
        max-width: 95%;
        margin: 0 auto;
        z-index: 2;
        position: relative;

    }

    .main-content {
        /*background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);*/
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
    }

    .content-section {
        margin-bottom: 20px;
    }

    .content-section h2 {
        font-size: 1.5rem;
        font-family: karla, serif;
        margin-bottom: 50px;
        color: #d9ebff;
        text-align: center;
        margin-top: 70px;
    }

    .content-section p {
        font-size: 1.2rem;
        line-height: 1.6;
        font-family: karla, serif;
    }

    .feature-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        margin-top: 20px;
        justify-content: center;
    }

    .feature-item {
        position: relative;
        width: 225px;
        height: 270px;
        border-radius: 30px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        padding: 20px;
        text-align: center;
        color: white;
    }

    .feature-item::before {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 70px;
        background-size: contain; /* atau 'auto' untuk ukuran asli */
        background-repeat: no-repeat;
        background-position: center;
        z-index: 1;
    }

    .feature-item[style*="--bg-img"]::before {
        background-image: var(--bg-img);
    }

    .feature-text {
    
        text-align: center;
        padding-top: 115px;
        z-index: 2;
    }

    .feature-text h3 {
        margin: 0 0 5px 0;   /* agar rata */
        font-size: 20px;
        color: white;
        min-height: 0;
        display: flex;
        justify-content: center;
        font-size: 30px;
        
    }

    .feature-text p {
        margin: 0;
         /* Ini yang membuat semua paragraf mulai di posisi sama */
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 1px;
    }

    .feature-text h3,
    .feature-text p {
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    }


    .rantaimakanan {
        width: 60%;
        display: block;
        margin: 0 auto;
        margin-top: 20px;
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

    @media (max-width: 768px) {

        .feature-item h3 {
            font-size: 18px;
            top: 12px;
        }

    }

    @media (max-width: 480px) {
        .feature-grid {
            flex-direction: column;
            align-items: center;
        }

        .feature-item {
            width: 90%;
            max-width: 250px;
            height: 250px;
        }
    }
</style>