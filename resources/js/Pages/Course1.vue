<template>
    <div class="course-detail">
        <div class="course-header">
        <h1>Menyelam ke Dunia Laut</h1>
        <p class="subtitle">Pengenalan Laut: Jantung Kehidupan Bumi</p>
        </div>

        <div class="content-wrapper">
        <div class="main-content">
            <div class="content-section">
            <h2>🌊 Apa itu Ekosistem Laut?</h2>
            <p>Laut adalah jantung planet ini. Ia menyimpan panas, mengatur cuaca, menjadi rumah bagi jutaan makhluk hidup, dan menghubungkan manusia di seluruh dunia sejak zaman purba. Setiap tetes air laut membawa kisah tentang keseimbangan alam, perjalanan angin, dan kehidupan yang terus berputar. Dari terumbu karang penuh warna hingga palung laut terdalam, laut menyimpan misteri yang belum sepenuhnya kita pahami.</p>
            </div>

            <div class="content-section">
            <h2>Fakta-Fakta Menakjubkan Tentang Laut</h2>
            <div class="feature-grid">
                <div class="feature-item">
                    <img :src="'/foto/lesson1.1.jpg'" class="feature-img">
                    <h3>Penghasil sebagian besar oksigen di dunia</h3>
                    <p>Bukan hutan hujan yang jadi paru - paru Bumi, melainkan fitoplankton    —   tumbuhan mikroskopis di   laut  yang menghasilkan lebih dari 50% oksigen yang kita hirup setiap hari.</p>
                </div>
                <div class="feature-item">
                    <img :src="'/foto/lesson1.2.jpg'" class="feature-img">
                    <h3>Menyerap panas dan karbon</h3>
                    <p>Laut bertindak seperti pendingin alami  Bumi,  menyerap   sekitar 90% panas dari perubahan iklim dan 30% karbon dioksida yang dihasilkan manusia.</p>
                </div>
                <div class="feature-item">
                    <img :src="'/foto/lesson1.3.jpg'" class="feature-img">
                    <h3>Rumah bagi 230.000 spesies yang sudah dikenal</h3>
                    <p>Namun para ilmuwan memperkirakan masih ada jutaaan spesies lain yang belum ditemukan, terutama di kedalaman yang belum pernah dijelajahi. </p>
                </div>
            </div>
            </div>

            <div class="content-section">
            <h2>📈 Peran Penting Laut</h2>
            <ul class="role-list">
                <li>🌍 Regulator iklim global</li>
                <li>🏠 Habitat bagi jutaan spesies</li>
                <li>🍽️ Sumber makanan bagi manusia</li>
                <li>💨 Produsen oksigen terbesar</li>
                <li>🛳️ Jalur transportasi penting</li>
            </ul>
            </div>
        </div>

        <div class="navigation">
            <button @click="$router.back()" class="nav-btn back-btn">Kembali</button>
            <button @click="$router.push('/course/2')" class="nav-btn next-btn">Lanjut ke Bab 2</button>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
    name: "Course1"
    }
</script>

<style scoped>
    .course-detail {
    min-height: 100vh;
    color: white;
    }

    .course-detail::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background: url('/foto/bgc1.jpg') no-repeat center/cover;
    background-size: cover;
    z-index: -1;
    }

    .course-header {
    padding-top: 80px;
    text-align: center;
    margin-bottom: 40px;
    position: relative;
    z-index: 2;
    }

    .course-header h1 {
    font-size: 2.5rem;
    font-family: katibeh, serif;
    margin-bottom: 10px;
    }

    .subtitle {
    font-size: 1.2rem;
    font-family: karla, serif;
    opacity: 0.9;
    }

    .content-wrapper {
    max-width: 1000px;
    margin: 0 auto;
    z-index: 2;
    position: relative;

    }

    .main-content {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    }

    .content-section {
    margin-bottom: 40px;
    }

    .content-section h2 {
    font-size: 1.5rem;
    font-family: karla, serif;
    margin-bottom: 15px;
    color: #d9ebff;
    }

    .content-section p {
    font-size: 1rem;
    line-height: 1.6;
    font-family: karla, serif;
    }

    .feature-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 20px;
    }

    .feature-item {
    background: rgba(217, 235, 255, 0.1);
    padding: 20px;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .feature-item img.feature-img {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 12px;
    }

    .feature-item h3 {
    color: #a8d0ff;
    margin-bottom: 10px;
    font-family: karla, serif;
    }

    .role-list {
    list-style: none;
    padding: 0;
    }

    .role-list li {
    padding: 10px 0;
    font-size: 1.1rem;
    font-family: karla, serif;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .navigation {
    display: flex;
    justify-content: space-between;
    gap: 20px;
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
    .course-header h1 {
        font-size: 2rem;
    }
    
    .navigation {
        flex-direction: column;
    }
    
    .feature-grid {
        grid-template-columns: 1fr;
    }
    }
</style>