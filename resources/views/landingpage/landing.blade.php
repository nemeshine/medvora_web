<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medvora: Smart Medication Reminder</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Croissant+One&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Default font */
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Font khusus */
        h1,
        .judul-utama {
            font-family: 'Croissant One';
        }


        header {
            background: #fff;
            padding: 10px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        header nav a {
            color: #2d2549;
            text-decoration: none;
            margin: 0 15px;
            position: relative;
            transition: color 0.3s ease, transform 0.3s ease;
            font-weight: 500;
        }

        /* Efek underline animasi */
        header nav a::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            bottom: -3px;
            left: 0;
            background-color: #2d2549;
            transition: width 0.3s ease;
        }

        header nav a:hover {
            color: #3a2f63;
            transform: scale(1.05);
        }

        header nav a:hover::after {
            width: 100%;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #fff;
            padding: 10px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            z-index: 1000;
        }

        header .btn-login {
            background: #2d2549;
            color: #fff;
            padding: 10px 30px;
            border-radius: 15px;
            text-decoration: none;
            transition: 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header .btn-login:hover {
            background: #3a2f63;
            transform: scale(1.05);
        }

        header .btn-login:active {
            background: #1f1a36;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) inset;
            transform: scale(0.98);
        }

        .hamburger {
            display: none;
            font-size: 24px;
            background: none;
            border: none;
            cursor: pointer;
            color: #2d2549;
        }

        /* Tampilkan hamburger */
        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }

            nav {
                display: none;
                position: absolute;
                top: 60px;
                left: 0;
                background: white;
                width: 100%;
                padding: 20px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                flex-direction: column;
                z-index: 999;
            }

            nav a {
                margin: 10px 0;
                display: block;
            }

            nav.show {
                display: flex;
            }
        }

        html {
            scroll-behavior: smooth;
        }

        /* Beranda */
        .hero {
            background: linear-gradient(to right, #f2f6ff, #fff);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 100px 5%;
            flex-wrap: wrap;
            overflow: hidden;
            position: relative;
        }

        .hero-text {
            flex: 1;
            max-width: 500px;
            animation: fadeUp 1s ease forwards;
            opacity: 0;
            animation-delay: 0.3s;
        }

        .hero-text h1 {
            font-size: 2em;
            margin-bottom: 30px;
            animation: fadeUp 1s ease forwards;
            opacity: 0;
            animation-delay: 0.5s;
        }

        .hero-text p {
            margin-bottom: 30px;
            animation: fadeUp 1s ease forwards;
            opacity: 0;
            animation-delay: 0.7s;
        }

        .hero-text .btn-primary {
            background: #2d2549;
            color: #fff;
            padding: 10px 25px;
            border-radius: 15px;
            text-decoration: none;
            transition: 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: inline-block;
            animation: fadeUp 1s ease forwards;
            opacity: 0;
            animation-delay: 0.9s;
        }

        .hero-text .btn-primary:hover {
            background: #3a2f63;
            transform: scale(1.05);
        }

        .hero-text .btn-primary:active {
            background: #1f1a36;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) inset;
            transform: scale(0.98);
        }

        .hero-img {
            flex: 1;
            text-align: center;
            position: relative;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeLeft 1.3s ease forwards;
            opacity: 0;
        }

        .hero-img img {
            max-width: 100%;
            height: auto;
        }

        .blur-bg {
            position: absolute;
            width: 60vw;
            height: 60vw;
            max-width: 400px;
            max-height: 400px;
            background: radial-gradient(circle at center, #5de0e6, #7f53ac, transparent 70%);
            filter: blur(80px);
            border-radius: 50%;
            z-index: 0;
            top: 50%;
            left: 60%;
            transform: translate(-50%, -50%);
            animation: pulseBlur 6s ease-in-out infinite;
        }

        .gambar-perawat {
            position: relative;
            width: 75%;
            max-width: 350px;
            height: auto;
            transition: transform 0.3s ease;
            display: block;
            margin: 0 auto;
            z-index: 1;
            animation: floatImage 5s ease-in-out infinite;
        }

        .gambar-perawat:hover {
            transform: scale(1.05);
        }

        /* Animasi */
        @keyframes fadeUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeLeft {
            from {
                transform: translateX(50px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes floatImage {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulseBlur {

            0%,
            100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }

            50% {
                transform: translate(-50%, -50%) scale(1.1);
                opacity: 0.7;
            }
        }


        /* tentang kami */
        #tentang {
            padding: 80px 5%;
            background-color: #fff;
        }

        .tentang-kami-text {
            font-size: 14px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            text-align: center;
        }

        #tentang h2 {
            font-size: 36px;
            font-weight: bold;
            color: #000;
            margin-bottom: 40px;
            text-align: center;
            font-family: 'Croissant One', cursive;
        }

        .tentang-container {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            align-items: flex-start;
            justify-content: center;
        }

        .tentang-left {
            flex: 1 1 400px;
        }

        .image-frame img {
            max-width: 75%;
            width: 100%;
            height: auto;
            display: block;
            margin-left: 50px;
        }

        .tentang-right {
            flex: 1 1 500px;
            padding-top: 20px;
        }

        .tentang-right p {
            font-size: 16px;
            line-height: 1.8;
            color: #333;
            margin-bottom: 15px;
        }

        .benefits {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .benefits li {
            font-size: 16px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            color: #333;
        }

        .benefits img {
            width: 24px;
            height: 24px;
            margin-right: 12px;
        }

        .section {
            padding: 60px 5%;
        }

        .section h2 {
            font-size: 1.8em;
            margin-bottom: 20px;
        }

        .section p {
            max-width: 800px;
        }

        /* Fitur Utama */
        .fitur {
            position: relative;
            padding: 60px 5%;
            background-color: #f8fbff;
            text-align: center;
            overflow: hidden;
            z-index: 1;
        }

        /* Glow Biru Kiri Atas */
        .fitur::before {
            content: '';
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle at top left, rgba(0, 123, 255, 0.5), transparent 80%);
            filter: blur(200px);
            top: -300px;
            left: -300px;
            z-index: 0;
            pointer-events: none;
        }

        /* Glow Pink Kanan Bawah */
        .fitur::after {
            content: '';
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle at bottom right, rgba(255, 99, 187, 0.4), transparent 90%);
            filter: blur(200px);
            bottom: -300px;
            right: -300px;
            z-index: 0;
            pointer-events: none;
        }

        /* Glow Ungu Tengah */
        .fitur .glow-purple {
            position: absolute;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(155, 100, 255, 0.35), transparent 70%);
            filter: blur(180px);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 0;
            pointer-events: none;
        }

        /* Glow Putih Tengah Atas */
        .fitur .glow-white {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3), transparent 70%);
            filter: blur(120px);
            top: 10%;
            right: 20%;
            z-index: 0;
            pointer-events: none;
        }




        .fitur .judul {
            font-size: 2.5em;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .subjudul-fitur {
            font-size: 1.1em;
            color: #555;
            margin-top: -20px;
            margin-bottom: 40px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }


        .fitur-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 30px;
        }

        .fitur-box {
            background: #f9f9f9;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 4px 6px 12px rgba(0, 0, 0, 0.07);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .fitur-box:hover {
            transform: translateY(-5px);
        }

        .fitur-icon {
            width: 80px;
            height: 80px;
            margin: 15px 0;
        }

        .box-1 {
            background-color: #f1f1f1;
        }

        .box-2 {
            background-color: #e8fbfb;
        }

        .box-3 {
            background-color: #f4f0fd;
        }

        .box-4 {
            background-color: #e8e2fd;
        }


        /* Cara Kerja */
        .how-it-works {
            margin-top: 30px;
        }

        .how-it-works ol {
            margin-left: 20px;
        }

        /* footer */
        footer {
            background: #2d2549;
            color: #fff;
            padding: 40px 5%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        footer .col {
            margin-bottom: 20px;
        }

        footer a {
            color: #fff;
            text-decoration: none;
            display: block;
            margin: 5px 0;
        }

        footer iframe {
            width: 100%;
            height: 200px;
            border: none;
        }

        @media(max-width: 768px) {
            .hero {
                flex-direction: column;
                text-align: center;
            }

            .features {
                flex-direction: column;
            }

            .feature-box {
                flex: 1 1 100%;
            }

            footer {
                flex-direction: column;
            }
        }
    </style>
</head>
<script>
    function toggleMenu() {
        var menu = document.getElementById('nav-menu');
        menu.classList.toggle('show');
    }
</script>

<body>
    <header>
        <div><strong class="brand-logo">Medvora.</strong></div>

        <button class="hamburger" onclick="toggleMenu()">☰</button>

        <nav id="nav-menu">
            <a href="#">Beranda</a>
            <a href="#tentang">Tentang Kami</a>
            <a href="#fitur">Fitur Utama</a>
            <a href="#cara">Cara Kerja</a>
            <a href="#contact">Contact</a>
        </nav>

        <a href="#" class="btn-login">Login</a>
    </header>

    <section class="hero">
        <div class="hero-text" data-aos="fade-right">
            <p>Selamat Datang di Medvora</p>
            <h1>Medvora: Smart Medication Reminder</h1>
            <p>Medvora adalah solusi pintar untuk mengelola pengobatan dengan lebih mudah dan aman. Dengan pengingat
                obat otomatis, chatbot AI interaktif, dan tombol darurat, Medvora membantu pasien rawat jalan tetap
                teratur dalam menjalani pengobatan.</p>
            <a href="#" class="btn-primary">Unduh Aplikasi</a>
        </div>

        <div class="hero-img" data-aos="fade-left">
            <div class="blur-bg"></div> <!-- background blur -->
            <img src="img/perawat.png" alt="Ilustrasi Perawat" class="gambar-perawat">
        </div>
    </section>




    <section class="section" id="tentang">
        <div class="tentang-kami-text" data-aos="fade-down" data-aos-duration="800">Tentang Kami</div>
        <h2 data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="100">
            Mengapa harus <span style="color:#2d2549;">Medvora?</span>
        </h2>

        <div class="tentang-container">
            <!-- Gambar Puskesmas -->
            <div class="tentang-left" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="200">
                <div class="image-frame">
                    <img src="img/puskesmashm.png" alt="Puskesmas Patrang" />
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="tentang-right" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="300">
                <p data-aos="fade-up" data-aos-delay="400" data-aos-duration="800">
                    Medvora adalah aplikasi pengingat obat pintar yang dirancang untuk membantu pasien rawat jalan dalam
                    mengatur jadwal minum obat dengan lebih mudah dan akurat. Kami percaya bahwa kesehatan yang terjaga
                    dimulai dari disiplin konsumsi obat yang tepat waktu.
                </p>
                <p data-aos="fade-up" data-aos-delay="500" data-aos-duration="800">
                    Dengan fitur pengingat obat otomatis, chatbot AI kesehatan, serta tombol darurat, Medvora hadir
                    sebagai solusi inovatif yang mendukung perawatan pasien dengan lebih cerdas dan efisien.
                </p>
                <ul class="benefits">
                    <li data-aos="fade-up-right" data-aos-delay="600"><img src="img/checklist.png" alt="check" />
                        Membantu pasien minum obat tepat waktu tanpa lupa.</li>
                    <li data-aos="fade-up-left" data-aos-delay="700"><img src="img/checklist.png" alt="check" />
                        Menyediakan informasi kesehatan yang terpercaya dengan chatbot AI.</li>
                    <li data-aos="fade-up-right" data-aos-delay="800"><img src="img/checklist.png" alt="check" />
                        Meningkatkan kepedulian terhadap kesehatan melalui pemantauan progres pengguna.</li>
                    <li data-aos="fade-up-left" data-aos-delay="900"><img src="img/checklist.png" alt="check" />
                        Meningkatkan kepedulian terhadap kesehatan melalui pemantauan progres pengguna.</li>
                </ul>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: false,
            mirror: true,
            offset: 100,
        });

        // Refresh AOS setelah semua konten dimuat
        window.addEventListener('load', AOS.refresh);
    </script>




    <section class="fitur" id="fitur">
        <!-- Glow Elements -->
        <div class="glow-purple"></div>
        <div class="glow-white"></div>

        <!-- Konten -->
        <div class="fitur-content">
            <h2 class="judul">Fitur Utama <span style="color:#2d2549;">Medvora</span></h2>
            <p class="subjudul-fitur">
                Temukan fitur-fitur andalan Medvora yang dirancang untuk membantu pasien dalam
                mengelola pengobatan, menjaga kesehatan, dan memberikan akses cepat saat keadaan darurat.
            </p>

            <div class="fitur-grid">
                <div class="fitur-box box-1">
                    <img src="img/notif.png" alt="Pengingat Obat" class="fitur-icon">
                    <h3>Pengingat Obat yang Akurat</h3>
                    <p>Medvora mengirimkan notifikasi tepat waktu agar pasien tidak lupa minum obat.</p>
                </div>

                <div class="fitur-box box-2">
                    <h3>AI Chatbot Kesehatan</h3>
                    <p>Dapatkan informasi dan konsultasi cepat tentang obat melalui chatbot cerdas.</p>
                    <img src="img/chatbot.png" alt="Chatbot" class="fitur-icon">
                </div>

                <div class="fitur-box box-3">
                    <img src="img/calendar.png" alt="Pemantauan" class="fitur-icon">
                    <h3>Pemantauan Kesehatan</h3>
                    <p>Lihat riwayat konsumsi obat & progres kesehatan dengan grafik interaktif.</p>
                </div>

                <div class="fitur-box box-4">
                    <h3>Tombol Darurat Cepat</h3>
                    <p>Fitur emergency button yang langsung menghubungi kontak darurat saat dibutuhkan.</p>
                    <img src="img/emergency.png" alt="Darurat" class="fitur-icon">
                </div>
            </div>
        </div>
    </section>





    <section class="section how-it-works" id="cara">
        <h2>Cara <span style="color:#2d2549;">Kerja</span></h2>
        <ol>
            <li>Registrasi Pasien</li>
            <li>Unduh Aplikasi</li>
            <li>Pengaturan Alarm</li>
            <li>Notifikasi & Pengingat</li>
            <li>Pemantauan oleh tenaga medis</li>
        </ol>
    </section>



    <footer id="contact">
        <div class="col">
            <strong>Medvora.</strong>
            <iframe
                src="https://maps.google.com/maps?q=Politeknik%20Negeri%20Jember&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
        </div>
        <div class="col">
            <h4>Halaman</h4>
            <a href="#">Beranda</a>
            <a href="#tentang">Tentang Kami</a>
            <a href="#fitur">Fitur Utama</a>
            <a href="#cara">Cara Kerja</a>
        </div>
        <div class="col">
            <h4>Alamat</h4>
            <p>Jl. Kaca Piring No.5, Gebang Tengah, Jember, Jawa Timur</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>
