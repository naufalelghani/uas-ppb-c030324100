<!DOCTYPE html>
<!-- Naufal Elghani C030324100 -->
<!-- Proyek: UAS-PPB_TI_3C_C030324100 -->
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pesan Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-red-custom { background-color: #E3421B; }
        .bg-blue-custom { background-color: #1971A8; }
        .input-bordered { border: 1px solid #cbd5e1; }
        .input-bordered:focus { border-color: #3b82f6; outline: none; box-shadow: 0 0 0 1px #3b82f6; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-[420px] bg-white h-screen md:h-[800px] md:rounded-xl shadow-2xl flex flex-col overflow-hidden relative">
        @yield('content')
    </div>

    <!-- Script untuk menyembunyikan alert otomatis -->
    <script>
        setTimeout(() => {
            let alerts = document.querySelectorAll('.alert-box');
            alerts.forEach(alert => alert.style.display = 'none');
        }, 3000);
    </script>
</body>
</html>