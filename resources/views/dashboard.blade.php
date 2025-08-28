<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BRACU Social</title>
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
        background: #c2cfe4;
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

    .logo {
        font-size: 18px;
        font-weight: 700;
        color: #2d3748;
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

    /* Create Post Section */
    .create-post-section {
        background: #ffffff;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.04);
        border: 1px solid #e8ecf0;
    }

    .create-post-section h2 {
        color: #1a1a1a;
        margin-bottom: 20px;
        font-size: 20px;
        font-weight: 600;
    }

    .create-post-form {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .create-post-form input[type="text"] {
        padding: 16px 20px;
        border: 2px solid #e8ecf0;
        border-radius: 12px;
        font-size: 16px;
        font-family: inherit;
        transition: all 0.2s ease;
        background: #fafbfc;
    }

    .create-post-form input[type="text"]:focus {
        outline: none;
        border-color: #0073e6;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(0, 115, 230, 0.1);
    }

    .create-post-form textarea {
        padding: 16px 20px;
        border: 2px solid #e8ecf0;
        border-radius: 12px;
        font-size: 16px;
        min-height: 120px;
        resize: vertical;
        font-family: inherit;
        transition: all 0.2s ease;
        background: #fafbfc;
    }

    .create-post-form textarea:focus {
        outline: none;
        border-color: #0073e6;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(0, 115, 230, 0.1);
    }

    .create-post-form button {
        background: #0073e6;
        color: #fff;
        border: none;
        padding: 16px 32px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        align-self: flex-start;
        box-shadow: 0 2px 8px rgba(0, 115, 230, 0.2);
    }

    .create-post-form button:hover {
        background: #005bb5;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 115, 230, 0.3);
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

    /* Responsive Design */
    @media (max-width: 1024px) {
        .container {
            grid-template-columns: 1fr;
            gap: 20px;
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
            gap: 15px;
            text-align: center;
            padding: 20px;
        }
        
        .welcome {
            font-size: 24px;
        }
        
        .create-post-section, .user-card {
            padding: 20px;
        }
        
        .post-content {
            padding: 20px;
        }
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
                            <a href="#" class="nav-link">Exchange</a>
                            <a href="#" class="nav-link">Lost&Found</a>
                        </div>
                    </div>
                    <a href="/logout" class="logout-btn">Logout</a>
                </div>
            </div>

            <!-- Create Post Section -->
            <div class="create-post-section">
                <h2>Create a new post</h2>
                <form action="/create-post" method="post" class="create-post-form">
                    @csrf
                    <input type="text" name="title" placeholder="What's on your mind?" required>
                    <textarea name="body" placeholder="Share your thoughts..."></textarea>
                    <button type="submit">Post</button>
                </form>
            </div>

            <!-- Posts Feed -->
            <div class="posts-feed">
                <div class="feed-header">
                    <h2>Recent Posts</h2>
                </div>
                
                @foreach ($posts as $post)
                <div class="post-card">
                    <div class="post-content">
                        <div class="post-header">
                            <div class="post-author">{{$post->user->name}}</div>
                            <div class="post-time">{{$post->created_at->format('M j, Y \a\t g:i A')}}</div>
                        </div>
                        <h3 class="post-title">{{$post->title}}</h3>
                        <div class="post-body">{{$post->body}}</div>
                    </div>
                    <div class="edit-btn">
                        <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
                    </div>
                    <form action="/delete-post/{{$post->id}}" method="post" class="del-post">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
                @endforeach
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