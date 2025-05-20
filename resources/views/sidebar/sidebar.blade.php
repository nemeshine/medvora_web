<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Side Navbar - Tivotal</title>

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            --color-hover: rgba(32, 59, 232);
            --transition: all 0.2s ease;
            transition: smooth;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            width: 78px;
            height: 100%;
            background: #fff;
            padding: 8px 16px;
            transition: var(--transition);
        }

        .sidebar.expand {
            width: 250px;
            transition: var(--transition);
        }

        .nav-header {
            height: 60px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .nav-header .logo {
            color: #000;
            font-size: 23px;
            font-weight: 600;
            opacity: 0;
            transition: var(--transition);
        }

        .sidebar.expand .nav-header .logo {
            opacity: 1;
            transition: var(--transition);
        }

        .nav-header .btn-menu {
            position: absolute;
            color: #000;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            font-size: 23px;
            cursor: pointer;
            margin-right: 10px;
        }

        .sidebar.expand .nav-header .btn-menu {
            margin-right: 0;
        }

        .nav-links {
            margin-top: 20px;
            height: 100%;
        }

        .nav-links li {
            position: relative;
            margin: 8px 0;
            list-style: none;
        }

        .nav-links i {
            color: #000;
            height: 50px;
            min-width: 50px;
            font-size: 23px;
            text-align: center;
            line-height: 50px;
        }

        .nav-links input {
            font-size: 14px;
            font-weight: 400;
            color: #000;
            outline: none;
            height: 40px;
            width: 50%;
            border: none;
            border-radius: 12px;
            background: #e2e2e2;
            padding: 0;
        }

        .sidebar.expand .nav-links input {
            width: 100%;
            padding: 0 20px 0 40px;
        }

        .nav-links li a {
            display: flex;
            height: 100%;
            width: 100%;
            border-radius: 12px;
            align-items: center;
            text-decoration: none;
            background: #fff;
        }

        .nav-links li:hover a {
            background: var(--color-hover);
        }

        .nav-links li:hover i {
            color: #fff;
        }

        .nav-links li a .title {
            color: #000;
            font-size: 15px;
            font-weight: 400;
            white-space: nowrap;
            display: none;
            transition: var(--transition);
        }

        .sidebar.expand .nav-links li a .title {
            display: block;
            transition: var(--transition);
        }

        .nav-links li:hover a .title {
            color: #fff;
        }

        .nav-links li .tooltip {
            position: absolute;
            top: -20px;
            left: calc(100% + 15px);
            z-index: 3;
            background: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            padding: 6px 14px;
            font-size: 15px;
            white-space: nowrap;
            border-radius: 3px;
            opacity: 0;
            pointer-events: none;
            transition: 0s;
        }

        .sidebar li:hover .tooltip {
            opacity: 1;
            pointer-events: auto;
            transition: var(--transition);
            top: 50%;
            transform: translateY(-50%);
        }

        .sidebar.expand .tooltip {
            display: none;
        }

        .nav-links .search-btn {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-25px);
            font-size: 23px;
            color: #000;
            border-radius: 12px;
            background: #fff;
            transition: var(--transition);
        }

        .sidebar.expand .nav-links .search-btn {
            background: transparent;
            transition: var(--transition);
        }

        .sidebar.expand .nav-links li:hover .search-btn {
            color: #000;
        }

        .nav-links .search-btn:hover {
            background: var(--color-hover);
        }

        .theme-wrapper {
            position: fixed;
            bottom: 0;
            display: flex;
            justify-content: space-between;
            height: 60px;
            width: 250px;
            left: 0;
            padding: 8px 16px;
        }

        .theme-wrapper .theme-icon {
            font-size: 20px;
            color: #000;
            display: none;
            transition: var(--transition);
        }

        .sidebar.expand .theme-wrapper .theme-icon {
            display: block;
        }

        .theme-wrapper p {
            font-size: 16px;
            color: #000;
            font-weight: 400;
            display: none;
            transition: var(--transition);
        }

        .sidebar.expand .theme-wrapper p {
            display: block;
        }

        .theme-wrapper .theme-btn {
            width: 40px;
            height: 20px;
            background: #e2e2e2;
            border-radius: 30px;
            position: relative;
        }

        .theme-wrapper .theme-btn .theme-ball {
            position: absolute;
            width: 15px;
            height: 15px;
            background: #000;
            border-radius: 50%;
            top: 2px;
            left: 3px;
        }

        .home {
            position: relative;
            top: 0;
            left: 78px;
            width: calc(100% - 78px);
            min-height: 100vh;
            background: #e2e2e2;
            z-index: 6;
            transition: var(--transition);
        }

        .sidebar.expand~.home {
            left: 250px;
            width: calc(100% - 250px);
            transition: var(--transition);
        }

        .home p {
            font-size: 20px;
            font-weight: 500;
            color: #000;
            display: inline-block;
            margin: 20px;
            white-space: nowrap;

        }

        .sidebar ul,
        .sidebar ol {
            padding-left: 0;
        }

        .sidebar a {
            padding: 0;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal-box {
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            text-align: center;
            animation: slideIn 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
        }

        .modal-box h3 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .btn-confirm {
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-confirm:hover {
            background-color: #c0392b;
        }

        .btn-cancel {
            background-color: #7f8c8d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-cancel:hover {
            background-color: #636e72;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                background-color: rgba(0, 0, 0, 0);
            }

            to {
                background-color: rgba(0, 0, 0, 0.5);
            }
        }
    </style>


    <html>

    </html>
</head>

<body>
    <section class="sidebar">
        <div class="nav-header">
            <p class="logo">Medvora</p>
            <i class="bx bx-menu-alt-right btn-menu"></i>
        </div>
        <ul class="nav-links">
            <li>
                <a href="/dashboard">
                    <i class="bx bx-home-alt-2"></i>
                    <span class="title">Dashboard</span>
                </a>
                <span class="tooltip">Dasboard</span>
            </li>
            <li>
                <a href="/pasien">
                    <i class='bx bx-user'></i>
                    <span class="title">Pasien</span>
                </a>
                <span class="tooltip">Pasien</span>
            </li>
            <li>
                <a href="/diagnosa">
                    <i class='bx bx-first-aid'></i>
                    <span class="title">Diagnosa Penyakit</span>
                </a>
                <span class="tooltip">Diagnosa Penyakit</span>
            </li>
            <li>
                <a href="/obat">
                    <i class='bx bx-capsule'></i>
                    <span class="title">Obat</span>
                </a>
                <span class="tooltip">Obat</span>
            </li>
            <li>
                <a href="/alarm">
                    <i class='bx bx-time-five'></i>
                    <span class="title">Alarm</span>
                </a>
                <span class="tooltip">Alarm</span>
            </li>
            <li>
                <a href="/riwayat">
                    <i class='bx bx-timer'></i>
                    <span class="title">Riwayat Alarm</span>
                </a>
                <span class="tooltip">Riwayat Alarm</span>
            </li>
            <li>
                <a href="/staff">
                    <i class='bx bx-timer'></i>
                    <span class="title">Staff</span>
                </a>
                <span class="tooltip">Staff</span>
            </li>


            <li style="margin-top: 100px;">
                <form id="logoutForm" action="{{ route('staff.logout') }}" method="GET">
                    @csrf
                    <a href="#" onclick="return confirmLogout();">
                        <i class="bx bx-log-out"></i>
                        <span class="title">Logout</span>
                    </a>
                </form>
                <span class="tooltip">Logout</span>
            </li>
            <!-- Modal Konfirmasi Logout -->
            <div id="logoutModal" class="modal-overlay">
                <div class="modal-box">
                    <h3>Apakah Anda ingin keluar?</h3>
                    <div class="modal-buttons">
                        <button onclick="proceedLogout()" class="btn-confirm">Iya, Keluar</button>
                        <button onclick="cancelLogout()" class="btn-cancel">Batal</button>
                    </div>
                </div>
            </div>


        </ul>

    </section>

    <script>
        const btn_menu = document.querySelector(".btn-menu");
        const side_bar = document.querySelector(".sidebar");

        btn_menu.addEventListener("click", function() {
            side_bar.classList.toggle("expand");
            changebtn();
        });

        function changebtn() {
            if (side_bar.classList.contains("expand")) {
                btn_menu.classList.replace("bx-menu", "bx-menu-alt-right");
            } else {
                btn_menu.classList.replace("bx-menu-alt-right", "bx-menu");
            }
        }

        function confirmLogout() {
            Swal.fire({
                title: 'Apakah Anda yakin ingin keluar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#7f8c8d',
                confirmButtonText: 'Iya, Keluar',
                cancelButtonText: 'Batal',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logoutForm').submit();
                }
            });
            return false; // agar link tidak langsung jalan
        }

        function proceedLogout() {
            document.getElementById('logoutForm').submit();
        }

        function cancelLogout() {
            document.getElementById('logoutModal').style.display = 'none';
        }
    </script>
</body>

</html>
