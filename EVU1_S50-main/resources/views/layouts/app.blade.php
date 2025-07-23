<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/modern-app.css') }}?v={{ time() }}&cache={{ rand(1000, 9999) }}" rel="stylesheet">
    <script src="{{ asset('assets/js/notifications.js') }}" defer></script>
    <style>
        /* NAVEGACIÓN GLASSMORPHISM DIRECTA */
        .glassmorphism-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 15px 0;
        }
        
        .glassmorphism-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .glassmorphism-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .glassmorphism-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .glassmorphism-logo {
            width: 40px;
            height: 40px;
            border-radius: 8px;
        }
        
        .glassmorphism-text {
            color: white;
            font-size: 1.4rem;
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
        }
        
        .glassmorphism-menu {
            display: flex;
            gap: 10px;
        }
        
        .glassmorphism-link {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 10px 16px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .glassmorphism-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }
        
        .glassmorphism-icon {
            font-size: 1.1rem;
        }
        
        .glassmorphism-toggle {
            display: none;
        }
        
        body {
            padding-top: 80px;
        }
        
        @media (max-width: 768px) {
            .glassmorphism-menu {
                display: none;
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(15px);
                flex-direction: column;
                padding: 20px;
                gap: 10px;
            }
            
            .glassmorphism-menu.active {
                display: flex;
            }
            
            .glassmorphism-toggle {
                display: block;
                background: rgba(255, 255, 255, 0.1);
                border: none;
                color: white;
                padding: 8px;
                border-radius: 6px;
            }
            
            .glassmorphism-link {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <!-- NAVEGACIÓN GLASSMORPHISM SIMPLE -->
    <nav class="glassmorphism-nav">
        <div class="glassmorphism-container">
            <div class="glassmorphism-content">
                <div class="glassmorphism-brand">
                    <img class="glassmorphism-logo" src="{{ asset('assets/img/Tech-solutions-Logo-23.png') }}" alt="Logo">
                    <span class="glassmorphism-text">Tech Solutions</span>
                </div>
                
                <div class="glassmorphism-menu" id="navMenu">
                    <a href="#" class="glassmorphism-link">
                        <span class="glassmorphism-icon">📋</span>
                        <span>Lista de Proyectos</span>
                    </a>
                    <a href="#" class="glassmorphism-link">
                        <span class="glassmorphism-icon">➕</span>
                        <span>Crear Proyecto</span>
                    </a>
                    <a href="#" class="glassmorphism-link">
                        <span class="glassmorphism-icon">💰</span>
                        <span>Valor UF</span>
                    </a>
                </div>

                <button class="glassmorphism-toggle" onclick="toggleMenu()">☰</button>
            </div>
        </div>
    </nav>
    
    <script>
        function toggleMenu() {
            document.getElementById('navMenu').classList.toggle('active');
        }
    </script>

    <x-get-uf />


    <h1 class="text-center mt-4 text-primary-emphasis">Bienvenido a Tech Solutions</h1>
    <main class="container py-4">@yield('content')</main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 Tech Solutions. Todos los derechos reservados.</p>
    </footer>

    <!-- Sistema de Notificaciones -->
    <div id="notification-container"></div>

    <script src="{{ asset('assets/js/uf.js') }}"></script>
    <script src="{{ asset('assets/js/notifications.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/navigation.js') }}?v={{ time() }}"></script>

    @if(session('notification'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notification = @json(session('notification'));
            setTimeout(() => {
                notificationSystem.show(
                    notification.message,
                    notification.type,
                    {
                        title: notification.title,
                        duration: notification.duration || 4000,
                        sound: notification.sound || false
                    }
                );
            }, 100);
        });
    </script>
    @endif

    @yield('scripts')

</body>

</html>
