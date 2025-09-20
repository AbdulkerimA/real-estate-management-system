<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Agents - PropertyHub Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        
        .filter-select {
            background: rgba(18, 24, 31, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .filter-select:focus {
            border-color: #00ff88;
            outline: none;
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .status-pending {
            background: rgba(251, 191, 36, 0.2);
            color: #fbbf24;
            border: 1px solid rgba(251, 191, 36, 0.3);
        }
        
        .status-verified {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }
        
        .status-suspended {
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
        
        .agent-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(0, 255, 136, 0.3);
        }
        
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .modal.active {
            opacity: 1;
            visibility: visible;
        }
        
        .modal-content {
            background: #1c252e;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            max-width: 900px;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }
        
        .modal.active .modal-content {
            transform: scale(1);
        }
        
        .action-btn {
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        
        .btn-view {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
            border-color: rgba(59, 130, 246, 0.3);
        }
        
        .btn-view:hover {
            background: rgba(59, 130, 246, 0.3);
        }
        
        .btn-verify {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
            border-color: rgba(34, 197, 94, 0.3);
        }
        
        .btn-verify:hover {
            background: rgba(34, 197, 94, 0.3);
        }
        
        .btn-suspend {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
            border-color: rgba(239, 68, 68, 0.3);
        }
        
        .btn-suspend:hover {
            background: rgba(239, 68, 68, 0.3);
        }
        
        .btn-delete {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
            border-color: rgba(239, 68, 68, 0.3);
        }
        
        .btn-delete:hover {
            background: rgba(239, 68, 68, 0.3);
        }
        
        .counter {
            font-variant-numeric: tabular-nums;
        }
        
        .bulk-actions {
            background: rgba(28, 37, 46, 0.95);
            border: 1px solid rgba(0, 255, 136, 0.3);
            backdrop-filter: blur(10px);
            transform: translateY(-100%);
            transition: all 0.3s ease;
        }
        
        .bulk-actions.active {
            transform: translateY(0);
        }
        
        .checkbox-custom {
            appearance: none;
            width: 1rem;
            height: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 0.25rem;
            background: transparent;
            position: relative;
            cursor: pointer;
        }
        
        .checkbox-custom:checked {
            background: #00ff88;
            border-color: #00ff88;
        }
        
        .checkbox-custom:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #1c252e;
            font-size: 0.75rem;
            font-weight: bold;
        }
        
        .rating-stars {
            display: flex;
            align-items: center;
            gap: 0.125rem;
        }
        
        .star {
            color: #fbbf24;
            font-size: 0.875rem;
        }
        
        .star.empty {
            color: #374151;
        }
        
        .property-card {
            background: rgba(18, 24, 31, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 1rem;
            transition: all 0.3s ease;
        }
        
        .property-card:hover {
            border-color: rgba(0, 255, 136, 0.3);
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
                    <a href="#" class="sidebar-item flex items-center px-4 py-3 rounded-xl text-gray-300">
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
                    <a href="#" class="sidebar-item active flex items-center px-4 py-3 rounded-xl">
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

                <!-- Page Title -->
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-white">Manage Agents</h1>
                    <p class="text-gray-400 text-sm">View, verify, and manage all registered agents</p>
                </div>

                <!-- Add New Agent Button -->
                <button class="action-button px-6 py-3 rounded-lg text-dark-secondary font-semibold flex items-center" id="addAgentBtn">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add New Agent
                </button>
            </div>
        </header>

        <!-- Page Content -->
        <div class="p-6 space-y-6">
            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Agents</p>
                            <p class="text-3xl font-bold text-accent-green counter" data-target="342">0</p>
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
                            <p class="text-gray-400 text-sm">Verified Agents</p>
                            <p class="text-3xl font-bold text-green-400 counter" data-target="298">0</p>
                        </div>
                        <div class="w-12 h-12 bg-green-400 bg-opacity-20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Pending Verification</p>
                            <p class="text-3xl font-bold text-yellow-400 counter" data-target="31">0</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-400 bg-opacity-20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Suspended Agents</p>
                            <p class="text-3xl font-bold text-red-400 counter" data-target="13">0</p>
                        </div>
                        <div class="w-12 h-12 bg-red-400 bg-opacity-20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters & Search -->
            <div class="dashboard-card rounded-2xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="lg:col-span-1">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" placeholder="Search by name or email..." class="search-input w-full pl-10 pr-4 py-3 rounded-lg text-white" id="agentSearch">
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <select class="filter-select w-full px-4 py-3 rounded-lg text-white" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="verified">Verified</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>

                    <!-- Experience Filter -->
                    <div>
                        <select class="filter-select w-full px-4 py-3 rounded-lg text-white" id="experienceFilter">
                            <option value="">All Experience</option>
                            <option value="1-3">1-3 years</option>
                            <option value="3-5">3-5 years</option>
                            <option value="5+">5+ years</option>
                        </select>
                    </div>

                    <!-- Location Filter -->
                    <div>
                        <select class="filter-select w-full px-4 py-3 rounded-lg text-white" id="locationFilter">
                            <option value="">All Locations</option>
                            <option value="addis-ababa">Addis Ababa</option>
                            <option value="dire-dawa">Dire Dawa</option>
                            <option value="bahir-dar">Bahir Dar</option>
                            <option value="hawassa">Hawassa</option>
                        </select>
                    </div>
                </div>

                <!-- Date Range Filter -->
                <div class="mt-4 flex items-center space-x-4">
                    <label class="text-gray-400 text-sm">Registration Date:</label>
                    <input type="date" class="filter-select px-3 py-2 rounded text-white text-sm" id="dateFrom">
                    <span class="text-gray-400">to</span>
                    <input type="date" class="filter-select px-3 py-2 rounded text-white text-sm" id="dateTo">
                    <button class="action-button px-4 py-2 rounded text-dark-secondary font-medium text-sm" id="applyFilters">
                        Apply Filters
                    </button>
                    <button class="text-gray-400 hover:text-accent-green text-sm" id="clearFilters">
                        Clear All
                    </button>
                </div>
            </div>

            <!-- Bulk Actions Bar -->
            <div class="bulk-actions rounded-lg p-4 mb-4" id="bulkActions">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <span class="text-white font-medium" id="selectedCount">0 agents selected</span>
                        <div class="flex items-center space-x-2">
                            <button class="btn-verify action-btn" id="bulkVerify">Verify Selected</button>
                            <button class="btn-suspend action-btn" id="bulkSuspend">Suspend Selected</button>
                            <button class="btn-delete action-btn" id="bulkDelete">Delete Selected</button>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-white" id="clearSelection">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Agents Table -->
            <div class="dashboard-card rounded-2xl p-6">
                <div class="table-container">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-600">
                                <th class="text-left py-3 px-4">
                                    <input type="checkbox" class="checkbox-custom" id="selectAll">
                                </th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Photo</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Full Name</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Email</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Phone</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Properties</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Status</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="agentsTableBody">
                            <tr class="table-row border-b border-gray-700" data-agent-id="1">
                                <td class="py-3 px-4">
                                    <input type="checkbox" class="checkbox-custom agent-checkbox" value="1">
                                </td>
                                <td class="py-3 px-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        ST
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div>
                                        <p class="text-white font-medium">Sara Tadesse</p>
                                        <p class="text-gray-400 text-sm">5 years experience</p>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-white">sara.tadesse@email.com</td>
                                <td class="py-3 px-4 text-white">+251-911-123456</td>
                                <td class="py-3 px-4 text-accent-green font-semibold">23</td>
                                <td class="py-3 px-4"><span class="status-badge status-verified">Verified</span></td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <button class="action-btn btn-view" onclick="viewAgent(1)">View Profile</button>
                                        <button class="action-btn btn-suspend" onclick="suspendAgent(1)">Suspend</button>
                                        <button class="action-btn btn-delete" onclick="deleteAgent(1)">Delete</button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="table-row border-b border-gray-700" data-agent-id="2">
                                <td class="py-3 px-4">
                                    <input type="checkbox" class="checkbox-custom agent-checkbox" value="2">
                                </td>
                                <td class="py-3 px-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        MJ
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div>
                                        <p class="text-white font-medium">Michael Johnson</p>
                                        <p class="text-gray-400 text-sm">3 years experience</p>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-white">michael.j@email.com</td>
                                <td class="py-3 px-4 text-white">+251-911-789012</td>
                                <td class="py-3 px-4 text-accent-green font-semibold">18</td>
                                <td class="py-3 px-4"><span class="status-badge status-pending">Pending</span></td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <button class="action-btn btn-view" onclick="viewAgent(2)">View Profile</button>
                                        <button class="action-btn btn-verify" onclick="verifyAgent(2)">Verify</button>
                                        <button class="action-btn btn-delete" onclick="deleteAgent(2)">Delete</button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="table-row border-b border-gray-700" data-agent-id="3">
                                <td class="py-3 px-4">
                                    <input type="checkbox" class="checkbox-custom agent-checkbox" value="3">
                                </td>
                                <td class="py-3 px-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        AM
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div>
                                        <p class="text-white font-medium">Aisha Mohammed</p>
                                        <p class="text-gray-400 text-sm">7 years experience</p>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-white">aisha.m@email.com</td>
                                <td class="py-3 px-4 text-white">+251-911-345678</td>
                                <td class="py-3 px-4 text-accent-green font-semibold">31</td>
                                <td class="py-3 px-4"><span class="status-badge status-verified">Verified</span></td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <button class="action-btn btn-view" onclick="viewAgent(3)">View Profile</button>
                                        <button class="action-btn btn-suspend" onclick="suspendAgent(3)">Suspend</button>
                                        <button class="action-btn btn-delete" onclick="deleteAgent(3)">Delete</button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="table-row border-b border-gray-700" data-agent-id="4">
                                <td class="py-3 px-4">
                                    <input type="checkbox" class="checkbox-custom agent-checkbox" value="4">
                                </td>
                                <td class="py-3 px-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        DW
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div>
                                        <p class="text-white font-medium">David Wilson</p>
                                        <p class="text-gray-400 text-sm">2 years experience</p>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-white">david.wilson@email.com</td>
                                <td class="py-3 px-4 text-white">+251-911-567890</td>
                                <td class="py-3 px-4 text-accent-green font-semibold">8</td>
                                <td class="py-3 px-4"><span class="status-badge status-suspended">Suspended</span></td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <button class="action-btn btn-view" onclick="viewAgent(4)">View Profile</button>
                                        <button class="action-btn btn-verify" onclick="verifyAgent(4)">Reactivate</button>
                                        <button class="action-btn btn-delete" onclick="deleteAgent(4)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-6">
                    <p class="text-gray-400 text-sm">Showing 1-4 of 342 agents</p>
                    <div class="flex items-center space-x-2">
                        <button class="pagination-button rounded">Previous</button>
                        <button class="pagination-button active rounded">1</button>
                        <button class="pagination-button rounded">2</button>
                        <button class="pagination-button rounded">3</button>
                        <button class="pagination-button rounded">...</button>
                        <button class="pagination-button rounded">86</button>
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

    <!-- Agent Profile Preview Modal -->
    <div class="modal" id="agentModal">
        <div class="modal-content p-6 w-full max-w-5xl mx-4">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-white">Agent Profile</h2>
                <button class="text-gray-400 hover:text-white" id="closeModal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Agent Info -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Profile Photo -->
                    <div class="text-center">
                        <div class="w-32 h-32 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-4xl mx-auto mb-4">
                            ST
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2" id="modalName">Sara Tadesse</h3>
                        <span class="status-badge status-verified" id="modalStatus">Verified</span>
                    </div>

                    <!-- Contact Info -->
                    <div class="dashboard-card rounded-xl p-4">
                        <h4 class="text-white font-semibold mb-3">Contact Information</h4>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-gray-300 text-sm" id="modalEmail">sara.tadesse@email.com</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-gray-300 text-sm" id="modalPhone">+251-911-123456</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-gray-300 text-sm" id="modalLocation">Addis Ababa, Ethiopia</span>
                            </div>
                        </div>
                    </div>

                    <!-- Experience & Rating -->
                    <div class="dashboard-card rounded-xl p-4">
                        <h4 class="text-white font-semibold mb-3">Professional Info</h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-gray-400 text-sm">Experience</p>
                                <p class="text-white font-medium" id="modalExperience">5 years</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Rating</p>
                                <div class="flex items-center space-x-2">
                                    <div class="rating-stars">
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                    </div>
                                    <span class="text-white text-sm">4.8 (127 reviews)</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Properties Listed</p>
                                <p class="text-accent-green font-bold text-xl" id="modalProperties">23</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-2">
                        <button class="action-button w-full px-4 py-3 rounded-lg text-dark-secondary font-semibold" id="modalVerify">
                            Verify Agent
                        </button>
                        <button class="btn-suspend action-btn w-full px-4 py-3" id="modalSuspend">
                            Suspend Agent
                        </button>
                    </div>
                </div>

                <!-- Agent Details & Properties -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Bio -->
                    <div class="dashboard-card rounded-xl p-4">
                        <h4 class="text-white font-semibold mb-3">About</h4>
                        <p class="text-gray-300 text-sm leading-relaxed" id="modalBio">
                            Experienced real estate agent with over 5 years in the Ethiopian property market. Specializes in residential and commercial properties in Addis Ababa. Known for excellent customer service and deep market knowledge. Licensed and certified with the Ethiopian Real Estate Association.
                        </p>
                    </div>

                    <!-- Recent Properties -->
                    <div class="dashboard-card rounded-xl p-4">
                        <h4 class="text-white font-semibold mb-4">Recent Properties Listed</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="property-card">
                                <div class="flex items-center space-x-3">
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-white font-medium text-sm">Luxury 3BR Apartment</p>
                                        <p class="text-gray-400 text-xs">Bole, Addis Ababa</p>
                                        <p class="text-accent-green font-semibold text-sm">₹2,50,000</p>
                                    </div>
                                </div>
                            </div>

                            <div class="property-card">
                                <div class="flex items-center space-x-3">
                                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-white font-medium text-sm">Modern Office Space</p>
                                        <p class="text-gray-400 text-xs">CMC, Addis Ababa</p>
                                        <p class="text-accent-green font-semibold text-sm">₹1,80,000</p>
                                    </div>
                                </div>
                            </div>

                            <div class="property-card">
                                <div class="flex items-center space-x-3">
                                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-white font-medium text-sm">Residential Land</p>
                                        <p class="text-gray-400 text-xs">Lebu, Addis Ababa</p>
                                        <p class="text-accent-green font-semibold text-sm">₹95,000</p>
                                    </div>
                                </div>
                            </div>

                            <div class="property-card">
                                <div class="flex items-center space-x-3">
                                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-white font-medium text-sm">Family Villa</p>
                                        <p class="text-gray-400 text-xs">Kazanchis, Addis Ababa</p>
                                        <p class="text-accent-green font-semibold text-sm">₹4,20,000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Reviews -->
                    <div class="dashboard-card rounded-xl p-4">
                        <h4 class="text-white font-semibold mb-4">Recent Reviews</h4>
                        <div class="space-y-4">
                            <div class="border-b border-gray-600 pb-3">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                            AB
                                        </div>
                                        <span class="text-white font-medium text-sm">Abebe Bekele</span>
                                    </div>
                                    <div class="rating-stars">
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                    </div>
                                </div>
                                <p class="text-gray-300 text-sm">Excellent service! Sara helped me find the perfect apartment in Bole. Very professional and knowledgeable about the market.</p>
                            </div>

                            <div class="border-b border-gray-600 pb-3">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                            MH
                                        </div>
                                        <span class="text-white font-medium text-sm">Meron Haile</span>
                                    </div>
                                    <div class="rating-stars">
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star empty">★</span>
                                    </div>
                                </div>
                                <p class="text-gray-300 text-sm">Great experience working with Sara. She was very responsive and helped negotiate a good price for our office space.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

        // Checkbox functionality
        const selectAllCheckbox = document.getElementById('selectAll');
        const agentCheckboxes = document.querySelectorAll('.agent-checkbox');
        const bulkActions = document.getElementById('bulkActions');
        const selectedCount = document.getElementById('selectedCount');

        function updateBulkActions() {
            const checkedBoxes = document.querySelectorAll('.agent-checkbox:checked');
            const count = checkedBoxes.length;
            
            if (count > 0) {
                bulkActions.classList.add('active');
                selectedCount.textContent = `${count} agents selected`;
            } else {
                bulkActions.classList.remove('active');
            }
        }

        selectAllCheckbox.addEventListener('change', function() {
            agentCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkActions();
        });

        agentCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const allChecked = Array.from(agentCheckboxes).every(cb => cb.checked);
                const someChecked = Array.from(agentCheckboxes).some(cb => cb.checked);
                
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = someChecked && !allChecked;
                
                updateBulkActions();
            });
        });

        // Clear selection
        document.getElementById('clearSelection').addEventListener('click', function() {
            selectAllCheckbox.checked = false;
            agentCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateBulkActions();
        });

        // Search and filter functionality
        const agentSearch = document.getElementById('agentSearch');
        const statusFilter = document.getElementById('statusFilter');
        const experienceFilter = document.getElementById('experienceFilter');
        const locationFilter = document.getElementById('locationFilter');

        function filterAgents() {
            const searchTerm = agentSearch.value.toLowerCase();
            const statusValue = statusFilter.value;
            const experienceValue = experienceFilter.value;
            const locationValue = locationFilter.value;

            console.log('Filtering agents:', {
                search: searchTerm,
                status: statusValue,
                experience: experienceValue,
                location: locationValue
            });
        }

        agentSearch.addEventListener('input', filterAgents);
        statusFilter.addEventListener('change', filterAgents);
        experienceFilter.addEventListener('change', filterAgents);
        locationFilter.addEventListener('change', filterAgents);

        // Apply and clear filters
        document.getElementById('applyFilters').addEventListener('click', function() {
            filterAgents();
            alert('Filters applied successfully!');
        });

        document.getElementById('clearFilters').addEventListener('click', function() {
            agentSearch.value = '';
            statusFilter.value = '';
            experienceFilter.value = '';
            locationFilter.value = '';
            document.getElementById('dateFrom').value = '';
            document.getElementById('dateTo').value = '';
            filterAgents();
        });

        // Modal functionality
        const agentModal = document.getElementById('agentModal');
        const closeModal = document.getElementById('closeModal');

        function openModal() {
            agentModal.classList.add('active');
        }

        function closeModalFunc() {
            agentModal.classList.remove('active');
        }

        closeModal.addEventListener('click', closeModalFunc);
        agentModal.addEventListener('click', function(e) {
            if (e.target === agentModal) {
                closeModalFunc();
            }
        });

        // Agent action functions
        function viewAgent(id) {
            console.log('Viewing agent:', id);
            openModal();
        }

        function verifyAgent(id) {
            if (confirm('Are you sure you want to verify this agent?')) {
                console.log('Verifying agent:', id);
                alert('Agent verified successfully!');
                // Update status in the table
                const row = document.querySelector(`[data-agent-id="${id}"]`);
                const statusBadge = row.querySelector('.status-badge');
                statusBadge.className = 'status-badge status-verified';
                statusBadge.textContent = 'Verified';
            }
        }

        function suspendAgent(id) {
            if (confirm('Are you sure you want to suspend this agent?')) {
                console.log('Suspending agent:', id);
                alert('Agent suspended successfully!');
                // Update status in the table
                const row = document.querySelector(`[data-agent-id="${id}"]`);
                const statusBadge = row.querySelector('.status-badge');
                statusBadge.className = 'status-badge status-suspended';
                statusBadge.textContent = 'Suspended';
            }
        }

        function deleteAgent(id) {
            if (confirm('Are you sure you want to delete this agent? This action cannot be undone.')) {
                console.log('Deleting agent:', id);
                alert('Agent deleted successfully!');
                // Remove row from table
                const row = document.querySelector(`[data-agent-id="${id}"]`);
                row.remove();
            }
        }

        // Bulk actions
        document.getElementById('bulkVerify').addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.agent-checkbox:checked');
            if (checkedBoxes.length > 0 && confirm(`Verify ${checkedBoxes.length} selected agents?`)) {
                checkedBoxes.forEach(checkbox => {
                    verifyAgent(checkbox.value);
                });
            }
        });

        document.getElementById('bulkSuspend').addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.agent-checkbox:checked');
            if (checkedBoxes.length > 0 && confirm(`Suspend ${checkedBoxes.length} selected agents?`)) {
                checkedBoxes.forEach(checkbox => {
                    suspendAgent(checkbox.value);
                });
            }
        });

        document.getElementById('bulkDelete').addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.agent-checkbox:checked');
            if (checkedBoxes.length > 0 && confirm(`Delete ${checkedBoxes.length} selected agents? This action cannot be undone.`)) {
                checkedBoxes.forEach(checkbox => {
                    deleteAgent(checkbox.value);
                });
            }
        });

        // Add new agent
        document.getElementById('addAgentBtn').addEventListener('click', function() {
            alert('Add new agent form would open here.');
        });

        // Pagination
        document.querySelectorAll('.pagination-button').forEach(button => {
            button.addEventListener('click', function() {
                if (!this.classList.contains('active') && !isNaN(this.textContent)) {
                    document.querySelectorAll('.pagination-button').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });

        // Modal actions
        document.getElementById('modalVerify').addEventListener('click', function() {
            alert('Agent verified from modal!');
            closeModalFunc();
        });

        document.getElementById('modalSuspend').addEventListener('click', function() {
            alert('Agent suspended from modal!');
            closeModalFunc();
        });

        // Sidebar navigation
        document.querySelectorAll('.sidebar-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                const pageName = this.textContent.trim();
                
                if (pageName === 'Logout') {
                    alert('Logging out...');
                } else if (pageName === 'Dashboard') {
                    alert('Navigating to Dashboard...');
                } else if (pageName !== 'Manage Agents') {
                    alert(`Navigating to: ${pageName}`);
                }
            });
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9771fde2e0d3f7f3',t:'MTc1NjUzMjgzMC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
