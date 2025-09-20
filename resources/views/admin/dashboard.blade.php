<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PropertyHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-primary': '#1c252e',
                        'dark-secondary': '#12181f',
                        'accent-green': '#00ff88'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            z-index: 40;
            transition: transform 0.3s ease;
        }
        
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
        }
        
        .sidebar-item {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .sidebar-item:hover {
            background: rgba(0, 255, 136, 0.1);
            color: #00ff88;
        }
        
        .sidebar-item.active {
            background: rgba(0, 255, 136, 0.15);
            color: #00ff88;
        }
        
        .sidebar-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #00ff88;
        }
        
        .dashboard-card {
            background: rgba(28, 37, 46, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .dashboard-card:hover {
            border-color: rgba(0, 255, 136, 0.3);
            transform: translateY(-2px);
        }
        
        .stat-card {
            background: linear-gradient(135deg, rgba(0, 255, 136, 0.1), rgba(0, 204, 106, 0.1));
            border: 1px solid rgba(0, 255, 136, 0.3);
            backdrop-filter: blur(10px);
        }
        
        .floating-shapes {
            position: fixed;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }
        
        .shape {
            position: absolute;
            opacity: 0.02;
            animation: float 25s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            top: 60%;
            right: 10%;
            animation-delay: 12s;
        }
        
        .shape:nth-child(3) {
            bottom: 15%;
            left: 15%;
            animation-delay: 6s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-40px) rotate(180deg); }
        }
        
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 30;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
        
        .search-input {
            background: rgba(18, 24, 31, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            border-color: #00ff88;
            box-shadow: 0 0 0 3px rgba(0, 255, 136, 0.1);
            outline: none;
        }
        
        .notification-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: #1c252e;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            width: 320px;
            max-height: 400px;
            overflow-y: auto;
            z-index: 50;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }
        
        .notification-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .profile-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: #1c252e;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            width: 200px;
            z-index: 50;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }
        
        .profile-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .counter {
            font-variant-numeric: tabular-nums;
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .status-paid {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }
        
        .status-pending {
            background: rgba(251, 191, 36, 0.2);
            color: #fbbf24;
            border: 1px solid rgba(251, 191, 36, 0.3);
        }
        
        .status-failed {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        
        .action-button {
            background: linear-gradient(135deg, #00ff88, #00cc6a);
            transition: all 0.3s ease;
        }
        
        .action-button:hover {
            background: linear-gradient(135deg, #00cc6a, #00aa55);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 255, 136, 0.3);
        }
        
        .chart-container {
            position: relative;
            height: 300px;
        }
        
        .activity-item {
            transition: all 0.3s ease;
            padding: 1rem;
            border-radius: 0.75rem;
        }
        
        .activity-item:hover {
            background: rgba(0, 255, 136, 0.05);
        }
        
        .table-container {
            overflow-x: auto;
        }
        
        .table-row {
            transition: all 0.3s ease;
        }
        
        .table-row:hover {
            background: rgba(0, 255, 136, 0.05);
        }
        
        .pagination-button {
            padding: 0.5rem 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(28, 37, 46, 0.8);
            color: #9ca3af;
            transition: all 0.3s ease;
        }
        
        .pagination-button:hover {
            border-color: #00ff88;
            color: #00ff88;
        }
        
        .pagination-button.active {
            background: #00ff88;
            color: #1c252e;
            border-color: #00ff88;
        }
    </style>
</head>
<body class="bg-dark-secondary text-white overflow-x-hidden">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape">
            <svg width="180" height="180" viewBox="0 0 180 180" xmlns="http://www.w3.org/2000/svg">
                <rect width="180" height="180" fill="#00ff88" rx="40"/>
            </svg>
        </div>
        <div class="shape">
            <svg width="150" height="150" viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg">
                <circle cx="75" cy="75" r="75" fill="#00ff88"/>
            </svg>
        </div>
        <div class="shape">
            <svg width="160" height="160" viewBox="0 0 160 160" xmlns="http://www.w3.org/2000/svg">
                <polygon points="80,20 140,120 20,120" fill="#00ff88"/>
            </svg>
        </div>
    </div>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Fixed Sidebar -->
    <div class="sidebar bg-dark-primary border-r border-gray-700 flex flex-col" id="sidebar">
        <!-- Logo -->
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-accent-green rounded-xl flex items-center justify-center mr-3">
                    <svg class="w-7 h-7 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                </div>
                <div>
                    <span class="text-xl font-bold text-accent-green">PropertyHub</span>
                    <p class="text-xs text-gray-400">Admin Panel</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4">
            <ul class="space-y-2">
                <li>
                    <a href="#" class="sidebar-item active flex items-center px-4 py-3 rounded-xl">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center px-4 py-3 rounded-xl text-gray-300">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span class="font-medium">Manage Properties</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center px-4 py-3 rounded-xl text-gray-300">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="font-medium">Manage Agents</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center px-4 py-3 rounded-xl text-gray-300">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="font-medium">Manage Buyers</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center px-4 py-3 rounded-xl text-gray-300">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                        <span class="font-medium">Payments & Transactions</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center px-4 py-3 rounded-xl text-gray-300">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span class="font-medium">Reports & Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center px-4 py-3 rounded-xl text-gray-300">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="font-medium">Settings</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-gray-700">
            <a href="#" class="sidebar-item flex items-center px-4 py-3 rounded-xl text-gray-300 hover:text-red-400">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span class="font-medium">Logout</span>
            </a>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content relative z-10">
        <!-- Top Bar -->
        <header class="bg-dark-primary border-b border-gray-700 px-6 py-4 sticky top-0 z-20">
            <div class="flex items-center justify-between">
                <!-- Mobile Menu Button -->
                <button class="lg:hidden text-gray-300 hover:text-accent-green" id="mobileMenuBtn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Search Bar -->
                <div class="flex-1 max-w-md mx-4">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" placeholder="Search properties, agents, buyers..." class="search-input w-full pl-10 pr-4 py-3 rounded-lg text-white" id="globalSearch">
                    </div>
                </div>

                <!-- Right Side -->
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <div class="relative">
                        <button class="text-gray-300 hover:text-accent-green relative" id="notificationBtn">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span class="absolute -top-2 -right-2 bg-accent-green text-dark-secondary text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">7</span>
                        </button>
                        
                        <!-- Notification Dropdown -->
                        <div class="notification-dropdown" id="notificationDropdown">
                            <div class="p-4 border-b border-gray-600">
                                <h3 class="font-semibold text-white">Notifications</h3>
                                <p class="text-xs text-gray-400">You have 7 new notifications</p>
                            </div>
                            <div class="max-h-80 overflow-y-auto">
                                <div class="p-3 border-b border-gray-700 hover:bg-gray-700">
                                    <p class="text-sm text-white">New property listing submitted</p>
                                    <p class="text-xs text-gray-400">2 minutes ago</p>
                                </div>
                                <div class="p-3 border-b border-gray-700 hover:bg-gray-700">
                                    <p class="text-sm text-white">Agent verification pending</p>
                                    <p class="text-xs text-gray-400">15 minutes ago</p>
                                </div>
                                <div class="p-3 border-b border-gray-700 hover:bg-gray-700">
                                    <p class="text-sm text-white">Payment received: ₹2,50,000</p>
                                    <p class="text-xs text-gray-400">1 hour ago</p>
                                </div>
                            </div>
                            <div class="p-3 text-center">
                                <a href="#" class="text-accent-green text-sm hover:underline">View all notifications</a>
                            </div>
                        </div>
                    </div>

                    <!-- Profile -->
                    <div class="relative">
                        <button class="flex items-center space-x-3 text-gray-300 hover:text-accent-green" id="profileBtn">
                            <div class="w-10 h-10 bg-gradient-to-br from-accent-green to-green-600 rounded-full flex items-center justify-center text-dark-secondary font-bold">
                                AD
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-semibold">Admin User</p>
                                <p class="text-xs text-gray-400">System Administrator</p>
                            </div>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <!-- Profile Dropdown -->
                        <div class="profile-dropdown" id="profileDropdown">
                            <div class="p-2">
                                <a href="#" class="flex items-center px-3 py-2 text-gray-300 hover:text-accent-green hover:bg-gray-700 rounded">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profile
                                </a>
                                <a href="#" class="flex items-center px-3 py-2 text-gray-300 hover:text-accent-green hover:bg-gray-700 rounded">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Settings
                                </a>
                                <hr class="my-2 border-gray-600">
                                <a href="#" class="flex items-center px-3 py-2 text-red-400 hover:bg-gray-700 rounded">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="p-6 space-y-6">
            <!-- Welcome Message -->
            <div class="dashboard-card rounded-2xl p-6">
                <h1 class="text-3xl font-bold text-white mb-2">Welcome back, Admin</h1>
                <p class="text-gray-400">Here's what's happening with your property sales system today.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Properties Listed</p>
                            <p class="text-3xl font-bold text-accent-green counter" data-target="1247">0</p>
                            <p class="text-green-400 text-sm">↗ +12% from last month</p>
                        </div>
                        <div class="w-12 h-12 bg-accent-green bg-opacity-20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Verified Agents</p>
                            <p class="text-3xl font-bold text-accent-green counter" data-target="89">0</p>
                            <p class="text-green-400 text-sm">↗ +5% from last month</p>
                        </div>
                        <div class="w-12 h-12 bg-accent-green bg-opacity-20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Active Buyers</p>
                            <p class="text-3xl font-bold text-accent-green counter" data-target="2156">0</p>
                            <p class="text-green-400 text-sm">↗ +18% from last month</p>
                        </div>
                        <div class="w-12 h-12 bg-accent-green bg-opacity-20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Revenue</p>
                            <p class="text-3xl font-bold text-accent-green">₹12.4M</p>
                            <p class="text-green-400 text-sm">↗ +24% from last month</p>
                        </div>
                        <div class="w-12 h-12 bg-accent-green bg-opacity-20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Earnings Chart -->
                <div class="dashboard-card rounded-2xl p-6">
                    <h3 class="text-xl font-bold mb-4">Monthly Revenue</h3>
                    <div class="chart-container">
                        <canvas id="earningsChart"></canvas>
                    </div>
                </div>

                <!-- Property Sales Chart -->
                <div class="dashboard-card rounded-2xl p-6">
                    <h3 class="text-xl font-bold mb-4">Property Sales by Category</h3>
                    <div class="chart-container">
                        <canvas id="propertySalesChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Agent Performance Chart -->
            <div class="dashboard-card rounded-2xl p-6">
                <h3 class="text-xl font-bold mb-4">Agent Performance Distribution</h3>
                <div class="chart-container">
                    <canvas id="agentPerformanceChart"></canvas>
                </div>
            </div>

            <!-- Recent Activity & Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Activity -->
                <div class="lg:col-span-2 dashboard-card rounded-2xl p-6">
                    <h3 class="text-xl font-bold mb-4">Recent Activity</h3>
                    <div class="space-y-4">
                        <div class="activity-item">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-500 bg-opacity-20 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-white font-medium">New Property Listed</p>
                                    <p class="text-gray-400 text-sm">3-bedroom apartment in Bole by Sara Tadesse</p>
                                    <p class="text-gray-500 text-xs">2 minutes ago</p>
                                </div>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-500 bg-opacity-20 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-white font-medium">New Agent Registration</p>
                                    <p class="text-gray-400 text-sm">Michael Johnson submitted verification documents</p>
                                    <p class="text-gray-500 text-xs">15 minutes ago</p>
                                </div>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-purple-500 bg-opacity-20 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-white font-medium">New Buyer Registration</p>
                                    <p class="text-gray-400 text-sm">Aisha Mohammed created an account</p>
                                    <p class="text-gray-500 text-xs">1 hour ago</p>
                                </div>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-500 bg-opacity-20 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-white font-medium">Payment Verified</p>
                                    <p class="text-gray-400 text-sm">₹2,50,000 payment confirmed for Property #1234</p>
                                    <p class="text-gray-500 text-xs">2 hours ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="dashboard-card rounded-2xl p-6">
                    <h3 class="text-xl font-bold mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <button class="action-button w-full py-3 rounded-lg text-dark-secondary font-semibold flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add New Property
                        </button>
                        
                        <button class="action-button w-full py-3 rounded-lg text-dark-secondary font-semibold flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Verify Agent
                        </button>
                        
                        <button class="action-button w-full py-3 rounded-lg text-dark-secondary font-semibold flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Generate Report
                        </button>
                    </div>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="dashboard-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold">Recent Transactions</h3>
                    <div class="flex items-center space-x-4">
                        <input type="text" placeholder="Search transactions..." class="search-input px-4 py-2 rounded-lg text-white text-sm" id="transactionSearch">
                        <select class="search-input px-4 py-2 rounded-lg text-white text-sm">
                            <option>All Status</option>
                            <option>Paid</option>
                            <option>Pending</option>
                            <option>Failed</option>
                        </select>
                    </div>
                </div>
                
                <div class="table-container">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-600">
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Date</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">User</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Property</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Amount</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Status</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-row border-b border-gray-700">
                                <td class="py-3 px-4 text-white">Jan 15, 2025</td>
                                <td class="py-3 px-4 text-white">Aisha Mohammed</td>
                                <td class="py-3 px-4 text-white">3BR Apartment - Bole</td>
                                <td class="py-3 px-4 text-white">₹2,50,000</td>
                                <td class="py-3 px-4"><span class="status-badge status-paid">Paid</span></td>
                                <td class="py-3 px-4">
                                    <button class="text-accent-green hover:text-green-400 text-sm">View</button>
                                </td>
                            </tr>
                            <tr class="table-row border-b border-gray-700">
                                <td class="py-3 px-4 text-white">Jan 15, 2025</td>
                                <td class="py-3 px-4 text-white">David Wilson</td>
                                <td class="py-3 px-4 text-white">Commercial Space - CMC</td>
                                <td class="py-3 px-4 text-white">₹5,00,000</td>
                                <td class="py-3 px-4"><span class="status-badge status-pending">Pending</span></td>
                                <td class="py-3 px-4">
                                    <button class="text-accent-green hover:text-green-400 text-sm">View</button>
                                </td>
                            </tr>
                            <tr class="table-row border-b border-gray-700">
                                <td class="py-3 px-4 text-white">Jan 14, 2025</td>
                                <td class="py-3 px-4 text-white">Sarah Johnson</td>
                                <td class="py-3 px-4 text-white">Villa - Kazanchis</td>
                                <td class="py-3 px-4 text-white">₹8,75,000</td>
                                <td class="py-3 px-4"><span class="status-badge status-paid">Paid</span></td>
                                <td class="py-3 px-4">
                                    <button class="text-accent-green hover:text-green-400 text-sm">View</button>
                                </td>
                            </tr>
                            <tr class="table-row border-b border-gray-700">
                                <td class="py-3 px-4 text-white">Jan 14, 2025</td>
                                <td class="py-3 px-4 text-white">Ahmed Hassan</td>
                                <td class="py-3 px-4 text-white">Land Plot - Lebu</td>
                                <td class="py-3 px-4 text-white">₹1,20,000</td>
                                <td class="py-3 px-4"><span class="status-badge status-failed">Failed</span></td>
                                <td class="py-3 px-4">
                                    <button class="text-accent-green hover:text-green-400 text-sm">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="flex items-center justify-between mt-6">
                    <p class="text-gray-400 text-sm">Showing 1-4 of 156 transactions</p>
                    <div class="flex items-center space-x-2">
                        <button class="pagination-button rounded">Previous</button>
                        <button class="pagination-button active rounded">1</button>
                        <button class="pagination-button rounded">2</button>
                        <button class="pagination-button rounded">3</button>
                        <button class="pagination-button rounded">Next</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-dark-primary border-t border-gray-700 p-4 text-center">
            <p class="text-gray-400 text-sm">© 2025 Property Sales System</p>
        </footer>
    </div>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('active');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('active');
        });

        // Dropdown toggles
        const notificationBtn = document.getElementById('notificationBtn');
        const notificationDropdown = document.getElementById('notificationDropdown');
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');

        notificationBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            notificationDropdown.classList.toggle('active');
            profileDropdown.classList.remove('active');
        });

        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle('active');
            notificationDropdown.classList.remove('active');
        });

        document.addEventListener('click', () => {
            notificationDropdown.classList.remove('active');
            profileDropdown.classList.remove('active');
        });

        // Counter animation
        function animateCounter(element, target, duration = 2000) {
            const start = 0;
            const increment = target / (duration / 16);
            let current = start;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current);
            }, 16);
        }

        // Initialize counter animations
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.counter').forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                animateCounter(counter, target);
            });
        });

        // Charts
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#9ca3af'
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#9ca3af'
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                },
                y: {
                    ticks: {
                        color: '#9ca3af'
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                }
            }
        };

        // Earnings Chart
        const earningsCtx = document.getElementById('earningsChart').getContext('2d');
        new Chart(earningsCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Revenue (₹ Lakhs)',
                    data: [85, 92, 78, 105, 98, 112, 125, 118, 135, 142, 128, 155],
                    borderColor: '#00ff88',
                    backgroundColor: 'rgba(0, 255, 136, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: chartOptions
        });

        // Property Sales Chart
        const propertySalesCtx = document.getElementById('propertySalesChart').getContext('2d');
        new Chart(propertySalesCtx, {
            type: 'bar',
            data: {
                labels: ['Apartments', 'Houses', 'Commercial', 'Land'],
                datasets: [{
                    label: 'Sales Count',
                    data: [456, 234, 123, 89],
                    backgroundColor: [
                        'rgba(0, 255, 136, 0.8)',
                        'rgba(0, 255, 136, 0.6)',
                        'rgba(0, 255, 136, 0.4)',
                        'rgba(0, 255, 136, 0.2)'
                    ],
                    borderColor: '#00ff88',
                    borderWidth: 1
                }]
            },
            options: chartOptions
        });

        // Agent Performance Chart
        const agentPerformanceCtx = document.getElementById('agentPerformanceChart').getContext('2d');
        new Chart(agentPerformanceCtx, {
            type: 'doughnut',
            data: {
                labels: ['Sara Tadesse', 'Michael Johnson', 'Aisha Mohammed', 'David Wilson', 'Others'],
                datasets: [{
                    data: [25, 20, 18, 15, 22],
                    backgroundColor: [
                        '#00ff88',
                        '#00cc6a',
                        '#00aa55',
                        '#008844',
                        '#006633'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: '#9ca3af',
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                }
            }
        });

        // Search functionality
        const globalSearch = document.getElementById('globalSearch');
        const transactionSearch = document.getElementById('transactionSearch');

        globalSearch.addEventListener('input', function() {
            // Implement global search logic
            console.log('Searching for:', this.value);
        });

        transactionSearch.addEventListener('input', function() {
            // Implement transaction search logic
            console.log('Searching transactions for:', this.value);
        });

        // Quick action buttons
        document.querySelectorAll('.action-button').forEach(button => {
            button.addEventListener('click', function() {
                const action = this.textContent.trim();
                alert(`${action} functionality would be implemented here.`);
            });
        });

        // Sidebar navigation
        document.querySelectorAll('.sidebar-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all items
                document.querySelectorAll('.sidebar-item').forEach(i => i.classList.remove('active'));
                
                // Add active class to clicked item
                this.classList.add('active');
                
                // Get the page name
                const pageName = this.textContent.trim();
                
                if (pageName === 'Logout') {
                    alert('Logging out...');
                } else if (pageName !== 'Dashboard') {
                    alert(`Navigating to: ${pageName}`);
                }
            });
        });

        // Table row clicks
        document.querySelectorAll('.table-row').forEach(row => {
            row.addEventListener('click', function() {
                const property = this.cells[2].textContent;
                alert(`Viewing details for: ${property}`);
            });
        });

        // Pagination
        document.querySelectorAll('.pagination-button').forEach(button => {
            button.addEventListener('click', function() {
                if (!this.classList.contains('active')) {
                    document.querySelectorAll('.pagination-button').forEach(b => b.classList.remove('active'));
                    if (!isNaN(this.textContent)) {
                        this.classList.add('active');
                    }
                }
            });
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9771e3d7c0a5f7f3',t:'MTc1NjUzMTc2Mi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
