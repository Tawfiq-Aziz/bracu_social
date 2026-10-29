<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - BRACU Social</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,400;6..12,600;6..12,700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            transition: none !important;
            animation: none !important;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Nunito Sans', system-ui, sans-serif;
            font-size: 14px;
            color: #1a1a1a;
            background: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Outer wrapper — fills viewport, centers the card */
        .page-center {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 32px;
        }

        /* The centered window/card */
        .auth-window {
            display: flex;
            width: 100%;
            max-width: 1060px;
            height: 660px;
            overflow: hidden;
            border-radius: 6px;
            box-shadow: 0 4px 32px rgba(0,0,0,.12);
        }

        /* ── Left: form panel ── */
        .form-side {
            width: 48%;
            background: #fff;
            display: flex;
            align-items: center;
            padding: 44px 64px;
            flex-shrink: 0;
        }

        .form-inner {
            width: 100%;
            max-width: 300px;
        }

        /* Brand name above heading */
        .brand-name {
            font-size: 13px;
            font-weight: 700;
            color: #526747;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        /* Heading */
        .form-title {
            font-size: 22px;
            font-weight: 700;
            color: #111;
            margin-bottom: 18px;
        }

        /* Error */
        .error-box {
            background: #FEF2F2;
            border: 1px solid #FCA5A5;
            color: #B91C1C;
            padding: 9px 13px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        /* Fields */
        .field {
            margin-bottom: 10px;
        }

        .field label, label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            display: block;
            width: 100%;
            font-family: inherit;
            font-size: 13px;
            color: #222;
            background: #fff;
            border: 1px solid #DDD;
            border-radius: 7px;
            padding: 8px 12px;
        }

        input::placeholder { color: #BBB; }

        input:focus {
            outline: none;
            border-color: #526747;
            box-shadow: 0 0 0 2px rgba(82,103,71,.12);
        }

        /* Submit button */
        .btn-primary {
            display: block;
            width: 100%;
            padding: 10px;
            background: #4A6040;
            color: #fff;
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            border: none;
            border-radius: 7px;
            cursor: pointer;
        }

        .btn-primary:hover { background: #3A4F31; }

        /* Divider */
        .divider {
            text-align: center;
            font-size: 12px;
            color: #BBB;
            margin: 14px 0;
        }

        /* OAuth row */
        .oauth-row {
            display: flex;
            justify-content: center;
            margin-bottom: 16px;
        }

        .btn-oauth {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 8px 20px;
            border: 1px solid #E0E0E0;
            border-radius: 7px;
            background: #fff;
            color: #333;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-oauth:hover { background: #F7F7F7; }

        /* Footer */
        .foot {
            text-align: center;
            font-size: 13px;
            color: #888;
        }

        .foot a {
            color: #2563EB;
            font-weight: 700;
            text-decoration: none;
        }

        /* ── Right: photo panel ── */
        .photo-side {
            flex: 1;
            padding: 0;
            min-width: 0;
        }

        .photo-side img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0;
        }

        /* ── Responsive ── */
        @media (max-width: 740px) {
            .photo-side { display: none; }
            .form-side { width: 100%; }
            .auth-window { height: auto; }
        }

        @media (max-width: 480px) {
            .form-side { padding: 36px 28px; }
            .oauth-row { flex-direction: column; }
            .page-center { padding: 24px 16px; }
        }
    </style>
</head>
<body>
    <div class="page-center">
        <div class="auth-window">

            <!-- Left: Form -->
            <div class="form-side">
                <div class="form-inner">
                    <p class="brand-name">BRACU Social</p>
                    <h1 class="form-title">Get Started Now</h1>

                    @if ($errors->any())
                        <div class="error-box">{{ $errors->first() }}</div>
                    @endif

                    <form action="/register" method="POST">
                        @csrf

                        <div class="field">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name"
                                   placeholder="Enter your name"
                                   value="{{ old('name') }}" required>
                        </div>

                        <div class="field">
                            <label for="email">Email address</label>
                            <input type="email" name="email" id="email"
                                   placeholder="Enter your email"
                                   value="{{ old('email') }}" required>
                        </div>

                        <div class="field">
                            <label for="student_id">Student ID</label>
                            <input type="text" name="student_id" id="student_id"
                                   placeholder="e.g. 22301267"
                                   value="{{ old('student_id') }}" required>
                        </div>

                        <div class="field">
                            <label for="department">Department</label>
                            <input type="text" name="department" id="department"
                                   placeholder="e.g. CSE, EEE, BBA"
                                   value="{{ old('department') }}" required>
                        </div>

                        <div class="field">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"
                                   placeholder="Minimum 5 characters" required>
                        </div>

                        <button type="submit" class="btn-primary" style="margin-top: 8px;">Signup</button>
                    </form>

                    <div class="divider">Or</div>

                    <div class="oauth-row">
                        <a href="/auth/google" class="btn-oauth">
                            <svg width="15" height="15" viewBox="0 0 48 48" fill="none">
                                <path d="M43.6 20.1H42V20H24v8h11.3C33.7 32.7 29.3 35 24 35c-6.1 0-11-4.9-11-11s4.9-11 11-11c2.8 0 5.3 1 7.2 2.7l5.7-5.7C33.2 7.3 28.8 5 24 5 13.5 5 5 13.5 5 24s8.5 19 19 19c10.5 0 19-8.5 19-19 0-1.3-.1-2.5-.4-3.9z" fill="#FFC107"/>
                                <path d="M6.3 14.7l6.6 4.8C14.7 16.1 19 13 24 13c2.8 0 5.3 1 7.2 2.7l5.7-5.7C33.2 7.3 28.8 5 24 5c-7.7 0-14.3 4.3-17.7 9.7z" fill="#FF3D00"/>
                                <path d="M24 43c4.7 0 9-1.7 12.3-4.5l-6.2-5.2C28.3 34.7 26.2 35 24 35c-5.3 0-9.6-3.3-11.3-7.9l-6.5 5C9.5 38.6 16.3 43 24 43z" fill="#4CAF50"/>
                                <path d="M43.6 20.1H42V20H24v8h11.3a11.5 11.5 0 0 1-3.9 5.3l6.2 5.2C37.4 40.2 43 36 43 24c0-1.3-.1-2.5-.4-3.9z" fill="#1976D2"/>
                            </svg>
                            Sign in with Google
                        </a>
                    </div>

                    <div class="foot">
                        Have an account? <a href="/login">Sign In</a>
                    </div>
                </div>
            </div>

            <!-- Right: Photo -->
            <div class="photo-side">
                <img src="/images/leaf.jpg" alt="Monstera leaf">
            </div>

        </div>
    </div>
</body>
</html>
