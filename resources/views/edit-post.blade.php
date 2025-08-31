<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #b9d1ca;
            color: #1a1a1a;
            line-height: 1.6;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.04);
            border: 1px solid #e8ecf0;
        }
        
        h1 {
            color: #1a1a1a;
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: 600;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2d3748;
        }
        
        input[type="text"], textarea {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e8ecf0;
            border-radius: 12px;
            font-size: 16px;
            font-family: inherit;
            transition: all 0.2s ease;
            background: #fafbfc;
            box-sizing: border-box;
        }
        
        input[type="text"]:focus, textarea:focus {
            outline: none;
            border-color: #0073e6;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(0, 115, 230, 0.1);
        }
        
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .image-upload-section {
            margin: 20px 0;
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
        
        .image-input {
            display: none;
        }
        
        .current-image {
            margin: 16px 0;
            text-align: center;
        }
        
        .current-image img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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
        
        .buttons {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }
        
        button {
            background: #1d1f20;
            color: #ff6b35;
            border: none;
            padding: 16px 32px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            flex: 1;
        }
        
        button:hover {
            background: #276eb4;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 115, 230, 0.3);
        }
        
        .cancel-btn {
            background: #6c757d;
            color: white;
        }
        
        .cancel-btn:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Post</h1>

        <form action="/edit-post/{{$post->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" name="title" id="title" value="{{$post->title}}" {{ $post->poll && !$post->title ? '' : 'required' }}>
            </div>
            
            <div class="form-group">
                <label for="body">Post Content</label>
                <textarea name="body" id="body" {{ $post->poll && !$post->body ? '' : 'required' }}>{{$post->body}}</textarea>
            </div>
            
            <div class="image-upload-section">
                <label for="image" class="image-upload-label">
                    <span class="upload-icon">📷</span>
                    <span class="upload-text">Change Image (Optional)</span>
                </label>
                <input type="file" name="image" id="image" accept="image/*" class="image-input">
                
                @if($post->image)
                <div class="current-image">
                    <p style="margin-bottom: 8px; font-size: 14px; color: #6b7280;">Current Image:</p>
                    <img src="{{ asset($post->image) }}" alt="Current Post Image">
                </div>
                @endif
                
                <div class="image-preview" id="image-preview" style="display: none;">
                    <p style="margin-bottom: 8px; font-size: 14px; color: #6b7280;">New Image Preview:</p>
                    <img id="preview-img" src="" alt="Preview">
                    <button type="button" class="remove-image-btn" onclick="removeImage()">×</button>
                </div>
            </div>
            
            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; margin-bottom: 16px;">
                    <input type="checkbox" name="anonymous" value="1" {{ $post->anonymous ? 'checked' : '' }} style="width: auto; margin: 0;">
                    <span>Post as Anonymous</span>
                </label>
                
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="checkbox" name="lost_and_found" value="1" {{ $post->lost_and_found ? 'checked' : '' }} style="width: auto; margin: 0;">
                    <span>🔍 Lost & Found Post</span>
                </label>
            </div>
            
            <div class="buttons">
                <button type="submit">Save Changes</button>
                <a href="/dashboard" class="cancel-btn" style="text-decoration: none; text-align: center; display: flex; align-items: center; justify-content: center;">Cancel</a>
            </div>
        </form>
    </div>
    
    <script>
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