<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $user->name }} - BRACU Social</title>
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
            --header-hover: #82996C;
            --primary: #526747;
            --primary-hover: #435639;
            --active-tint: #E9EEE1;
            --radius-card: 10px;
            --radius-ctrl: 8px;
            --radius-pill: 999px;
            --shadow-card: 0 1px 2px rgba(48,53,45,.06);
            --header-height: 64px;
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
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        header.site-header {
            position: sticky;
            top: 0;
            z-index: 100;
            height: var(--header-height);
            background-color: var(--header-bg);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-box {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background-color: var(--primary);
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .main-container {
            max-width: 800px;
            width: 100%;
            margin: 24px auto;
            padding: 0 16px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .card {
            background-color: var(--surface-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-card);
            padding: 24px;
        }

        .avatar {
            border-radius: 50%;
            background-color: var(--primary);
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            user-select: none;
            flex-shrink: 0;
        }

        .avatar.lg {
            width: 88px;
            height: 88px;
            font-size: 32px;
        }

        .avatar.sm {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }

        .profile-card-header {
            display: flex;
            align-items: flex-start;
            gap: 24px;
        }

        .profile-card-details {
            flex: 1;
        }

        .profile-display-name {
            font-size: 24px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .profile-meta-line {
            font-size: 14px;
            color: var(--text-secondary);
            margin: 4px 0 12px 0;
        }

        .profile-bio {
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: var(--radius-ctrl);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .btn-primary {
            background-color: var(--primary);
            color: #FFFFFF;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-secondary {
            background-color: var(--surface-card);
            border-color: var(--border);
            color: var(--text-primary);
        }

        .btn-sm {
            padding: 4px 12px;
            font-size: 13px;
        }

        .post-card {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .post-header-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .post-author-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .post-meta-line {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .post-title {
            font-size: 18px;
            font-weight: 600;
            line-height: 1.4;
        }

        .post-body {
            font-size: 15px;
            line-height: 1.6;
            white-space: pre-wrap;
        }

        .post-image-wrap {
            width: 100%;
            max-height: 420px;
            overflow: hidden;
            border-radius: var(--radius-ctrl);
            border: 1px solid var(--border);
        }

        .post-image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .empty-state {
            padding: 40px 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 16px;
            color: var(--text-secondary);
        }

        @media (max-width: 600px) {
            .profile-card-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .profile-display-name {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <a href="/dashboard" class="header-left">
            <div class="logo-box">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
            </div>
            <div class="logo-title">BRACU Social</div>
        </a>
        <div style="display: flex; gap: 10px;">
            <a href="/dashboard" class="btn btn-secondary btn-sm">Home</a>
            <a href="/logout" class="btn btn-secondary btn-sm">Logout</a>
        </div>
    </header>

    <div class="main-container">
        <!-- User Profile Card -->
        <div class="card">
            <div class="profile-card-header">
                <div class="avatar lg">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                <div class="profile-card-details">
                    <div class="profile-display-name">
                        {{ $user->name }}
                        @if(auth()->id() == $user->id)
                            <span style="font-size: 15px; font-weight: 400; color: var(--text-secondary);">(you)</span>
                        @endif
                    </div>
                    <div class="profile-meta-line">
                        {{ $user->department }} · ID {{ $user->student_id }}
                    </div>
                    <div class="profile-bio">
                        {{ $user->email }}
                    </div>
                    @if(auth()->id() != $user->id)
                        <a href="/dashboard" class="btn btn-primary btn-sm">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                            Message
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div>
            <h2 style="font-size: 18px; font-weight: 600; margin-bottom: 4px;">{{ $user->name }}’s posts</h2>
            <div class="text-muted" style="margin-bottom: 16px;">Contributions and discussions.</div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 24px;">
            @forelse ($posts as $post)
                <article class="card post-card">
                    <div class="post-header-row">
                        <div class="post-author-wrap">
                            <div class="avatar sm">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                            <div>
                                <div style="font-weight: 600;">{{ $user->name }}</div>
                                <div class="post-meta-line">{{ $post->created_at->format('M j, Y') }}</div>
                            </div>
                        </div>
                    </div>

                    @if($post->title)
                        <h3 class="post-title">{{ $post->title }}</h3>
                    @endif

                    @if($post->body)
                        <div class="post-body">{{ $post->body }}</div>
                    @endif

                    @if($post->image)
                        <div class="post-image-wrap">
                            <img src="{{ asset($post->image) }}" alt="Post Image">
                        </div>
                    @endif
                </article>
            @empty
                <div class="card empty-state">
                    <svg width="120" height="72" viewBox="0 0 120 72" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M0 48 Q45 28 90 42 Q110 46 120 52 L120 72 L0 72 Z" fill="#D5DEC8" />
                        <path d="M0 58 Q35 44 80 52 Q105 56 120 64 L120 72 L0 72 Z" fill="#91A77C" />
                        <polygon points="24,30 18,48 30,48" fill="#526747" />
                        <polygon points="36,24 28,45 44,45" fill="#526747" />
                        <polygon points="76,28 70,47 82,47" fill="#526747" />
                        <polygon points="90,34 84,50 96,50" fill="#526747" />
                        <path d="M48 72 C50 64 54 58 58 52 C62 58 66 64 68 72 Z" fill="#F5F3EA" />
                    </svg>
                    <div style="font-size: 14px;">No public posts yet.</div>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>
