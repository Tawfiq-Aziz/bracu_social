<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post - BRACU Social</title>
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
            padding: 0 24px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
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
            max-width: 640px;
            width: 100%;
            margin: 40px auto;
            padding: 0 16px;
        }

        .card {
            background-color: var(--surface-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-card);
            padding: 32px 24px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        h1 {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-primary);
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

        input[type="text"], textarea {
            font-family: 'Nunito Sans', system-ui, Arial, sans-serif;
            font-size: 15px;
            color: var(--text-primary);
            background-color: var(--surface-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-ctrl);
            padding: 10px 14px;
            width: 100%;
        }

        input:focus, textarea:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
            border-color: var(--primary);
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
            text-decoration: none;
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

        .btn-secondary:hover {
            background-color: var(--bg-hover);
        }

        .btn-sm {
            padding: 4px 12px;
            font-size: 13px;
        }

        .image-preview-thumbnail {
            max-width: 160px;
            max-height: 160px;
            border-radius: var(--radius-ctrl);
            border: 1px solid var(--border);
            object-fit: cover;
            display: block;
            margin-top: 8px;
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
    </header>

    <div class="main-container">
        <div class="card">
            <h1>Edit Post</h1>

            <form action="/edit-post/{{$post->id}}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 16px;">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" name="title" id="title" value="{{$post->title}}" {{ $post->poll && !$post->title ? '' : 'required' }} placeholder="Enter post title...">
                </div>

                <div class="form-group">
                    <label for="body">Post Content</label>
                    <textarea name="body" id="body" rows="4" {{ $post->poll && !$post->body ? '' : 'required' }} placeholder="Share your thoughts...">{{$post->body}}</textarea>
                </div>

                <div class="form-group">
                    <label>Image Attachment</label>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <label class="btn btn-secondary btn-sm" style="cursor: pointer;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            Change image
                            <input type="file" name="image" id="image" accept="image/*" style="display: none;">
                        </label>
                    </div>

                    @if($post->image)
                        <div id="current-image-box" style="margin-top: 8px;">
                            <span class="text-muted" style="font-size: 13px;">Current image:</span>
                            <img src="{{ asset($post->image) }}" alt="Current Image" class="image-preview-thumbnail">
                        </div>
                    @endif

                    <div id="image-preview" style="display: none; margin-top: 8px;">
                        <span class="text-muted" style="font-size: 13px;">New image preview:</span>
                        <img id="preview-img" src="" alt="New Preview" class="image-preview-thumbnail">
                        <button type="button" class="btn btn-secondary btn-sm" style="margin-top: 6px;" onclick="removeImage()">Cancel image change</button>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; justify-content: flex-end; padding-top: 12px; border-top: 1px solid var(--border);">
                    <a href="/dashboard" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const imageInput = document.getElementById('image');
        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
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
        }

        function removeImage() {
            if (imageInput) imageInput.value = '';
            document.getElementById('image-preview').style.display = 'none';
            document.getElementById('preview-img').src = '';
        }
    </script>
</body>
</html>
