<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $user->name }}'s Profile - COSMO CONNECT</title>
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

/* Container Layout */
.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
    display: grid;
    grid-template-columns: minmax(0, 1fr) 350px;
    gap: 30px;
    min-height: 100vh;
    overflow-x: hidden;
    box-sizing: border-box;
}

/* Main Content Area */
.main-content {
    display: flex;
    flex-direction: column;
    gap: 30px;
    max-width: 100%;
    overflow-x: hidden;
    min-width: 0;
}

/* Header Section */
.header {
    background: var(--bg-card);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 25px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: var(--shadow-medium);
    position: relative;
    overflow: hidden;
}

.header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--gradient-primary);
}

.main-title {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 2.5rem;
    font-weight: 800;
    background: var(--gradient-space);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 0 30px rgba(99, 102, 241, 0.5);
    letter-spacing: -0.02em;
    position: relative;
    animation: titleGlow 3s ease-in-out infinite alternate;
}

@keyframes titleGlow {
    0% {
        filter: drop-shadow(0 0 20px rgba(99, 102, 241, 0.3));
    }
    100% {
        filter: drop-shadow(0 0 30px rgba(99, 102, 241, 0.6));
    }
}

.nav-bar {
    display: flex;
    align-items: center;
    gap: 20px;
}

.nav-links {
    display: flex;
    gap: 15px;
}

.nav-link {
    color: var(--text-secondary);
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 12px;
    transition: all 0.3s ease;
    font-weight: 500;
    position: relative;
    overflow: hidden;
}

.nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: var(--gradient-primary);
    transition: left 0.3s ease;
    z-index: -1;
}

.nav-link:hover::before {
    left: 0;
}

.nav-link:hover {
    color: var(--text-primary);
    transform: translateY(-2px);
}

.logout-btn {
    background: var(--gradient-secondary);
    color: var(--text-primary);
    text-decoration: none;
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: var(--shadow-light);
}

.logout-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

.logout-btn::before {
    content: '🚪';
    font-size: 1.1em;
}

/* Back Button */
.back-btn {
    background: var(--gradient-primary);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 12px;
    cursor: pointer;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-block;
    margin-bottom: 20px;
    box-shadow: var(--shadow-light);
}

.back-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

/* User Profile Header */
.profile-header {
    background: var(--bg-card);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 30px;
    box-shadow: var(--shadow-medium);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.profile-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--gradient-secondary);
}

.profile-avatar {
    width: 100px;
    height: 100px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 36px;
    font-weight: 600;
    color: white;
    box-shadow: var(--shadow-medium);
    border: 3px solid var(--border-color);
}

.profile-name {
    font-size: 28px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 8px;
    text-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
}

.profile-details {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 20px;
    flex-wrap: wrap;
}

.profile-detail {
    text-align: center;
    padding: 15px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    border: 1px solid var(--border-color);
    min-width: 120px;
}

.profile-detail-label {
    font-size: 12px;
    font-weight: 500;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.profile-detail-value {
    font-size: 16px;
    font-weight: 600;
    color: var(--text-primary);
}

/* Posts Feed */
.posts-feed {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.feed-header {
    background: var(--bg-card);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 25px;
    box-shadow: var(--shadow-medium);
    position: relative;
    overflow: hidden;
}

.feed-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--gradient-primary);
}

.feed-header h2 {
    color: var(--text-primary);
    font-size: 1.8rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
}

.feed-header h2::before {
    content: '📰';
    font-size: 1.2em;
}

/* Post Card */
.post-card {
    background: var(--bg-card);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 25px;
    box-shadow: var(--shadow-light);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    max-width: 100%;
    box-sizing: border-box;
}

.post-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-medium);
    border-color: rgba(99, 102, 241, 0.3);
}

.post-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--gradient-primary);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.post-card:hover::before {
    opacity: 1;
}

/* Lost & Found Badge */
.lost-found-badge {
    background: linear-gradient(135deg, #1e3a8a, #3730a3);
    color: #e0e7ff;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(30, 58, 138, 0.3);
    border: 1px solid rgba(30, 58, 138, 0.4);
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.lost-found-badge::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.lost-found-badge:hover::before {
    left: 100%;
}

.lost-found-badge:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-heavy);
    border-color: rgba(139, 92, 246, 0.5);
}

.badge-icon {
    font-size: 1.2em;
    filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.3));
}

.resolved-badge {
    background: linear-gradient(135deg, #0f766e, #134e4a);
    color: #a7f3d0;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.75rem;
    margin-left: 10px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    border: 1px solid rgba(15, 118, 110, 0.4);
    box-shadow: 0 2px 8px rgba(15, 118, 110, 0.3);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.resolved-badge:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(15, 118, 110, 0.4);
    border-color: rgba(15, 118, 110, 0.6);
}

.resolved-icon {
    font-size: 1.1em;
    filter: drop-shadow(0 0 4px rgba(255, 255, 255, 0.3));
}

/* Post Content */
.post-content {
    max-width: 100%;
    word-wrap: break-word;
    overflow-wrap: break-word;
    overflow-x: hidden;
}

/* Post Header */
.post-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    max-width: 100%;
    flex-wrap: wrap;
    gap: 10px;
}

.post-author {
    font-weight: 600;
    color: var(--primary-color);
    font-size: 1.1rem;
    max-width: 100%;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.post-time {
    color: var(--text-muted);
    font-size: 0.9rem;
    max-width: 100%;
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: nowrap;
}

/* Post Content */
.post-title {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: var(--text-primary);
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
    max-width: 100%;
    line-height: 1.4;
}

.post-image {
    margin: 20px 0;
    text-align: center;
}

.post-image-content {
    max-width: 100%;
    max-height: 400px;
    border-radius: 12px;
    box-shadow: var(--shadow-light);
}

.post-body {
    font-size: 1rem;
    line-height: 1.7;
    color: var(--text-secondary);
    margin-bottom: 20px;
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
    max-width: 100%;
}

/* Poll Section */
.poll-section {
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 16px;
    padding: 20px;
    margin: 20px 0;
}

.poll-question h4 {
    color: var(--secondary-color);
    margin-bottom: 15px;
    font-size: 1.1rem;
}

.poll-type-badge {
    background: var(--secondary-color);
    color: white;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 0.8rem;
    margin-left: 10px;
}

.poll-options {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 15px;
}

.poll-option-label {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.poll-option-label:hover {
    background: rgba(255, 255, 255, 0.15);
}

.poll-option-text {
    color: var(--text-secondary);
    font-weight: 500;
}

.vote-btn {
    background: var(--secondary-color);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease;
}

.vote-btn:hover {
    background: #7c3aed;
    transform: translateY(-1px);
}

/* Poll Results */
.poll-results {
    margin-top: 20px;
}

.poll-option-result {
    margin-bottom: 15px;
}

.poll-option-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.poll-option-stats {
    color: var(--text-muted);
    font-size: 0.9rem;
}

.poll-progress-bar {
    width: 100%;
    height: 8px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 8px;
}

.poll-progress-fill {
    height: 100%;
    background: var(--gradient-primary);
    border-radius: 4px;
    transition: width 0.3s ease;
}

.your-vote-indicator {
    color: var(--success-color);
    font-size: 0.9rem;
    font-weight: 500;
}

.poll-stats {
    color: var(--text-muted);
    font-size: 0.9rem;
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid var(--border-color);
}

.remove-vote-btn,
.delete-poll-btn {
    background: var(--danger-color);
    color: white;
    border: none;
    border-radius: 6px;
    padding: 6px 12px;
    cursor: pointer;
    font-size: 0.8rem;
    transition: all 0.3s ease;
}

.remove-vote-btn:hover,
.delete-poll-btn:hover {
    background: #dc2626;
    transform: translateY(-1px);
}

/* No Posts Message */
.no-posts {
    background: var(--bg-card);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 40px;
    box-shadow: var(--shadow-medium);
    text-align: center;
    color: var(--text-muted);
    position: relative;
    overflow: hidden;
}

.no-posts::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--gradient-primary);
}

.no-posts h3 {
    font-size: 18px;
    margin-bottom: 8px;
    color: var(--text-secondary);
}

.no-posts p {
    font-size: 14px;
}

/* Sidebar */
.sidebar {
    display: flex;
    flex-direction: column;
    gap: 25px;
    position: sticky;
    top: 20px;
    height: fit-content;
}

/* User Card */
.user-card {
    background: var(--bg-card);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 25px;
    box-shadow: var(--shadow-medium);
    position: relative;
    overflow: hidden;
}

.user-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--gradient-secondary);
}

.user-card h3 {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 8px;
}

.user-card h3::before {
    content: '👤';
    font-size: 1.1em;
}

.user-info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid var(--border-color);
}

.user-info-item:last-child {
    border-bottom: none;
}

.user-info-label {
    color: var(--text-muted);
    font-weight: 500;
    font-size: 0.9rem;
}

.user-info-value {
    color: var(--text-primary);
    font-weight: 600;
    font-size: 0.9rem;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .container {
        grid-template-columns: 1fr;
        gap: 20px;
        max-width: 100%;
        overflow-x: hidden;
    }
    
    .sidebar {
        position: static;
        order: -1;
    }
}

@media (max-width: 768px) {
    .container {
        padding: 15px;
    }
    
    .header {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    
    .main-title {
        font-size: 2rem;
    }
    
    .nav-bar {
        flex-direction: column;
        gap: 15px;
    }
    
    .profile-details {
        gap: 20px;
    }
    
    .post-content {
        padding: 20px;
    }
}

@media (max-width: 480px) {
    .main-title {
        font-size: 1.8rem;
    }
    
    .profile-header,
    .post-card,
    .user-card {
        padding: 20px;
    }
    
    .profile-details {
        flex-direction: column;
        gap: 15px;
    }
    
    .post-content {
        padding: 15px;
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
input:focus,
textarea:focus,
a:focus {
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
    <div class="container">
        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <div class="main-title">COSMO CONNECT</div>
                <div class="nav-bar">
                    <div class="nav-links">
                        <a href="/dashboard" class="nav-link">Home</a>
                        <a href="/profile" class="nav-link">My Profile</a>
                    </div>
                    <a href="/logout" class="logout-btn">Logout</a>
                </div>
            </div>

            <!-- Back Button -->
            <a href="/dashboard" class="back-btn">← Back to Dashboard</a>

            <!-- User Profile Header -->
            <div class="profile-header">
                <div class="profile-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h1 class="profile-name">{{ $user->name }}</h1>
                <div class="profile-details">
                    <div class="profile-detail">
                        <div class="profile-detail-label">Department</div>
                        <div class="profile-detail-value">{{ $user->department }}</div>
                    </div>
                    <div class="profile-detail">
                        <div class="profile-detail-label">Student ID</div>
                        <div class="profile-detail-value">{{ $user->student_id }}</div>
                    </div>
                    <div class="profile-detail">
                        <div class="profile-detail-label">Posts</div>
                        <div class="profile-detail-value">{{ $posts->count() }}</div>
                    </div>
                </div>
            </div>

            <!-- Posts Feed -->
            <div class="posts-feed">
                <div class="feed-header">
                    <h2>{{ $user->name }}'s Posts</h2>
                </div>
                
                @if($posts->count() > 0)
                    @foreach ($posts as $post)
                    <div class="post-card">
                        @if($post->lost_and_found)
                        <div class="lost-found-badge">
                            <span class="badge-icon">🔍</span>
                            Lost & Found
                            @if($post->resolved)
                            <span class="resolved-badge">
                                <span class="resolved-icon">✓</span>
                                Resolved
                            </span>
                            @endif
                        </div>
                        @endif
                        <div class="post-content">
                                                    <div class="post-header">
                            <div class="post-author">{{ $user->name }}</div>
                            <div class="post-time">{{ $post->created_at->format('M j, Y \a\t g:i A') }}</div>
                        </div>
                        
                        @if($post->title)
                        <h3 class="post-title">{{ $post->title }}</h3>
                        @endif
                        
                        @if($post->image)
                        <div class="post-image">
                            <img src="{{ asset($post->image) }}" alt="Post Image" class="post-image-content">
                        </div>
                        @endif
                        
                        @if($post->body)
                        <div class="post-body">{{ $post->body }}</div>
                        @endif
                        
                        @if($post->poll)
                        <!-- Poll Section -->
                        <div class="poll-section">
                            <div class="poll-question">
                                <h4>{{ $post->poll->question }}</h4>
                                @if($post->poll->multiple_choice)
                                <span class="poll-type-badge">Multiple Choice</span>
                                @endif
                            </div>
                            
                            @if($post->poll->hasUserVoted(auth()->id()))
                                <!-- Show Results -->
                                <div class="poll-results">
                                    @foreach($post->poll->options as $option)
                                    <div class="poll-option-result">
                                        <div class="poll-option-header">
                                            <div class="poll-option-stats">
                                                <span class="poll-option-text">{{ $option->option_text }}</span>
                                                <span class="poll-option-votes">{{ $option->votes_count }} votes</span>
                                            </div>
                                            <div class="poll-progress-bar">
                                                <div class="poll-progress-fill" style="width: {{ $option->percentage }}%"></div>
                                            </div>
                                        </div>
                                        @if($post->poll->getUserVotedOptions(auth()->id())->contains($option->id))
                                        <div class="your-vote-indicator">✓ Your choice</div>
                                        @endif
                                    </div>
                                    @endforeach
                                    <div class="poll-stats">
                                        <span>Total votes: {{ $post->poll->total_votes }}</span>
                                        <form action="/polls/{{ $post->poll->id }}/vote" method="post" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="remove-vote-btn">Remove my vote</button>
                                        </form>
                                        @if(auth()->user()->id == $post->user_id)
                                        <form action="/polls/{{ $post->poll->id }}/delete" method="post" style="display: inline; margin-left: 12px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-poll-btn" onclick="return confirm('Are you sure you want to delete this poll?')">🗑️ Delete Poll</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <!-- Show Voting Interface -->
                                <form action="/polls/{{ $post->poll->id }}/vote" method="post" class="poll-voting-form">
                                    @csrf
                                    <div class="poll-options">
                                                                                    @if($post->poll->multiple_choice)
                                            @foreach($post->poll->options as $option)
                                            <label class="poll-option-label">
                                                <input type="checkbox" name="option_ids[]" value="{{ $option->id }}">
                                                <span>{{ $option->option_text }}</span>
                                            </label>
                                            @endforeach
                                        @else
                                            @foreach($post->poll->options as $option)
                                            <label class="poll-option-label">
                                                <input type="radio" name="option_ids[]" value="{{ $option->id }}">
                                                <span>{{ $option->option_text }}</span>
                                            </label>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button type="submit" class="vote-btn">Cast Vote</button>
                                </form>
                            @endif
                        </div>
                        @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="no-posts">
                        <h3>No posts yet</h3>
                        <p>{{ $user->name }} hasn't shared any posts yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="user-card">
                <h3>Account Info</h3>
                <div class="user-info-item">
                    <div class="user-info-label">Name</div>
                    <div class="user-info-value">{{ auth()->user()->name }}</div>
                </div>
                <div class="user-info-item">
                    <div class="user-info-label">Email</div>
                    <div class="user-info-value">{{ auth()->user()->email }}</div>
                </div>
                <div class="user-info-item">
                    <div class="user-info-label">Department</div>
                    <div class="user-info-value">{{ auth()->user()->department }}</div>
                </div>
                <div class="user-info-item">
                    <div class="user-info-label">Student ID</div>
                    <div class="user-info-value">{{ auth()->user()->student_id }}</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
