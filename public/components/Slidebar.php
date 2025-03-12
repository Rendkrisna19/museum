<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
    /* Animasi sidebar */
    .sidebar {
        transition: width 0.3s ease;
    }
    </style>
</head>

<body class="flex bg-gray-100">

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar w-64 bg-[#c8a876] text-white h-screen fixed transition-all duration-300">
        <div class="flex items-center justify-between p-4">
            <h1 id="sidebarTitle" class="text-xl font-semibold">Admin Panel</h1>
            <button onclick="toggleSidebar()" class="text-white focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <nav class="mt-6">
            <ul>
                <li class="px-4 py-3 flex items-center hover:bg-[#c09858] cursor-pointer">
                    <i class="fas fa-home text-xl"></i>
                    <a href="../admin/index.php" id="menuText1" class="ml-4">Home</a>
                </li>
                <li class="px-4 py-3 flex items-center hover:bg-[#c09858] cursor-pointer">
                    <i class="fas fa-users text-xl"></i>
                    <a href="../admin/data_tamu.php" id="menuText2" class="ml-4">Buku Tamu<a />
                </li>
                <li class="px-4 py-3 flex items-center hover:bg-[#c09858] cursor-pointer">
                    <i class="fas fa-chart-line text-xl"></i>
                    <a href="../admin/laporan.php" id="menuText3" class="ml-4">Laporan</a>
                </li>

                <li class="px-4 py-3 flex items-center hover:bg-[#c09858] cursor-pointer">
                    <i class="fas fa-users text-xl"></i>
                    <a href="../admin/list_users.php" id="menuText4" class="ml-4">Users</a>
                </li>
                <li class="px-4 py-3 flex items-center hover:bg-[#c09858] cursor-pointer">
                    <i class="fas fa-sign-out-alt text-xl"></i>
                    <a href="../../auth/login.php" id="menuText4" class="ml-4">Keluar<a />
                </li>
            </ul>
        </nav>
    </div>

    <!-- Konten utama -->


    <!-- JavaScript untuk Sidebar -->
    <script>
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const content = document.getElementById("content");
        const sidebarTitle = document.getElementById("sidebarTitle");
        const menuTexts = [document.getElementById("menuText1"), document.getElementById("menuText2"), document
            .getElementById("menuText3"), document.getElementById("menuText4")
        ];

        if (sidebar.classList.contains("w-64")) {
            sidebar.classList.remove("w-64");
            sidebar.classList.add("w-16");
            sidebarTitle.style.display = "none";
            menuTexts.forEach(text => text.style.display = "none");
            content.classList.remove("ml-64");
            content.classList.add("ml-16");
        } else {
            sidebar.classList.remove("w-16");
            sidebar.classList.add("w-64");
            sidebarTitle.style.display = "block";
            menuTexts.forEach(text => text.style.display = "block");
            content.classList.remove("ml-16");
            content.classList.add("ml-64");
        }
    }
    </script>

</body>

</html>