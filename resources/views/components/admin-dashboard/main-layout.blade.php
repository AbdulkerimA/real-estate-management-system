<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - AnchorHomes</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/admin-style/main-layout.css','resources/js/admin-js/main-layout.js']) 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        
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
<body class="bg-[#12181f] text-white overflow-x-hidden">
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
    <div class="sidebar bg-[#1c252e] border-r border-gray-700 flex flex-col" id="sidebar">
        <!-- Logo -->
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center">
                {{-- <div class="w-12 h-12 bg-[#00ff88] rounded-xl flex items-center justify-center mr-3">
                    <svg class="w-7 h-7 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                </div> --}}
                <div>
                    <span class="text-xl font-bold text-[#00ff88]">AnchorHomes</span>
                    <p class="text-xs text-gray-400">Admin Panel</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4">
            <ul class="space-y-2">

                <x-agent-dashboard.side-bar-buttons 
                    href="/admin" 
                    title="Dashboard" 
                    class="{{ request()->is('admin') ? 'active' : '' }}" 
                    >
                    
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </x-agent-dashboard.side-bar-buttons>

                <x-agent-dashboard.side-bar-buttons 
                    href="/admin/properties" 
                    title="Manage Properties" 
                    class="{{ request()->is('admin/properties*') ? 'active' : '' }}" 
                    >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </x-agent-dashboard.side-bar-buttons>

                <x-agent-dashboard.side-bar-buttons 
                    href="/admin/agents" 
                    title="Manage Agents" 
                    class="{{ request()->is('admin/agents*') ? 'active' : '' }}" 
                    >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </x-agent-dashboard.side-bar-buttons>

                <x-agent-dashboard.side-bar-buttons 
                    href="/admin/customers" 
                    title="Manage Customers" 
                    class="{{ request()->is('admin/customers*') ? 'active' : '' }}" 
                    >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </x-agent-dashboard.side-bar-buttons>

                 <x-agent-dashboard.side-bar-buttons 
                    href="/admin/transactions" 
                    title="Payments & Transactions" 
                    class="{{ request()->is('admin/transaction') ? 'active' : '' }}" 
                    >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </x-agent-dashboard.side-bar-buttons>

                <x-agent-dashboard.side-bar-buttons 
                    href="/admin/analytics" 
                    title=" Reports & Analytics" 
                    class="{{ request()->is('admin/analytics') ? 'active' : '' }}" 
                    >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </x-agent-dashboard.side-bar-buttons>
                
                <x-agent-dashboard.side-bar-buttons    
                    href="/admin/settings" 
                    title="Setting" 
                    class="{{ request()->is('admin/settings') ? 'active' : '' }}" 
                    >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                </x-agent-dashboard.side-bar-buttons>
            </ul>
        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-gray-700">
            <a href="#" class="sidebar-item flex items-center px-4 py-3 rounded-xl text-gray-300 hover:text-red-400">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <button type="submit" form="logout" class="font-medium">Logout</button>
            </a>
            <form action="/logout" method="post" id="logout" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content relative z-10">
        <!-- Top Bar -->
        <x-admin-dashboard.main-header />
       
        {{ $slot }}
        <!-- Dashboard Content -->
        {{-- <div class="p-6 space-y-6">
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
                            <p class="text-3xl font-bold text-[#00ff88] counter" data-target="1247">0</p>
                            <p class="text-green-400 text-sm">↗ +12% from last month</p>
                        </div>
                        <div class="w-12 h-12 bg-[#00ff88] bg-opacity-20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Verified Agents</p>
                            <p class="text-3xl font-bold text-[#00ff88] counter" data-target="89">0</p>
                            <p class="text-green-400 text-sm">↗ +5% from last month</p>
                        </div>
                        <div class="w-12 h-12 bg-[#00ff88] bg-opacity-20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Active Buyers</p>
                            <p class="text-3xl font-bold text-[#00ff88] counter" data-target="2156">0</p>
                            <p class="text-green-400 text-sm">↗ +18% from last month</p>
                        </div>
                        <div class="w-12 h-12 bg-[#00ff88] bg-opacity-20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Revenue</p>
                            <p class="text-3xl font-bold text-[#00ff88]">₹12.4M</p>
                            <p class="text-green-400 text-sm">↗ +24% from last month</p>
                        </div>
                        <div class="w-12 h-12 bg-[#00ff88] bg-opacity-20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <button class="action-button w-full py-3 rounded-lg text-[#12181f] font-semibold flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add New Property
                        </button>
                        
                        <button class="action-button w-full py-3 rounded-lg text-[#12181f] font-semibold flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Verify Agent
                        </button>
                        
                        <button class="action-button w-full py-3 rounded-lg text-[#12181f] font-semibold flex items-center justify-center">
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
                                    <button class="text-[#00ff88] hover:text-green-400 text-sm">View</button>
                                </td>
                            </tr>
                            <tr class="table-row border-b border-gray-700">
                                <td class="py-3 px-4 text-white">Jan 15, 2025</td>
                                <td class="py-3 px-4 text-white">David Wilson</td>
                                <td class="py-3 px-4 text-white">Commercial Space - CMC</td>
                                <td class="py-3 px-4 text-white">₹5,00,000</td>
                                <td class="py-3 px-4"><span class="status-badge status-pending">Pending</span></td>
                                <td class="py-3 px-4">
                                    <button class="text-[#00ff88] hover:text-green-400 text-sm">View</button>
                                </td>
                            </tr>
                            <tr class="table-row border-b border-gray-700">
                                <td class="py-3 px-4 text-white">Jan 14, 2025</td>
                                <td class="py-3 px-4 text-white">Sarah Johnson</td>
                                <td class="py-3 px-4 text-white">Villa - Kazanchis</td>
                                <td class="py-3 px-4 text-white">₹8,75,000</td>
                                <td class="py-3 px-4"><span class="status-badge status-paid">Paid</span></td>
                                <td class="py-3 px-4">
                                    <button class="text-[#00ff88] hover:text-green-400 text-sm">View</button>
                                </td>
                            </tr>
                            <tr class="table-row border-b border-gray-700">
                                <td class="py-3 px-4 text-white">Jan 14, 2025</td>
                                <td class="py-3 px-4 text-white">Ahmed Hassan</td>
                                <td class="py-3 px-4 text-white">Land Plot - Lebu</td>
                                <td class="py-3 px-4 text-white">₹1,20,000</td>
                                <td class="py-3 px-4"><span class="status-badge status-failed">Failed</span></td>
                                <td class="py-3 px-4">
                                    <button class="text-[#00ff88] hover:text-green-400 text-sm">View</button>
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
        </div> --}}

        <!-- Footer -->
        <footer class="bg-[#1c252e] border-t border-gray-700 p-4 text-center">
            <p class="text-gray-400 text-sm">© 2025 Property Sales System</p>
        </footer>
    </div>

    <script>

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
        // const earningsCtx = document.getElementById('earningsChart').getContext('2d');
        // new Chart(earningsCtx, {
        //     type: 'line',
        //     data: {
        //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        //         datasets: [{
        //             label: 'Revenue (₹ Lakhs)',
        //             data: [85, 92, 78, 105, 98, 112, 125, 118, 135, 142, 128, 155],
        //             borderColor: '#00ff88',
        //             backgroundColor: 'rgba(0, 255, 136, 0.1)',
        //             tension: 0.4,
        //             fill: true
        //         }]
        //     },
        //     options: chartOptions
        // });

        // Property Sales Chart
        // const propertySalesCtx = document.getElementById('propertySalesChart').getContext('2d');
        // new Chart(propertySalesCtx, {
        //     type: 'bar',
        //     data: {
        //         labels: ['Apartments', 'Houses', 'Commercial', 'Land'],
        //         datasets: [{
        //             label: 'Sales Count',
        //             data: [456, 234, 123, 89],
        //             backgroundColor: [
        //                 'rgba(0, 255, 136, 0.8)',
        //                 'rgba(0, 255, 136, 0.6)',
        //                 'rgba(0, 255, 136, 0.4)',
        //                 'rgba(0, 255, 136, 0.2)'
        //             ],
        //             borderColor: '#00ff88',
        //             borderWidth: 1
        //         }]
        //     },
        //     options: chartOptions
        // });

        // Agent Performance Chart
        // const agentPerformanceCtx = document.getElementById('agentPerformanceChart').getContext('2d');
        // new Chart(agentPerformanceCtx, {
        //     type: 'doughnut',
        //     data: {
        //         labels: ['Sara Tadesse', 'Michael Johnson', 'Aisha Mohammed', 'David Wilson', 'Others'],
        //         datasets: [{
        //             data: [25, 20, 18, 15, 22],
        //             backgroundColor: [
        //                 '#00ff88',
        //                 '#00cc6a',
        //                 '#00aa55',
        //                 '#008844',
        //                 '#006633'
        //             ],
        //             borderWidth: 0
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         plugins: {
        //             legend: {
        //                 position: 'right',
        //                 labels: {
        //                     color: '#9ca3af',
        //                     usePointStyle: true,
        //                     padding: 20
        //                 }
        //             }
        //         }
        //     }
        // });

        // // Search functionality
        // const globalSearch = document.getElementById('globalSearch');
        // const transactionSearch = document.getElementById('transactionSearch');

        // globalSearch.addEventListener('input', function() {
        //     // Implement global search logic
        //     console.log('Searching for:', this.value);
        // });

        // transactionSearch.addEventListener('input', function() {
        //     // Implement transaction search logic
        //     console.log('Searching transactions for:', this.value);
        // });

        // Quick action buttons
        document.querySelectorAll('.action-button').forEach(button => {
            button.addEventListener('click', function() {
                const action = this.textContent.trim();
                alert(`${action} functionality would be implemented here.`);
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
</body>
</html>
