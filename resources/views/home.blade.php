<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="C:\Program Files\php\bracu_social\resources\css\app.css">
    <title>SIGN Up - COSMO CONNECT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
:root {
    --primary-color: #6366f1;
    --primary-dark: #4f46e5;
    --secondary-color: #8b5cf6;
    --accent-color: #06b6d4;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --text-primary: #ffffff;
    --text-secondary: #e2e8f0;
    --text-muted: #94a3b8;
    --bg-primary: rgba(15, 23, 42, 0.95);
    --bg-secondary: rgba(30, 41, 59, 0.8);
    --bg-card: rgba(51, 65, 85, 0.6);
    --border-color: rgba(148, 163, 184, 0.2);
    --shadow-light: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --shadow-heavy: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --gradient-space: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
}

/* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: var(--bg-primary);
    color: var(--text-primary);
    line-height: 1.6;
    overflow-x: hidden;
    position: relative;
    max-width: 100vw;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 20px;
}

/* Stunning Space Background */
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(2px 2px at 20px 30px, #eee, transparent),
        radial-gradient(2px 2px at 40px 70px, rgba(255,255,255,0.8), transparent),
        radial-gradient(1px 1px at 90px 40px, #fff, transparent),
        radial-gradient(1px 1px at 130px 80px, rgba(255,255,255,0.6), transparent),
        radial-gradient(2px 2px at 160px 30px, #ddd, transparent),
        linear-gradient(45deg, #0f172a 0%, #1e293b 25%, #334155 50%, #475569 75%, #64748b 100%);
    background-size: 200px 200px, 300px 300px, 150px 150px, 250px 250px, 180px 180px, 100% 100%;
    animation: space-float 20s ease-in-out infinite;
    z-index: -1;
}

/* Floating Particles */
body::after {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(1px 1px at 25% 25%, rgba(255,255,255,0.8), transparent),
        radial-gradient(1px 1px at 75% 75%, rgba(255,255,255,0.6), transparent),
        radial-gradient(1px 1px at 50% 10%, rgba(255,255,255,0.4), transparent),
        radial-gradient(1px 1px at 10% 50%, rgba(255,255,255,0.3), transparent),
        radial-gradient(1px 1px at 90% 20%, rgba(255,255,255,0.5), transparent);
    background-size: 400px 400px, 300px 300px, 500px 500px, 600px 600px, 350px 350px;
    animation: particle-float 30s linear infinite;
    z-index: -1;
    opacity: 0.6;
}

@keyframes particle-float {
    0% { transform: translateY(0px) rotate(0deg); }
    100% { transform: translateY(-100px) rotate(360deg); }
}

@keyframes space-float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(1deg); }
}

/* Main Title */
h1 {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 3rem;
    font-weight: 800;
    background: var(--gradient-space);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 0 30px rgba(99, 102, 241, 0.5);
    letter-spacing: -0.02em;
    position: relative;
    animation: titleGlow 3s ease-in-out infinite alternate;
    margin-bottom: 10px;
    text-align: center;
}

@keyframes titleGlow {
    0% {
        filter: drop-shadow(0 0 20px rgba(99, 102, 241, 0.3));
    }
    100% {
        filter: drop-shadow(0 0 30px rgba(99, 102, 241, 0.6));
    }
}

h2 {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-secondary);
    text-align: center;
    margin-bottom: 30px;
}

/* Register Form */
.register-form {
    background: var(--bg-card);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 30px;
    width: 100%;
    max-width: 400px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    box-shadow: var(--shadow-medium);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.register-form:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-heavy);
    border-color: rgba(99, 102, 241, 0.4);
}

.register-form::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--gradient-primary);
}

.register-form input {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 15px 20px;
    color: var(--text-primary);
    font-size: 1rem;
    width: 100%;
    box-sizing: border-box;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.register-form input::placeholder {
    color: var(--text-muted);
}

.register-form input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-1px);
}

.register-form button {
    background: var(--gradient-primary);
    color: var(--text-primary);
    border: none;
    padding: 15px 20px;
    border-radius: 12px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: var(--shadow-light);
}

.register-form button:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

.register-form button::before {
    content: '🚀';
    font-size: 1.1em;
}

.login-link {
    margin-top: 25px;
    text-align: center;
    background: var(--bg-card);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 20px;
    box-shadow: var(--shadow-light);
}

.login-link p {
    margin: 0;
    font-size: 1rem;
    color: var(--text-secondary);
}

.login-link a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
}

.login-link a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -2px;
    left: 0;
    background: var(--gradient-primary);
    transition: width 0.3s ease;
}

.login-link a:hover::after {
    width: 100%;
}

.login-link a:hover {
    color: var(--text-primary);
    transform: translateY(-1px);
}

/* Responsive Design */
@media (max-width: 768px) {
    body {
        padding: 15px;
    }
    
    h1 {
        font-size: 2.5rem;
    }
    
    .register-form {
        padding: 25px;
        max-width: 100%;
    }
}

@media (max-width: 480px) {
    h1 {
        font-size: 2rem;
    }
    
    .register-form {
        padding: 20px;
    }
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: var(--bg-primary);
}

::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--primary-dark);
}

/* Focus States for Accessibility */
button:focus,
input:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

/* Selection Styling */
::selection {
    background: var(--primary-color);
    color: white;
}

::-moz-selection {
    background: var(--primary-color);
    color: white;
}
</style>
<body>
    <h1>COSMO CONNECT</h1>
    <h2>Register</h2>
    <form action="/register" method="POST" class="register-form">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="department" placeholder="Department (Minimum length 3)" required>
        
        <input type="text" name="student_id" placeholder="Student ID (Minimum length 8)" required>
        <input type="password" name="password" placeholder="Password (Minimum length 5)" required>

        <button type="submit">Register</button>
    </form>
    
    <div class="login-link">
        <p>Already have an account? <a href="/login">Login here</a></p>
    </div>
</body>
</html>