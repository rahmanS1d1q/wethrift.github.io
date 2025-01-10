<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeThrift - Modern Shopping Experience</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #00B4DB, #0083B0);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .container {
            text-align: center;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .animated-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, 
                rgba(255,255,255,0.1) 25%, 
                transparent 25%, 
                transparent 50%, 
                rgba(255,255,255,0.1) 50%, 
                rgba(255,255,255,0.1) 75%, 
                transparent 75%, 
                transparent);
            background-size: 100px 100px;
            animation: moveBackground 15s linear infinite;
            z-index: 0;
        }

        @keyframes moveBackground {
            0% { background-position: 0 0; }
            100% { background-position: 100px 100px; }
        }

        .logo {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeInDown 0.8s ease forwards;
        }

        .subtitle {
            font-size: 1.5rem;
            margin-bottom: 3rem;
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeInDown 0.8s ease 0.2s forwards;
        }

        .roles {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .role-btn {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1rem 2rem;
            border-radius: 12px;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease forwards;
        }

        .role-btn:nth-child(1) { animation-delay: 0.4s; }
        .role-btn:nth-child(2) { animation-delay: 0.6s; }
        .role-btn:nth-child(3) { animation-delay: 0.8s; }

        .role-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .role-btn i {
            font-size: 1.2rem;
        }

        .home-btn {
            background: rgba(255, 255, 255, 0.9);
            color: #0083B0;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            opacity: 0;
            animation: fadeInUp 0.8s ease 1s forwards;
        }

        .home-btn:hover {
            background: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 1rem;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            opacity: 0;
            animation: fadeIn 0.8s ease 1.2s forwards;
        }

        .social-links {
            margin-top: 0.5rem;
        }

        .social-links a {
            color: white;
            text-decoration: none;
            margin: 0 0.5rem;
            font-size: 1.2rem;
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            opacity: 1;
            transform: translateY(-3px);
        }

        @keyframes fadeInDown {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .logo {
                font-size: 2.5rem;
            }

            .subtitle {
                font-size: 1.2rem;
            }

            .roles {
                flex-direction: column;
                gap: 1rem;
            }

            .role-btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Interactive Particles */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="animated-background"></div>
    <div class="particles" id="particles"></div>

    <div class="container">
        <h1 class="logo">Welcome To WeThrift</h1>
        <h2 class="subtitle">Choose your experience</h2>

        <div class="roles">
            <a href="./customer_mode/customer_login.php" class="role-btn">
                <i class="fas fa-shopping-bag"></i>
                Customer Portal
            </a>
            <a href="./admin_mode/admin_login.php" class="role-btn">
                <i class="fas fa-user-shield"></i>
                Admin Dashboard
            </a>
            <a href="./agent_mode/delivery_login.php" class="role-btn">
                <i class="fas fa-truck"></i>
                Delivery Partner
            </a>
        </div>

        <a href="./index.php" class="home-btn">
            <i class="fas fa-home"></i>
            Return Home
        </a>
    </div>

    <footer>
        <div>© 2025 WeThrift | Rahman Shiddiq</div>
        <div class="social-links">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/6281913868745" target="_blank"><i class="fab fa-whatsapp"></i></a>
        </div>
    </footer>

    <script>
        // Interactive Particles Animation
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Random size between 2-6px
                const size = Math.random() * 4 + 2;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Random position
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                
                // Random animation
                const duration = Math.random() * 20 + 10;
                particle.style.animation = `float ${duration}s linear infinite`;
                
                particlesContainer.appendChild(particle);
            }
        }

        // Add floating animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes float {
                0% {
                    transform: translateY(0) translateX(0);
                    opacity: 0;
                }
                50% {
                    opacity: 0.8;
                }
                100% {
                    transform: translateY(-100vh) translateX(${Math.random() * 200 - 100}px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Initialize particles
        createParticles();

        // Add hover effect sound
        const buttons = document.querySelectorAll('.role-btn, .home-btn');
        buttons.forEach(button => {
            button.addEventListener('mouseover', () => {
                button.style.transform = 'translateY(-5px)';
            });
            button.addEventListener('mouseout', () => {
                button.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>