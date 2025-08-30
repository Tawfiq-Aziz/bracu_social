<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $user->name }}'s Profile - BRACU Social</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #b9d1ca;
        color: #1a1a1a;
        line-height: 1.6;
        min-height: 100vh;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 30px;
        min-height: 100vh;
    }

    .main-content {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 20px;
        position: sticky;
        top: 20px;
        height: fit-content;
    }

    /* Header Section */
    .header {
        background: #ffffff;
        padding: 0;
        border-radius: 0;
        box-shadow: none;
        border: none;
        margin-bottom: 20px;
    }

    .main-title {
        font-size: 32px;
        font-weight: 700;
        color: #2d3748;
        text-align: center;
        margin: 20px 0;
        letter-spacing: -0.5px;
    }

    .nav-bar {
        background: #ffffff;
        padding: 15px 30px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .nav-left {
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .nav-links {
        display: flex;
        gap: 25px;
    }

    .nav-link {
        color: #4a5568;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .nav-link:hover {
        color: #2d3748;
    }

    .logout-btn {
        background: #2d3748;
        color: #ff6b35;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .logout-btn:hover {
        background: #1a202c;
        transform: translateY(-1px);
    }

    /* User Profile Header */
    .profile-header {
        background: #ffffff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.04);
        border: 1px solid #e8ecf0;
        text-align: center;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        background: #0073e6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 32px;
        font-weight: 600;
        color: white;
    }

    .profile-name {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
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
    }

    .profile-detail-label {
        font-size: 12px;
        font-weight: 500;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .profile-detail-value {
        font-size: 14px;
        font-weight: 600;
        color: #1a1a1a;
    }

    /* Posts Feed */
    .posts-feed {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .feed-header {
        background: #ffffff;
        padding: 20px 25px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.04);
        border: 1px solid #e8ecf0;
    }

    .feed-header h2 {
        color: #1a1a1a;
        font-size: 20px;
        font-weight: 600;
    }

    /* Individual Post Cards */
    .post-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.04);
        border: 1px solid #e8ecf0;
        overflow: hidden;
        transition: all 0.2s ease;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }

    .post-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }

    .post-content {
        padding: 24px;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        overflow: hidden;
    }

    .post-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .post-author {
        font-size: 14px;
        font-weight: 600;
        color: #0073e6;
    }

    .post-time {
        font-size: 12px;
        color: #6b7280;
    }

    .post-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 12px;
        line-height: 1.4;
        word-wrap: break-word;
        word-break: break-word;
        overflow-wrap: break-word;
        max-width: 100%;
    }

    .post-body {
        font-size: 16px;
        color: #4a5568;
        line-height: 1.6;
        word-wrap: break-word;
        word-break: break-word;
        overflow-wrap: break-word;
        white-space: pre-wrap;
        max-width: 100%;
    }

    /* Post Image Styles */
    .post-image {
        margin: 16px 0;
        text-align: center;
    }

    .post-image-content {
        max-width: 100%;
        max-height: 400px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: transform 0.2s ease;
    }

    .post-image-content:hover {
        transform: scale(1.02);
    }

    /* Back Button */
    .back-btn {
        background: #0073e6;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s ease;
        display: inline-block;
        margin-bottom: 20px;
    }

    .back-btn:hover {
        background: #0056b3;
        transform: translateY(-1px);
    }

    /* No Posts Message */
    .no-posts {
        background: #ffffff;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.04);
        border: 1px solid #e8ecf0;
        text-align: center;
        color: #6b7280;
    }

    .no-posts h3 {
        font-size: 18px;
        margin-bottom: 8px;
        color: #4a5568;
    }

    .no-posts p {
        font-size: 14px;
    }

    /* Sidebar User Info */
    .user-card {
        background: #ffffff;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.04);
        border: 1px solid #e8ecf0;
    }

    .user-card h3 {
        color: #1a1a1a;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        text-align: center;
    }

    .user-info-item {
        display: flex;
        flex-direction: column;
        margin-bottom: 16px;
        padding: 12px 0;
        border-bottom: 1px solid #f1f3f4;
    }

    .user-info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .user-info-label {
        font-size: 12px;
        font-weight: 500;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .user-info-value {
        font-size: 14px;
        font-weight: 500;
        color: #1a1a1a;
    }
</style>
<body>
    <div class="container">
        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <div class="main-title">BRACU SOCIAL</div>
                <div class="nav-bar">
                    <div class="nav-left">
                        <div class="nav-links">
                            <a href="/dashboard" class="nav-link">Home</a>
                            <a href="/profile" class="nav-link">My Profile</a>
                        </div>
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
                        <div class="post-content">
                            <div class="post-header">
                                <div class="post-author">{{ $user->name }}</div>
                                <div class="post-time">{{ $post->created_at->format('M j, Y \a\t g:i A') }}</div>
                            </div>
                            <h3 class="post-title">{{ $post->title }}</h3>
                            @if($post->image)
                            <div class="post-image">
                                <img src="{{ asset($post->image) }}" alt="Post Image" class="post-image-content">
                            </div>
                            @endif
                            <div class="post-body">{{ $post->body }}</div>
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
                <h3>Your Profile</h3>
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
