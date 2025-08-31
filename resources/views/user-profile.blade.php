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
        width: 100%;
        max-width: 100%;
        overflow: hidden;
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
        width: 100%;
        max-width: 100%;
        overflow: hidden;
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

    /* Lost & Found Badge Styles */
    .lost-found-badge {
        background: linear-gradient(135deg, #ff9500, #ff6b35);
        color: white;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        font-size: 14px;
        position: relative;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .badge-icon {
        font-size: 16px;
    }

    .resolved-badge {
        background: #10b981;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 4px;
        animation: fadeIn 0.3s ease;
    }

    .resolved-icon {
        font-size: 14px;
        font-weight: bold;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.8); }
        to { opacity: 1; transform: scale(1); }
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

        /* Poll Display Styles */
        .poll-section {
            margin-top: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
            border: 1px solid #e8ecf0;
        }

        .poll-question {
            margin-bottom: 16px;
        }

        .poll-question h4 {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .poll-type-badge {
            background: #0073e6;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
        }

        .poll-voting-form {
            margin-top: 16px;
        }

        .poll-options {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 16px;
        }

        .poll-option-label {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: white;
            border: 2px solid #e8ecf0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .poll-option-label:hover {
            border-color: #0073e6;
            background: #f0f8ff;
        }

        .poll-option-label input[type="radio"],
        .poll-option-label input[type="checkbox"] {
            margin: 0;
            width: 18px;
            height: 18px;
            accent-color: #0073e6;
        }

        .vote-btn {
            background: #0073e6;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .vote-btn:hover {
            background: #0056b3;
            transform: translateY(-1px);
        }

        .poll-results {
            margin-top: 16px;
        }

        .poll-option-result {
            margin-bottom: 16px;
            padding: 16px;
            background: white;
            border-radius: 8px;
            border: 1px solid #e8ecf0;
        }

        .poll-option-header {
            margin-bottom: 8px;
        }

        .poll-option-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .poll-option-text {
            font-weight: 500;
            color: #1a1a1a;
        }

        .poll-option-votes {
            font-size: 14px;
            color: #6b7280;
        }

        .poll-progress-bar {
            width: 100%;
            height: 8px;
            background: #e8ecf0;
            border-radius: 4px;
            overflow: hidden;
        }

        .poll-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #0073e6, #0056b3);
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .your-vote-indicator {
            color: #10b981;
            font-size: 14px;
            font-weight: 600;
            margin-top: 8px;
        }

        .poll-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e8ecf0;
            font-size: 14px;
            color: #6b7280;
        }

        .remove-vote-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .remove-vote-btn:hover {
            background: #5a6268;
        }

        .delete-poll-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .delete-poll-btn:hover {
            background: #c82333;
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 15px;
            }
            
            .sidebar {
                position: static;
            }
            
            .nav-bar {
                flex-direction: column;
                gap: 15px;
                padding: 15px 20px;
            }
            
            .main-title {
                font-size: 28px;
                margin: 15px 0;
            }
            
            .profile-details {
                gap: 20px;
            }
            
            .post-content {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }
            
            .nav-links {
                gap: 15px;
            }
            
            .nav-link {
                font-size: 14px;
            }
            
            .profile-header {
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
