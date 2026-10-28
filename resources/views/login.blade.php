<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Login - BRACU Social</title>
    <!-- Nunito Sans: one font family only across the entire site -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,400;0,6..12,600;0,6..12,700;1,6..12,400;1,6..12,600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-page: #F5F3EA;
            --surface-card: #FFFFFF;
            --text-primary: #30352D;
            --text-secondary: #646A60;
            --border: #E5E5DA;
            --bg-hover: #F5F3EA;
            --header-bg: #91A77C;
            --primary: #526747;
            --primary-hover: #435639;
            --destructive: #8C3B32;
            --radius-card: 10px;
            --radius-ctrl: 8px;
            --shadow-card: 0 1px 2px rgba(48,53,45,.06);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg-page: #1A1D17;
                --surface-card: #23271F;
                --text-primary: #E8E8DD;
                --text-secondary: #A4A99A;
                --border: #34382E;
                --bg-hover: #2C3025;
                --header-bg: #3A4A33;
                --primary: #91A77C;
                --primary-hover: #A0B68B;
                --destructive: #E0A196;
                --shadow-card: none;
            }
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            transition: none !important;
            animation: none !important;
        }

        body {
            font-family: 'Nunito Sans', system-ui, Arial, sans-serif;
            font-size: 15px;
            line-height: 1.6;
            color: var(--text-primary);
            background-color: var(--bg-page);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
        }

        .auth-container {
            width: 100%;
            max-width: 440px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .auth-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 8px;
        }

        .logo-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background-color: var(--primary);
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 4px;
        }

        h1 {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .auth-subtitle {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .auth-card {
            background-color: var(--surface-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-card);
            padding: 32px 24px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
        }

        input {
            font-family: 'Nunito Sans', system-ui, Arial, sans-serif;
            font-size: 15px;
            color: var(--text-primary);
            background-color: var(--surface-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-ctrl);
            padding: 10px 14px;
            width: 100%;
        }

        input:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
            border-color: var(--primary);
        }

        .error-message {
            background-color: var(--destructive);
            color: #FFFFFF;
            padding: 8px 12px;
            border-radius: var(--radius-ctrl);
            font-size: 13px;
            font-weight: 600;
        }

        .btn-submit {
            font-family: 'Nunito Sans', system-ui, Arial, sans-serif;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 16px;
            border-radius: var(--radius-ctrl);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            background-color: var(--primary);
            color: #FFFFFF;
            border: 1px solid transparent;
            width: 100%;
            margin-top: 8px;
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
        }

        .auth-footer {
            text-align: center;
            font-size: 14px;
            color: var(--text-secondary);
        }

        .auth-footer a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <div class="logo-box">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
            </div>
            <h1>BRACU Social</h1>
            <div class="auth-subtitle">Sign in to connect with campus peers.</div>
        </div>

        <div class="auth-card">
            <h2 style="font-size: 18px; font-weight: 600;">Welcome back</h2>

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="/login" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
                @csrf
                <div class="form-group">
                    <label for="email">Campus Email</label>
                    <input type="email" name="email" id="email" placeholder="name@g.bracu.ac.bd" required value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="btn-submit">Login</button>
            </form>
        </div>

        <div class="auth-footer">
            Don’t have an account? <a href="/">Register here</a>
        </div>
    </div>
</body>
</html>
