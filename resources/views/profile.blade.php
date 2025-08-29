<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
</head>
<body>
    <div class="header">
        <div class="main-title">BRACU SOCIAL</div>
        <div class="nav-bar">
            <div class="nav-left">
                <div class="nav-links">
                    <a href="/dashboard" class="nav-link">Home</a>
                </div>
            </div>
            <a href="/logout" class="logout-btn">Logout</a>
        </div>
    </div>
    <div class="posts-feed">
        <div class="feed-header">
            <h2>Your Posts</h2>
        </div>
        
        @foreach ($posts as $post)
        <div class="post-card">
            <div class="post-content">
                <h3 class="post-title">{{$post['title']}}</h3>
                <div class="post-body">{{$post['body']}}</div>
            </div>
        </div>
        @endforeach
    </div>

    </div>
</body>
</html>