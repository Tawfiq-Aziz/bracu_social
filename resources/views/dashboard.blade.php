<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    .post-buttons {
        display: flex;
        gap: 12px;
        align-self: flex-start;
    }

    .create-post-form button {
        background: #1d1f20;
        color: #ff6b35;
        border: none;
        padding: 16px 32px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0, 115, 230, 0.2);
    }

    .create-post-form button:hover {
        background: #276eb4;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 115, 230, 0.3);
    }

    .anonymous-btn {
        background: #6c757d !important;
        color: white !important;
    }

    .anonymous-btn:hover {
        background: #5a6268 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3) !important;
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

    /* Post Action Buttons */
    .post-actions {
        display: flex;
        gap: 12px;
        padding: 16px 24px;
        border-top: 1px solid #f1f3f4;
        background: #fafbfc;
    }

    .interaction-buttons {
        display: flex;
        gap: 8px;
        margin-bottom: 12px;
    }

    .interaction-btn {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        padding: 8px 12px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .interaction-btn:hover {
        background: #e9ecef;
        transform: translateY(-1px);
    }

    .interaction-btn.active {
        background: #0073e6;
        color: white;
        border-color: #0073e6;
    }

    .interaction-btn.dislike.active {
        background: #dc3545;
        border-color: #dc3545;
    }

    .interaction-count {
        font-size: 12px;
        color: #6c757d;
        margin-left: 4px;
    }

    .comment-section {
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid #e9ecef;
    }

    .comment-form {
        display: flex;
        gap: 8px;
        margin-bottom: 12px;
    }

    .comment-input {
        flex: 1;
        padding: 8px 12px;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        font-size: 14px;
        resize: none;
        min-height: 36px;
        max-height: 100px;
    }

    .comment-input:focus {
        outline: none;
        border-color: #0073e6;
        box-shadow: 0 0 0 2px rgba(0, 115, 230, 0.1);
    }

    .comment-btn {
        background: #0073e6;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .comment-btn:hover {
        background: #0056b3;
    }

    .comments-list {
        max-height: 200px;
        overflow-y: auto;
    }

    .comment-item {
        padding: 8px 0;
        border-bottom: 1px solid #f1f3f4;
    }

    .comment-item:last-child {
        border-bottom: none;
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 4px;
    }

    .comment-author {
        font-size: 12px;
        font-weight: 600;
        color: #0073e6;
    }

    .comment-time {
        font-size: 11px;
        color: #6c757d;
    }

    .comment-text {
        font-size: 14px;
        color: #495057;
        line-height: 1.4;
    }

    .show-comments-btn {
        background: none;
        border: none;
        color: #0073e6;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        padding: 4px 0;
        transition: color 0.2s ease;
    }

    .show-comments-btn:hover {
        color: #0056b3;
    }

    .edit-btn a {
        background: #202224;
        color: #ff6b35;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
        display: inline-block;
    }

    .edit-btn a:hover {
        background: #005bb5;
        transform: translateY(-1px);
    }

    .del-post {
        margin: 0;
    }

    .del-post button {
        background: #a16bc5;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .del-post button:hover {
        background: #721c88;
        transform: translateY(-1px);
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

    /* Image Upload Styles */
    .image-upload-section {
        margin: 16px 0;
    }

    .image-upload-label {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 16px;
        border: 2px dashed #e8ecf0;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #fafbfc;
        font-size: 14px;
        font-weight: 500;
        color: #4a5568;
    }

    .image-upload-label:hover {
        border-color: #0073e6;
        background: #f0f8ff;
        color: #0073e6;
    }

    .upload-icon {
        font-size: 18px;
    }

    .image-input {
        display: none;
    }

    .image-preview {
        margin-top: 12px;
        position: relative;
        display: inline-block;
    }

    .image-preview img {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .remove-image-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        cursor: pointer;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .remove-image-btn:hover {
        background: #c82333;
        transform: scale(1.1);
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

    /* Search Section Styles */
    .search-section {
        background: #ffffff;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.04);
        border: 1px solid #e8ecf0;
        margin-bottom: 20px;
    }

    .search-section h3 {
        color: #1a1a1a;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        text-align: center;
    }

    .search-container {
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e8ecf0;
        border-radius: 12px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.2s ease;
        background: #fafbfc;
    }

    .search-input:focus {
        outline: none;
        border-color: #0073e6;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(0, 115, 230, 0.1);
    }

    .search-btn {
        margin-top: 12px;
        width: 100%;
        background: #0073e6;
        color: white;
        border: none;
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .search-btn:hover {
        background: #0056b3;
        transform: translateY(-1px);
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
                            <a href="/profile" class="nav-link">Profile</a>
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
                <form action="/create-post" method="post" class="create-post-form" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="title" placeholder="Post Title" required>
                    <textarea name="body" placeholder="Share your thoughts..."></textarea>
                    <div class="image-upload-section">
                        <label for="image" class="image-upload-label">
                            <span class="upload-icon">📷</span>
                            <span class="upload-text">Upload Image (Optional)</span>
                        </label>
                        <input type="file" name="image" id="image" accept="image/*" class="image-input">
                        <div class="image-preview" id="image-preview" style="display: none;">
                            <img id="preview-img" src="" alt="Preview">
                            <button type="button" class="remove-image-btn" onclick="removeImage()">Remove</button>
                        </div>
                    </div>
                    <div class="post-buttons">
                        <button type="submit">Post</button>
                        <button type="submit" name="anonymous" value="1" class="anonymous-btn">Post Anonymously</button>
                    </div>
                </form>
            </div>

            <!-- Posts Feed -->
            <div class="posts-feed">
                <div class="feed-header">
                    <h2>Recent Posts</h2>
                </div>
                
                @foreach ($posts as $post)
                <div class="post-card" data-post-id="{{$post->id}}">
                    <div class="post-content">
                        <div class="post-header">
                            <div class="post-author">{{$post->author_name}}</div>
                            <div class="post-time">{{$post->created_at->format('M j, Y \a\t g:i A')}}</div>
                        </div>
                        <h3 class="post-title">{{$post->title}}</h3>
                        @if($post->image)
                        <div class="post-image">
                            <img src="{{ asset($post->image) }}" alt="Post Image" class="post-image-content">
                        </div>
                        @endif
                        <div class="post-body">{{$post->body}}</div>
                    </div>
                    
                    <!-- Interaction Buttons -->
                    <div class="post-actions">
                        <div class="interaction-buttons">
                            <form action="/posts/{{$post->id}}/like" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="interaction-btn like-btn {{$post->isLikedBy(auth()->id()) ? 'active' : ''}}">
                                    👍 <span class="interaction-count">{{$post->likesCount()}}</span>
                                </button>
                            </form>
                            <form action="/posts/{{$post->id}}/dislike" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="interaction-btn dislike-btn {{$post->isDislikedBy(auth()->id()) ? 'active' : ''}}">
                                    👎 <span class="interaction-count">{{$post->dislikesCount()}}</span>
                                </button>
                            </form>
                            <button class="interaction-btn comment-toggle-btn" onclick="toggleComments({{$post->id}})">
                                💬 <span class="interaction-count">{{$post->commentsCount()}}</span>
                            </button>
                        </div>

                        <!-- Comment Section -->
                        <div class="comment-section" id="comment-section-{{$post->id}}" style="display: none;">
                            <form action="/posts/{{$post->id}}/comment" method="POST" class="comment-form">
                                @csrf
                                <textarea name="comment" class="comment-input" placeholder="Write a comment..." required></textarea>
                                <button type="submit" class="comment-btn">Comment</button>
                            </form>
                            <div class="comments-list" id="comments-list-{{$post->id}}">
                                @foreach($post->comments->sortByDesc('created_at') as $comment)
                                <div class="comment-item">
                                    <div class="comment-header">
                                        <span class="comment-author">{{$comment->user->name}}</span>
                                        <span class="comment-time">{{$comment->created_at->format('M j, Y \a\t g:i A')}}</span>
                                    </div>
                                    <div class="comment-text">{{$comment->comment}}</div>
                                </div>
                                @endforeach
                                @if($post->comments->count() == 0)
                                <p style="color: #6c757d; font-size: 14px; text-align: center; padding: 20px;">No comments yet</p>
                                @endif
                            </div>
                        </div>

                        <!-- Edit/Delete Actions -->
                        <div style="display: flex; gap: 12px; margin-top: 12px;">
                            <div class="edit-btn">
                                <a href="/edit-post/{{$post->id}}">Edit</a>
                            </div>
                            <form action="/delete-post/{{$post->id}}" method="post" class="del-post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Search Section -->
            <div class="search-section">
                <h3>Search Users</h3>
                <form action="/search-users" method="GET" class="search-container">
                    <input type="text" name="query" placeholder="Search by name..." class="search-input" value="{{ request('query') }}">
                    <button type="submit" class="search-btn">Search</button>
                </form>
            </div>

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

    <script>
        function toggleComments(postId) {
            const commentSection = document.getElementById(`comment-section-${postId}`);
            
            if (commentSection.style.display === 'none') {
                commentSection.style.display = 'block';
            } else {
                commentSection.style.display = 'none';
            }
        }

        // Image upload preview functionality
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('image-preview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        function removeImage() {
            document.getElementById('image').value = '';
            document.getElementById('image-preview').style.display = 'none';
            document.getElementById('preview-img').src = '';
        }


    </script>
</body>
</html>