<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AnchorHomes</title>
     <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/auth.css','resources/js/auth.js'])
     <style>
        @keyframes slideDownFade {
            0%   { transform: translateY(-100%); opacity: 0; }
            10%  { transform: translateY(0); opacity: 1; }
            80%  { transform: translateY(0); opacity: 1; }
            100% { transform: translateY(-100%); opacity: 0; }
        }

        .animate-slideDownFade {
            animation: slideDownFade 3s ease-in-out forwards;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape">
            <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <rect width="100" height="100" fill="#00ff88" rx="20"/>
            </svg>
        </div>
        <div class="shape">
            <svg width="80" height="80" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
                <circle cx="40" cy="40" r="40" fill="#00ff88"/>
            </svg>
        </div>
        <div class="shape">
            <svg width="120" height="120" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
                <polygon points="60,10 110,90 10,90" fill="#00ff88"/>
            </svg>
        </div>
    </div>

    {{-- error display box --}}
    @error('error')
        <div id="error-message" 
        class="fixed top-0 right-0 flex justify-evenly items-center bg-red-400/10 text-red-500 text-md font-semibold px-4 py-2 m-2 border border-red-600 rounded-2xl shadow-lg z-50">
        <i class="fa fa-exclamation-triangle text-xl mx-2" aria-hidden="true"></i>
        <p class="mx-2" id="error-text">
            {{ 
                $message
            }}
        </p>
        <button onclick="hideError()" class="px-2 rounded bg-red-200 mx-2 text-xl">
            <i class="fa fa-times text-red-500" aria-hidden="true"></i>
        </button>
    </div>
    @enderror


    <div class="w-full max-w-md relative z-10">
        <!-- Header with Logo -->
        <div class="text-center mb-8">
            {{-- <h1 class="text-5xl font-bold text-[#00ff88] mb-2">AnchorHomes</h1> --}}
        </div>

        <!-- Login Card -->
        <div class="login-card rounded-3xl p-8 shadow-2xl">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-white mb-2">Login to Your Account</h2>
                <p class="text-gray-400">Welcome back! Please enter your details</p>
            </div>

            <!-- Login Form -->
            <form action="/login" method="POST" class="space-y-6" id="login-form">
                @csrf
                <!-- Email/Username Field -->
                <div>
                    <x-form.lable for="email">
                        Email or Username
                    </x-form.lable>
                    
                    <div class="relative">
                        <x-form.input 
                            type="text" 
                            id="email" 
                            name="email"
                            placeholder="Enter your email or username"
                        />
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <x-form.lable for="password">
                        Password
                    </x-form.lable>
                    <div class="relative">
                        <x-form.input 
                            type="password" 
                            id="password" 
                            name="password"
                            placeholder="Enter your password"
                        />
                        <button 
                            type="button" 
                            class="absolute inset-y-0 right-0 pr-4 flex items-center"
                            id="toggle-password"
                        >
                            <svg class="w-5 h-5 text-gray-400 hover:text-accent-green transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            class="w-4 h-4 text-accent-green bg-dark-secondary border-gray-600 rounded focus:ring-accent-green focus:ring-2"
                            id="remember-me"
                        >
                        <span class="ml-2 text-sm text-gray-300">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-[#00ff88] hover:text-green-400 transition-colors" id="forgot-password">
                        Forgot Password?
                    </a>
                </div>

                <!-- Login Button -->
                <button 
                    type="submit" 
                    class="login-btn w-full py-4 px-6 text-dark-secondary font-semibold rounded-xl focus:outline-none focus:ring-2 focus:ring-accent-green focus:ring-offset-2 focus:ring-offset-dark-primary"
                >
                    Login
                </button>
            </form>

            <!-- Divider -->
            <div class="my-4">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center z-0 w-full">
                        <div class="w-full border-t border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm z-10">
                        <span class="px-4 bg-dark-primary text-gray-400 w-fit login-card">Or continue with</span>
                    </div>
                </div>
            </div>

            <!-- Social Login Buttons -->
            <div class="space-y-4">
                <!-- Google Login -->
                <x-form.oauth  id="google-login">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Continue with Google
                </x-form.oauth>

                <!-- Facebook Login -->
                <x-form.oauth id="facebook-login" class="bg-blue-500">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Continue with Facebook
                </x-form.oauth>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-gray-400">
                Don't have an account? 
                <x-nav.link href="/signup" class="text-accent-green hover:text-green-400 font-semibold transition-colors">
                    Sign Up
                </x-nav.link>
            </p>
        </div>
    </div>
</body>
</html>
