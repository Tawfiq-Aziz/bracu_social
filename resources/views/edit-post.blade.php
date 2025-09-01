<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post - BRACU Social</title>
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
    min-height: 100vh;
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
    max-width: 800px;
    margin: 0 auto;
    padding: 40px 20px;
    min-height: 100vh;
}

/* Header Section */
.header {
    background: var(--bg-card);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    text-align: center;
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
    height: 3px;
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
    margin-bottom: 15px;
}

@keyframes titleGlow {
    0% {
        filter: drop-shadow(0 0 20px rgba(99, 102, 241, 0.3));
    }
    100% {
        filter: drop-shadow(0 0 30px rgba(99, 102, 241, 0.6));
    }
}

.page-subtitle {
    color: var(--text-secondary);
    font-size: 1.1rem;
    font-weight: 500;
}

/* Edit Post Form Section */
.edit-post-section {
    background: var(--bg-card);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 40px;
    box-shadow: var(--shadow-medium);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.edit-post-section:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-heavy);
    border-color: rgba(99, 102, 241, 0.4);
}

.edit-post-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--gradient-primary);
}

.edit-post-section h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 30px;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 12px;
    text-align: center;
    justify-content: center;
}

.edit-post-section h2::before {
    content: '✏️';
    font-size: 1.3em;
}

/* Form Styles */
.form-group {
    margin-bottom: 25px;
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: 600;
    color: var(--text-secondary);
    font-size: 1rem;
}

input[type="text"], textarea {
    width: 100%;
    padding: 16px 20px;
    border: 2px solid var(--border-color);
    border-radius: 12px;
    font-size: 16px;
    font-family: inherit;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.1);
    color: var(--text-primary);
    box-sizing: border-box;
    backdrop-filter: blur(10px);
}

input[type="text"]::placeholder, textarea::placeholder {
    color: var(--text-muted);
    opacity: 0.7;
}

input[type="text"]:focus, textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    transform: translateY(-1px);
}

textarea {
    min-height: 120px;
    resize: vertical;
}

/* Image Upload Section */
.image-upload-section {
    margin: 30px 0;
    border: 2px dashed var(--border-color);
    border-radius: 16px;
    padding: 30px;
    text-align: center;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.05);
}

.image-upload-section:hover {
    border-color: var(--primary-color);
    background: rgba(99, 102, 241, 0.1);
}

.image-upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    padding: 20px;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.image-upload-label:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

.upload-icon {
    font-size: 2.5rem;
    opacity: 0.8;
}

.upload-text {
    color: var(--text-secondary);
    font-weight: 500;
    font-size: 1.1rem;
}

.image-input {
    display: none;
}

.current-image {
    margin: 20px 0;
    text-align: center;
}

.current-image p {
    margin-bottom: 15px;
    font-size: 1rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.current-image img {
    max-width: 250px;
    max-height: 250px;
    border-radius: 12px;
    box-shadow: var(--shadow-medium);
    border: 2px solid var(--border-color);
}

.image-preview {
    margin-top: 20px;
    position: relative;
    display: inline-block;
}

.image-preview p {
    margin-bottom: 15px;
    font-size: 1rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.image-preview img {
    max-width: 250px;
    max-height: 250px;
    border-radius: 12px;
    box-shadow: var(--shadow-medium);
    border: 2px solid var(--border-color);
}

.remove-image-btn {
    position: absolute;
    top: -12px;
    right: -12px;
    background: var(--danger-color);
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    cursor: pointer;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-light);
}

.remove-image-btn:hover {
    background: #dc2626;
    transform: scale(1.1);
    box-shadow: var(--shadow-medium);
}

/* Buttons */
.buttons {
    display: flex;
    gap: 20px;
    margin-top: 40px;
    flex-wrap: wrap;
}

button, .btn {
    background: var(--gradient-primary);
    color: var(--text-primary);
    border: none;
    padding: 16px 32px;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    flex: 1;
    min-width: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-decoration: none;
    box-shadow: var(--shadow-light);
}

button:hover, .btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

.cancel-btn {
    background: var(--bg-secondary);
    color: var(--text-secondary);
    border: 1px solid var(--border-color);
}

.cancel-btn:hover {
    background: var(--bg-card);
    color: var(--text-primary);
    transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 20px 15px;
    }
    
    .header {
        padding: 25px 20px;
    }
    
    .main-title {
        font-size: 2rem;
    }
    
    .edit-post-section {
        padding: 30px 20px;
    }
    
    .buttons {
        flex-direction: column;
    }
    
    button, .btn {
        min-width: auto;
    }
}

@media (max-width: 480px) {
    .main-title {
        font-size: 1.8rem;
    }
    
    .edit-post-section h2 {
        font-size: 1.5rem;
    }
    
    .image-upload-section {
        padding: 20px;
    }
    
    .current-image img,
    .image-preview img {
        max-width: 200px;
        max-height: 200px;
    }
}

/* Smooth Scrolling */
html {
    scroll-behavior: smooth;
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
        <!-- Header -->
        <div class="header">
            <div class="main-title">BRACU SOCIAL</div>
            <div class="page-subtitle">Edit Your Post</div>
        </div>

        <!-- Edit Post Form -->
        <div class="edit-post-section">
            <h2>Edit Post</h2>

            <form action="/edit-post/{{$post->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" name="title" id="title" value="{{$post->title}}" {{ $post->poll && !$post->title ? '' : 'required' }} placeholder="Enter post title...">
                </div>
                
                <div class="form-group">
                    <label for="body">Post Content</label>
                    <textarea name="body" id="body" {{ $post->poll && !$post->body ? '' : 'required' }} placeholder="Share your thoughts...">{{$post->body}}</textarea>
                </div>
                
                <div class="image-upload-section">
                    <label for="image" class="image-upload-label">
                        <span class="upload-icon">📷</span>
                        <span class="upload-text">Change Image (Optional)</span>
                    </label>
                    <input type="file" name="image" id="image" accept="image/*" class="image-input">
                    
                    @if($post->image)
                    <div class="current-image">
                        <p>Current Image:</p>
                        <img src="{{ asset($post->image) }}" alt="Current Post Image">
                    </div>
                    @endif
                    
                    <div class="image-preview" id="image-preview" style="display: none;">
                        <p>New Image Preview:</p>
                        <img id="preview-img" src="" alt="Preview">
                        <button type="button" class="remove-image-btn" onclick="removeImage()">×</button>
                    </div>
                </div>
                
                <div class="buttons">
                    <button type="submit">
                        <span>💾</span>
                        Save Changes
                    </button>
                    <a href="/dashboard" class="btn cancel-btn">
                        <span>❌</span>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
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