<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Bancaire - @yield('title')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Helvetica Neue', Arial, sans-serif;
            background-color: #050505 !important;
            color: white;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Background Animé */
        .gradient-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .gradient-sphere {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.7;
        }

        .sphere-1 {
            width: 40vw;
            height: 40vw;
            background: linear-gradient(40deg, rgba(255, 0, 128, 0.8), rgba(255, 102, 0, 0.4));
            top: -10%;
            left: -10%;
            animation: float-1 15s ease-in-out infinite alternate;
        }

        .sphere-2 {
            width: 45vw;
            height: 45vw;
            background: linear-gradient(240deg, rgba(72, 0, 255, 0.8), rgba(0, 183, 255, 0.4));
            bottom: -20%;
            right: -10%;
            animation: float-2 18s ease-in-out infinite alternate;
        }

        .sphere-3 {
            width: 30vw;
            height: 30vw;
            background: linear-gradient(120deg, rgba(133, 89, 255, 0.5), rgba(98, 216, 249, 0.3));
            top: 60%;
            left: 20%;
            animation: float-3 20s ease-in-out infinite alternate;
        }

        .noise-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.05;
            z-index: -1;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
            pointer-events: none;
        }

        @keyframes float-1 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(10%, 10%) scale(1.1); }
        }

        @keyframes float-2 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-10%, -5%) scale(1.15); }
        }

        @keyframes float-3 {
            0% { transform: translate(0, 0) scale(1); opacity: 0.3; }
            100% { transform: translate(-5%, 10%) scale(1.05); opacity: 0.6; }
        }

        .grid-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            z-index: -1;
            pointer-events: none;
        }

        .glow {
            position: fixed;
            width: 40vw;
            height: 40vh;
            background: radial-gradient(circle, rgba(72, 0, 255, 0.15), transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            animation: pulse 8s infinite alternate;
            filter: blur(30px);
            pointer-events: none;
        }

        @keyframes pulse {
            0% { opacity: 0.3; transform: translate(-50%, -50%) scale(0.9); }
            100% { opacity: 0.7; transform: translate(-50%, -50%) scale(1.1); }
        }

        .particles-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: white;
            border-radius: 50%;
            opacity: 0;
            pointer-events: none;
        }

        /* Navigation */
        .navbar-custom {
            background: rgba(10, 10, 10, 0.9) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #ff3a82 !important;
        }

        /* Contenu principal */
        .main-content {
            position: relative;
            z-index: 10;
            min-height: calc(100vh - 76px);
            padding: 20px;
        }

        /* Cartes avec transparence */
        .card-custom {
            background: rgba(30, 30, 30, 0.8) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 15px;
        }

        .table-custom {
            background: rgba(40, 40, 40, 0.7) !important;
            color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .table-custom th {
            background: rgba(255, 58, 130, 0.3) !important;
            border-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .table-custom td {
            border-color: rgba(255, 255, 255, 0.1);
            background: rgba(50, 50, 50, 0.5) !important;
            color: white;
        }

        /* Formulaires */
        .form-control, .form-select {
            background: rgba(30, 30, 30, 0.8) !important;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white !important;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(40, 40, 40, 0.8) !important;
            border-color: #ff3a82;
            color: white !important;
            box-shadow: 0 0 0 0.2rem rgba(255, 58, 130, 0.25);
        }

        .form-label {
            color: white;
            font-weight: 500;
        }

        /* Boutons */
        .btn {
            border-radius: 8px;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Background Animé -->
    <div class="gradient-background">
        <div class="gradient-sphere sphere-1"></div>
        <div class="gradient-sphere sphere-2"></div>
        <div class="gradient-sphere sphere-3"></div>
        <div class="glow"></div>
        <div class="grid-overlay"></div>
        <div class="noise-overlay"></div>
        <div class="particles-container" id="particles-container"></div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-university me-2"></i>Gestion Bancaire
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="color: white;">☰</span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clients.index') }}">
                            <i class="fas fa-users me-1"></i>Clients
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('comptes.index') }}">
                            <i class="fas fa-credit-card me-1"></i>Comptes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('virements.index') }}">
                            <i class="fas fa-exchange-alt me-1"></i>Virements
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu Principal -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script des particules -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const particlesContainer = document.getElementById('particles-container');
            const particleCount = 50;
            
            // Créer les particules
            for (let i = 0; i < particleCount; i++) {
                createParticle();
            }
            
            function createParticle() {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Taille aléatoire
                const size = Math.random() * 3 + 1;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Position initiale
                resetParticle(particle);
                
                particlesContainer.appendChild(particle);
                
                // Animer
                animateParticle(particle);
            }
            
            function resetParticle(particle) {
                const posX = Math.random() * 100;
                const posY = Math.random() * 100;
                
                particle.style.left = `${posX}%`;
                particle.style.top = `${posY}%`;
                particle.style.opacity = '0';
                
                return { x: posX, y: posY };
            }
            
            function animateParticle(particle) {
                const pos = resetParticle(particle);
                const duration = Math.random() * 10 + 10;
                const delay = Math.random() * 5;
                
                setTimeout(() => {
                    particle.style.transition = `all ${duration}s linear`;
                    particle.style.opacity = Math.random() * 0.2 + 0.1;
                    
                    const moveX = pos.x + (Math.random() * 20 - 10);
                    const moveY = pos.y - Math.random() * 30;
                    
                    particle.style.left = `${moveX}%`;
                    particle.style.top = `${moveY}%`;
                    
                    setTimeout(() => {
                        animateParticle(particle);
                    }, duration * 1000);
                }, delay * 1000);
            }

            // Interaction souris
            document.addEventListener('mousemove', (e) => {
                const mouseX = (e.clientX / window.innerWidth) * 100;
                const mouseY = (e.clientY / window.innerHeight) * 100;
                
                // Créer une particule temporaire
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                const size = Math.random() * 4 + 2;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                particle.style.left = `${mouseX}%`;
                particle.style.top = `${mouseY}%`;
                particle.style.opacity = '0.4';
                
                particlesContainer.appendChild(particle);
                
                setTimeout(() => {
                    particle.style.transition = 'all 1.5s ease-out';
                    particle.style.left = `${mouseX + (Math.random() * 10 - 5)}%`;
                    particle.style.top = `${mouseY + (Math.random() * 10 - 5)}%`;
                    particle.style.opacity = '0';
                    
                    setTimeout(() => {
                        if (particle.parentNode) {
                            particle.remove();
                        }
                    }, 1500);
                }, 10);
            });
        });
    </script>

    @yield('scripts')
</body>
</html>