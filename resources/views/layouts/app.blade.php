<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQUITY UP - Environmental Monitoring</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js" rel="preload" as="script">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Reset & Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: #f3f4f6;
            min-height: 100vh;
        }
        
        /* Layout container menggunakan flex */
        .app-container {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }
        
        /* Main Content - Area yang bisa di-scroll */
        .main-content {
            flex: 1;
            overflow-y: auto;
            min-height: 100vh;
        }
        
        /* SIDEBAR - Sticky/Fixed tidak ikut scroll */
        .sidebar {
            width: 280px;
            flex-shrink: 0;
            background-color: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto; /* Sidebar bisa scroll sendiri jika kontennya panjang */
            scrollbar-width: thin;
        }
        
        /* Main Content - Area yang bisa di-scroll */
        .main-content {
            flex: 1;
            overflow-y: auto;
            height: 100vh;
            scroll-behavior: smooth;
        }
        
        /* Custom scrollbar */
        .main-content::-webkit-scrollbar {
            width: 8px;
        }
        
        .main-content::-webkit-scrollbar-track {
            background: #e5e7eb;
            border-radius: 10px;
        }
        
        .main-content::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 10px;
        }
        
        .main-content::-webkit-scrollbar-thumb:hover {
            background: #059669;
        }
        
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: #f3f4f6;
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        
        /* Status badge styles */
        .status-badge { 
            @apply px-2 py-1 rounded-full text-xs font-semibold; 
        }
        .status-normal { 
            background-color: #10b981; 
            color: white; 
        }
        .status-waspada { 
            background-color: #f59e0b; 
            color: white; 
        }
        .status-rusak { 
            background-color: #ef4444; 
            color: white; 
        }
        .status-offline { 
            background-color: #6b7280; 
            color: white; 
        }
        
        /* Nav link active state */
        .nav-link-active {
            background-color: #f0fdf4;
            color: #059669;
            border-left: 3px solid #10b981;
        }
        
        .nav-link {
            transition: all 0.2s ease;
        }
        
        .nav-link:hover {
            background-color: #f9fafb;
        }
        
        /* Hover effect untuk kartu */
        .group:hover .group-hover\:scale-105 {
            transform: scale(1.05);
        }
        
        /* Animasi tombol */
        .hover\:scale-105:hover {
            transform: scale(1.05);
        }
        
        /* Backdrop blur untuk hero */
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="app-container">
    <!-- SIDEBAR - Tidak ikut scroll -->
    <aside class="sidebar">
        <div class="p-5 border-b">
            <div class="flex items-center space-x-2">
                <i class="fas fa-leaf text-green-600 text-2xl"></i>
                <span class="text-xl font-bold text-gray-800">EQUITY UP</span>
            </div>
            <p class="text-xs text-gray-500 mt-1">Integrated Environmental Monitoring</p>
        </div>
        
        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('public.dashboard') }}" 
               class="nav-link flex items-center space-x-3 p-3 rounded-lg transition {{ request()->routeIs('public.dashboard') ? 'nav-link-active' : 'text-gray-700' }}">
                <i class="fas fa-home w-5"></i>
                <span>Beranda</span>
            </a>
            
            <a href="{{ route('public.locations') }}" 
               class="nav-link flex items-center space-x-3 p-3 rounded-lg transition {{ request()->routeIs('public.locations') ? 'nav-link-active' : 'text-gray-700' }}">
                <i class="fas fa-map-marker-alt w-5"></i>
                <span>Lokasi & Perangkat</span>
            </a>
            
            <a href="{{ route('public.developer') }}" 
               class="nav-link flex items-center space-x-3 p-3 rounded-lg transition {{ request()->routeIs('public.developer') ? 'nav-link-active' : 'text-gray-700' }}">
                <i class="fas fa-users w-5"></i>
                <span>Profil Pengembang</span>
            </a>
        </nav>
        
        <div class="p-4 border-t mt-auto">
            <a href="https://wa.me/6281234567890?text=Halo%20saya%20ingin%20melaporkan%20masalah%20pada%20aplikasi%20EQUITY%20UP" 
               target="_blank" 
               class="flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg transition">
                <i class="fab fa-whatsapp"></i>
                <span>Laporkan Masalah</span>
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT - Area scrollable -->
    <main class="main-content">
        <div class="p-6">
            @yield('content')
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>