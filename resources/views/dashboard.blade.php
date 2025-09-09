<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - CosmoConnect</title>
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

/* Create Post Section */
.create-post-section {
    background: var(--bg-card);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 30px;
    box-shadow: var(--shadow-medium);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.create-post-section:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-heavy);
    border-color: rgba(99, 102, 241, 0.4);
}

.create-post-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--gradient-primary);
}

.create-post-section h2 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 25px;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 10px;
}

.create-post-section h2::before {
    content: '✍️';
    font-size: 1.2em;
}

.create-post-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.post-content-fields {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.post-content-fields input,
.post-content-fields textarea {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 15px 20px;
    color: var(--text-primary);
    font-size: 1rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.post-content-fields input::placeholder,
.post-content-fields textarea::placeholder {
    color: var(--text-muted);
}

.post-content-fields input:focus,
.post-content-fields textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    background: rgba(255, 255, 255, 0.15);
}

.post-content-fields textarea {
    min-height: 120px;
    resize: vertical;
}

/* Image Upload Section */
.image-upload-section {
    border: 2px dashed var(--border-color);
    border-radius: 12px;
    padding: 30px;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
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
    gap: 10px;
    cursor: pointer;
}

.upload-icon {
    font-size: 2rem;
    opacity: 0.7;
}

.upload-text {
    color: var(--text-secondary);
    font-weight: 500;
}

.image-input {
    display: none;
}

.image-preview {
    margin-top: 20px;
    position: relative;
    display: inline-block;
}

.image-preview img {
    max-width: 200px;
    max-height: 200px;
    border-radius: 12px;
    border: 2px solid var(--border-color);
}

.remove-image-btn {
    position: absolute;
    top: -10px;
    right: -10px;
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
}

.remove-image-btn:hover {
    transform: scale(1.1);
}

/* Post Options */
.post-options {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 10px;
}

.checkbox-option {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    padding: 8px 16px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    transition: all 0.3s ease;
    font-weight: 500;
}

.checkbox-option:hover {
    background: rgba(255, 255, 255, 0.15);
}

.checkbox-option input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: var(--primary-color);
}

/* Poll Creation Section */
.poll-creation-section {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(99, 102, 241, 0.1));
    border: 1px solid rgba(139, 92, 246, 0.4);
    border-radius: 20px;
    padding: 30px;
    margin-top: 20px;
    display: none;
    animation: slideDown 0.3s ease-out;
    backdrop-filter: blur(20px);
    box-shadow: 0 8px 32px rgba(139, 92, 246, 0.2);
    position: relative;
    overflow: hidden;
}

.poll-creation-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--gradient-secondary);
    opacity: 0.8;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.poll-creation-section h3 {
    color: var(--secondary-color);
    margin-bottom: 25px;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 700;
    text-shadow: 0 0 20px rgba(139, 92, 246, 0.3);
}

.poll-creation-section h3::before {
    content: '📊';
    font-size: 1.4em;
    filter: drop-shadow(0 0 10px rgba(139, 92, 246, 0.5));
}

.poll-question-section,
.poll-options-section {
    margin-bottom: 20px;
}

.poll-creation-section label {
    display: block;
    margin-bottom: 8px;
    color: var(--text-secondary);
    font-weight: 500;
    font-size: 0.95rem;
}

.poll-creation-section input[type="text"] {
    width: 100%;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 15px 20px;
    color: var(--text-primary);
    font-size: 1rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.poll-creation-section input[type="text"]::placeholder {
    color: var(--text-muted);
    opacity: 0.7;
}

.poll-creation-section input[type="text"]:focus {
    outline: none;
    border-color: var(--secondary-color);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-1px);
}

.poll-options-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 15px;
}

.poll-option-input {
    display: flex;
    gap: 10px;
    align-items: center;
}

.poll-option-input input {
    flex: 1;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 12px 16px;
    color: var(--text-primary);
    font-size: 0.95rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.poll-option-input input::placeholder {
    color: var(--text-muted);
    opacity: 0.7;
}

.poll-option-input input:focus {
    outline: none;
    border-color: var(--secondary-color);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-1px);
}

.remove-option-btn {
    background: var(--danger-color);
    color: white;
    border: none;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    cursor: pointer;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
}

.remove-option-btn:hover {
    background: #dc2626;
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
}

.add-option-btn {
    background: var(--secondary-color);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease;
}

.add-option-btn:hover {
    background: #7c3aed;
    transform: translateY(-1px);
}

/* Poll Settings */
.poll-settings {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid rgba(139, 92, 246, 0.3);
}

.poll-settings .checkbox-option {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 12px;
    padding: 12px 16px;
    transition: all 0.3s ease;
}

.poll-settings .checkbox-option:hover {
    background: rgba(255, 255, 255, 0.12);
    border-color: rgba(139, 92, 246, 0.5);
    transform: translateY(-1px);
}

.poll-settings .checkbox-option input[type="checkbox"] {
    accent-color: var(--secondary-color);
    transform: scale(1.1);
}

/* Post Buttons */
.post-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    margin-top: 20px;
}

.post-buttons button {
    padding: 12px 24px;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

.post-buttons button:first-child {
    background: var(--gradient-primary);
    color: white;
}

.post-buttons button:first-child:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

.anonymous-btn {
    background: var(--bg-secondary);
    color: var(--text-secondary);
    border: 1px solid var(--border-color);
}

.anonymous-btn:hover {
    background: var(--bg-card);
    color: var(--text-primary);
    transform: translateY(-2px);
}

/* Posts Feed */
.posts-feed {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.feed-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.feed-header h2::before {
    content: '📰';
    font-size: 1.2em;
}

/* Posts Feed */
.posts-feed {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.feed-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 20px;
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

/* Post Content */
.post-content {
    max-width: 100%;
    word-wrap: break-word;
    overflow-wrap: break-word;
    overflow-x: hidden;
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

/* Post Actions */
.post-actions {
    margin-top: 20px;
}

.interaction-buttons {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.interaction-btn {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid var(--border-color);
    color: var(--text-secondary);
    padding: 8px 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
    position: relative;
    overflow: hidden;
}

.interaction-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transition: left 0.5s ease;
}

.interaction-btn:hover::before {
    left: 100%;
}

.interaction-btn:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-1px);
}

.interaction-btn.active {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.interaction-count {
    font-size: 0.9rem;
    font-weight: 600;
}

/* Comment Section */
.comment-section {
    margin-top: 20px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    border: 1px solid var(--border-color);
}

.comment-form {
    margin-bottom: 20px;
}

.comment-input {
    width: 100%;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 12px 16px;
    color: var(--text-primary);
    resize: vertical;
    min-height: 80px;
    margin-bottom: 10px;
}

.comment-input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.comment-btn {
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease;
}

.comment-btn:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
}

.comments-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.comment-item {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    padding: 15px;
    border: 1px solid var(--border-color);
}

.comment-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.comment-author {
    color: var(--primary-color);
    font-weight: 600;
    font-size: 0.9rem;
}

.comment-time {
    color: var(--text-muted);
    font-size: 0.8rem;
}

.comment-text {
    color: var(--text-secondary);
    line-height: 1.5;
}

/* Edit/Delete Actions */
.post-actions-buttons {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid var(--border-color);
    position: relative;
}

.post-actions-buttons::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--gradient-primary);
    opacity: 0.3;
}

.mark-resolved-btn,
.edit-btn a,
.del-post button {
    padding: 8px 16px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
    box-shadow: var(--shadow-light);
    border: 1px solid transparent;
    min-width: 80px;
    height: 36px;
}

.mark-resolved-btn::before,
.edit-btn a::before,
.del-post button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.mark-resolved-btn:hover::before,
.edit-btn a:hover::before,
.del-post button:hover::before {
    left: 100%;
}

.mark-resolved-btn {
    background: linear-gradient(135deg, #1e40af, #1d4ed8);
    color: #dbeafe;
    border: 1px solid rgba(30, 64, 175, 0.4);
}

.mark-resolved-btn:hover {
    background: linear-gradient(135deg, #1d4ed8, #2563eb);
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
    border-color: rgba(30, 64, 175, 0.6);
}

.edit-btn a {
    background: linear-gradient(135deg, #7c3aed, #8b5cf6);
    color: #ede9fe;
    border: 1px solid rgba(124, 58, 237, 0.4);
}

.edit-btn a:hover {
    background: linear-gradient(135deg, #8b5cf6, #a78bfa);
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    border-color: rgba(124, 58, 237, 0.6);
}

.del-post button {
    background: linear-gradient(135deg, #dc2626, #ef4444);
    color: #fecaca;
    border: 1px solid rgba(220, 38, 38, 0.4);
}

.del-post button:hover {
    background: linear-gradient(135deg, #ef4444, #f87171);
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
    border-color: rgba(220, 38, 38, 0.6);
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

/* Search Section */
.search-section {
    background: var(--bg-card);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 25px;
    box-shadow: var(--shadow-medium);
}

.search-section h3 {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 8px;
}

.search-section h3::before {
    content: '🔍';
    font-size: 1.1em;
}

.search-container {
    position: relative;
}

.search-input {
    width: 100%;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 12px 16px;
    color: var(--text-primary);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.search-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    margin-top: 5px;
    max-height: 300px;
    overflow-y: auto;
    z-index: 1000;
    display: none;
}

.search-result-item {
    padding: 12px 16px;
    border-bottom: 1px solid var(--border-color);
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-result-item:last-child {
    border-bottom: none;
}

.search-result-item:hover {
    background: rgba(255, 255, 255, 0.1);
}

.search-result-name {
    color: var(--text-primary);
    font-weight: 600;
    margin-bottom: 4px;
}

.search-result-details {
    color: var(--text-muted);
    font-size: 0.9rem;
    display: flex;
    gap: 10px;
}

.no-results {
    padding: 20px;
    text-align: center;
    color: var(--text-muted);
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

/* Additional Features Section */
.features-section {
    background: var(--bg-card);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 25px;
    box-shadow: var(--shadow-medium);
    margin-top: 25px;
}

.features-section h3 {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 8px;
}

.features-section h3::before {
    content: '🚀';
    font-size: 1.1em;
}

/* Chat Drawer */
.chat-drawer {
    position: fixed;
    right: 24px;
    bottom: 24px;
    width: 420px;
    height: 560px;
    background: #0b1020;
    border: 1px solid rgba(99,102,241,0.25);
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.6);
    display: none;
    flex-direction: column;
    overflow: hidden;
    z-index: 2500;
}

/* Blackhole background */
.chat-drawer::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(800px 800px at 70% 40%, rgba(99,102,241,0.12), transparent 60%),
        radial-gradient(600px 600px at 30% 70%, rgba(139,92,246,0.10), transparent 55%),
        conic-gradient(from 180deg at 70% 40%, rgba(0,0,0,0.0) 0deg, rgba(20, 24, 48, 0.6) 120deg, rgba(0,0,0,0.0) 240deg, rgba(20, 24, 48, 0.6) 360deg);
    filter: blur(0.2px);
    animation: swirl 12s linear infinite;
    pointer-events: none;
}

@keyframes swirl {
    0% { transform: rotate(0deg) scale(1); }
    100% { transform: rotate(360deg) scale(1); }
}

.chat-header {
    padding: 10px 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(99,102,241,0.25);
    font-weight: 600;
}

.chat-body {
    display: grid;
    grid-template-columns: 140px 1fr;
    min-height: 0;
    flex: 1;
}

.chat-users {
    border-right: 1px solid rgba(99,102,241,0.25);
    overflow-y: auto;
}

.chat-user-item {
    padding: 10px 12px;
    cursor: pointer;
    border-bottom: 1px solid rgba(148,163,184,0.15);
}

.chat-user-item:hover { background: rgba(255,255,255,0.06); }
.chat-user-item.active { background: rgba(99,102,241,0.15); }

.chat-conversation {
    display: flex;
    flex-direction: column;
    min-height: 0;
}

.chat-messages {
    padding: 10px;
    overflow-y: auto;
    flex: 1;
}

.msg {
    max-width: 80%;
    margin: 6px 0 10px 0;
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid rgba(148,163,184,0.18);
    line-height: 1.35;
}
.msg.out { align-self: flex-end; background: rgba(99,102,241,0.25); }
.msg.in { align-self: flex-start; background: rgba(255,255,255,0.08); }

.chat-input {
    display: flex;
    gap: 10px;
    padding: 12px;
    border-top: 1px solid rgba(99,102,241,0.25);
    background: linear-gradient(180deg, rgba(11,16,32,0.6), rgba(11,16,32,1));
}

.chat-input input {
    flex: 1;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(148,163,184,0.15);
    border-radius: 12px;
    padding: 12px 14px;
    color: var(--text-primary);
    min-width: 0;
}

.chat-input button {
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 12px 16px;
    cursor: pointer;
    flex-shrink: 0;
    min-width: 68px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid var(--border-color);
    transition: all 0.3s ease;
}

.feature-item:last-child {
    border-bottom: none;
}

.feature-item:hover {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    padding-left: 12px;
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.feature-icon {
    font-size: 1.5rem;
    opacity: 0.8;
}

.feature-text {
    color: var(--text-secondary);
    font-weight: 500;
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
    
    .post-buttons {
        flex-direction: column;
    }
    
    .interaction-buttons {
        justify-content: center;
    }
    
    .post-actions-buttons {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .main-title {
        font-size: 1.8rem;
    }
    
    .create-post-section,
    .post-card,
    .search-section,
    .user-card {
        padding: 20px;
    }
    
    .post-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
}

/* Loading Animation */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.loading {
    animation: pulse 1.5s ease-in-out infinite;
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

/* Event Board Modal */
.event-modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 2000;
}

.event-modal {
    background: radial-gradient(1200px 600px at 10% 10%, rgba(99,102,241,0.12), transparent 60%),
                radial-gradient(1000px 500px at 90% 20%, rgba(139,92,246,0.10), transparent 55%),
                linear-gradient(180deg, #0b1020 0%, #0f172a 60%, #111827 100%);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 20px;
    width: 100%;
    max-width: 520px;
    box-shadow: var(--shadow-heavy);
    position: relative;
    overflow: hidden;
}

/* Shooting star background for Event Board */
.event-modal::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(1px 1px at 10% 20%, rgba(255,255,255,0.9), transparent),
        radial-gradient(1px 1px at 20% 80%, rgba(255,255,255,0.7), transparent),
        radial-gradient(1px 1px at 30% 40%, rgba(255,255,255,0.8), transparent),
        radial-gradient(1px 1px at 40% 60%, rgba(255,255,255,0.6), transparent),
        radial-gradient(1px 1px at 55% 25%, rgba(255,255,255,0.75), transparent),
        radial-gradient(1px 1px at 65% 70%, rgba(255,255,255,0.7), transparent),
        radial-gradient(1px 1px at 75% 35%, rgba(255,255,255,0.85), transparent),
        radial-gradient(1px 1px at 85% 55%, rgba(255,255,255,0.65), transparent),
        radial-gradient(1px 1px at 92% 18%, rgba(255,255,255,0.8), transparent),
        radial-gradient(1px 1px at 15% 55%, rgba(255,255,255,0.6), transparent);
    opacity: 0.9;
    animation: twinkle 3.5s ease-in-out infinite alternate;
    pointer-events: none;
}

.event-modal::after {
    content: '';
    position: absolute;
    top: -20%;
    left: -30%;
    width: 160%;
    height: 160%;
    background:
        linear-gradient(115deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0) 47%, rgba(255,255,255,0.85) 50%, rgba(255,255,255,0.15) 60%, rgba(255,255,255,0) 64%, rgba(255,255,255,0) 100%);
    background-repeat: no-repeat;
    background-size: 16px 2px;
    filter: drop-shadow(0 0 6px rgba(255,255,255,0.6));
    transform: rotate(0.0001deg);
    animation: meteors 6s linear infinite;
    mix-blend-mode: screen;
    pointer-events: none;
}

@keyframes twinkle {
    0% { opacity: 0.6; }
    100% { opacity: 1; }
}

@keyframes meteors {
    0% { transform: translate3d(0,0,0) rotate(0.0001deg); opacity: 0; }
    5% { opacity: 1; }
    45% { opacity: 1; }
    50% { opacity: 0; }
    100% { transform: translate3d(20%,30%,0) rotate(0.0001deg); opacity: 0; }
}

.event-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
}

.event-modal-title {
    font-weight: 700;
}

.calendar {
    width: 100%;
    user-select: none;
}

.calendar-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 6px;
}

.calendar-cell {
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 10px;
    min-height: 70px;
    background: rgba(255,255,255,0.04);
}

.calendar-cell.muted { opacity: 0.4; }

.calendar-date {
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.calendar-event {
    margin-top: 6px;
    background: var(--gradient-secondary);
    color: white;
    padding: 4px 6px;
    border-radius: 6px;
    font-size: 0.8rem;
}

.calendar-actions {
    display: flex;
    gap: 8px;
}

.calendar-btn {
    background: var(--bg-secondary);
    color: var(--text-secondary);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 6px 10px;
    cursor: pointer;
}

.event-hint {
    color: var(--text-muted);
    font-size: 0.85rem;
    margin-top: 8px;
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

/* Loading States */
.loading-spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: var(--primary-color);
    animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
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
                    <div class="nav-left">
                        <div class="nav-links">
                            <a href="/profile" class="nav-link">Your Profile</a>
                            
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
                    <div class="post-content-fields" id="post_content_fields">
                        <input type="text" name="title" id="post_title" placeholder="Post Title" required>
                        <textarea name="body" id="post_body" placeholder="Share your thoughts..." required></textarea>
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
                    </div>
                    <div class="post-options">
                        <label class="checkbox-option">
                            <input type="checkbox" name="lost_and_found" value="1">
                            <span class="checkmark"></span>
                            Lost & Found Post
                        </label>
                        
                        <label class="checkbox-option" style="margin-top: 12px;">
                            <input type="checkbox" name="has_poll" value="1" id="has_poll_checkbox" onchange="togglePollSection()">
                            <span class="checkmark"></span>
                            📊 Add Poll
                        </label>
                    </div>
                    
                    <!-- Poll Creation Section -->
                    <div class="poll-creation-section">
                        <div class="poll-question-section">
                            <label for="poll_question">Poll Question :</label>
                            <input type="text" name="poll_question" id="poll_question" placeholder="What would you like to ask?">
                        </div>
                        
                        <div class="poll-options-section">
                            <label>Poll Options :</label>
                            <div class="poll-options-container">
                                <div class="poll-option-input">
                                    <input type="text" name="poll_options[]" placeholder="Option 1">
                                    <button type="button" class="remove-option-btn" onclick="removePollOption(this)" style="display: none;">×</button>
                                </div>
                                <div class="poll-option-input">
                                    <input type="text" name="poll_options[]" placeholder="Option 2">
                                    <button type="button" class="remove-option-btn" onclick="removePollOption(this)" style="display: none;">×</button>
                                </div>
                            </div>
                            <button type="button" class="add-option-btn" onclick="addPollOption()">+ Add Option</button>
                        </div>
                        
                        <div class="poll-settings">
                            <label class="checkbox-option">
                                <input type="checkbox" name="poll_multiple_choice" value="1">
                                <span class="checkmark"></span>
                                Allow multiple choices
                            </label>
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
                <div class="post-card" data-post-id="{{$post->id}}" data-author-id="{{$post->user_id}}" data-lost-and-found="{{$post->lost_and_found ? '1' : '0'}}">
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
                            <div class="post-author">{{$post->author_name}}</div>
                            <div class="post-time">{{$post->created_at->format('M j, Y ')}}</div>
                        </div>
                        
                        @if($post->title)
                        <h3 class="post-title">{{$post->title}}</h3>
                        @endif
                        
                        @if($post->image)
                        <div class="post-image">
                            <img src="{{ asset($post->image) }}" alt="Post Image" class="post-image-content">
                        </div>
                        @endif
                        
                        @if($post->body)
                        <div class="post-body">{{$post->body}}</div>
                        @endif
                        
                        @if($post->poll)
                        <!-- Poll Section -->
                        <div class="poll-section">
                            <div class="poll-question">
                                <h4>📊 {{$post->poll->question}}</h4>
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
                                        <span class="poll-option-text">{{$option->option_text}}</span>
                                        <span class="poll-option-stats">{{$option->votes_count}} votes ({{$option->percentage}}%)</span>
                                    </div>
                                    <div class="poll-progress-bar">
                                        <div class="poll-progress-fill" style="width: {{$option->percentage}}%"></div>
                                    </div>
                                    @if($post->poll->getUserVotedOptions(auth()->id())->contains($option->id))
                                    <span class="your-vote-indicator">✓ Your choice</span>
                                    @endif
                                </div>
                                @endforeach
                                <div class="poll-stats">
                                    Total votes: {{$post->poll->total_votes}}
                                    @if($post->poll->hasUserVoted(auth()->id()))
                                    <form action="/polls/{{$post->poll->id}}/vote" method="POST" style="display: inline; margin-left: 12px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="remove-vote-btn">Remove my vote</button>
                                    </form>
                                    @endif
                                    @if(auth()->user()->id == $post->user_id)
                                    <form action="/polls/{{$post->poll->id}}/delete" method="POST" style="display: inline; margin-left: 12px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-poll-btn" onclick="return confirm('Are you sure you want to delete this poll?')">🗑️ Delete Poll</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            @else
                            <!-- Show Voting Interface -->
                            <form action="/polls/{{$post->poll->id}}/vote" method="POST" class="poll-voting-form">
                                @csrf
                                <div class="poll-options">
                                    @foreach($post->poll->options as $option)
                                    <label class="poll-option-label">
                                        @if($post->poll->multiple_choice)
                                        <input type="checkbox" name="option_ids[]" value="{{$option->id}}">
                                        @else
                                        <input type="radio" name="option_ids[]" value="{{$option->id}}" required>
                                        @endif
                                        <span class="poll-option-text">{{$option->option_text}}</span>
                                    </label>
                                    @endforeach
                                </div>
                                <button type="submit" class="vote-btn">Cast Vote</button>
                            </form>
                            @endif
                        </div>
                        @endif
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
                        @if(auth()->user()->id == $post->user_id && !($post->poll && !$post->title && !$post->body))
                        <div class="post-actions-buttons">
                            @if($post->lost_and_found && !$post->resolved)
                            <form action="/mark-resolved/{{$post->id}}" method="post" class="mark-resolved-form">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="mark-resolved-btn">
                                    <span class="resolved-icon">✓</span>
                                    Mark as Resolved
                                </button>
                            </form>
                            @endif
                            <div class="edit-btn">
                                <a href="/edit-post/{{$post->id}}">Edit</a>
                            </div>
                            <form action="/delete-post/{{$post->id}}" method="post" class="del-post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Search Section -->
            <div class="search-section" id="search-section">
                <h3>Search Users</h3>
                <div class="search-container">
                    <input type="text" id="user-search" placeholder="Search by name..." class="search-input">
                    <div id="search-results" class="search-results"></div>
                </div>
            </div>

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

            <!-- Additional Features Section -->
            <div class="features-section">
                <h3>Quick Actions</h3>
                <div class="feature-item">
                    <span class="feature-icon">💬</span>
                    <span class="feature-text" id="open-chat" style="cursor: pointer;">Chat</span>
                </div>
                <div class="feature-item" id="filter-my-posts" style="cursor: pointer;">
                    <span class="feature-icon">📝</span>
                    <span class="feature-text">My Posts</span>
                </div>
                <div class="feature-item" id="filter-lost-found" style="cursor: pointer;">
                    <span class="feature-icon">🔍</span>
                    <span class="feature-text">Lost & Found</span>
                </div>
                <div class="feature-item">
                    <span class="feature-icon">🎯</span>
                    <span class="feature-text" id="open-event-board" style="cursor: pointer;">Event Board</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Board Modal -->
    <div class="event-modal-backdrop" id="event-modal-backdrop">
        <div class="event-modal" role="dialog" aria-modal="true" aria-labelledby="event-modal-title">
            <div class="event-modal-header">
                <div class="event-modal-title" id="event-modal-title">Upcoming Events</div>
                <button class="calendar-btn" id="close-event-modal">✖</button>
            </div>
            <div class="calendar">
                <div class="calendar-nav">
                    <button class="calendar-btn" id="prev-month">◀</button>
                    <div id="calendar-month-label"></div>
                    <button class="calendar-btn" id="next-month">▶</button>
                </div>
                <div class="calendar-grid" id="calendar-grid"></div>
                <div class="event-hint">Click a date to set/update the event name. Leave empty to clear.</div>
            </div>
        </div>
    </div>

    <!-- Chat Drawer -->
    <div class="chat-drawer" id="chat-drawer">
        <div class="chat-header">
            <span>Chat</span>
            <button class="calendar-btn" id="close-chat">✖</button>
        </div>
        <div class="chat-body">
            <div class="chat-users" id="chat-users"></div>
            <div class="chat-conversation">
                <div class="chat-messages" id="chat-messages"></div>
                <div class="chat-input">
                    <input type="text" id="chat-input-text" placeholder="Type a message...">
                    <button id="chat-send">Send</button>
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





        // Poll management functions
        function togglePollSection() {
            const checkbox = document.getElementById('has_poll_checkbox');
            const pollSection = document.querySelector('.poll-creation-section');
            
            if (checkbox.checked) {
                pollSection.style.display = 'block';
                // Make poll fields required when checkbox is checked
                document.getElementById('poll_question').required = true;
                document.querySelectorAll('input[name="poll_options[]"]').forEach((input, index) => {
                    if (index < 2) input.required = true; // First 2 options required
                });
            } else {
                pollSection.style.display = 'none';
                // Remove required attributes when unchecked
                document.getElementById('poll_question').required = false;
                document.querySelectorAll('input[name="poll_options[]"]').forEach(input => {
                    input.required = false;
                });
                // Clear poll data
                document.getElementById('poll_question').value = '';
                document.querySelectorAll('input[name="poll_options[]"]').forEach(input => {
                    input.value = '';
                });
            }
        }

        function addPollOption() {
            const container = document.querySelector('.poll-options-container');
            const optionCount = container.querySelectorAll('.poll-option-input').length;
            
            if (optionCount < 6) { // Limit to 6 options
                const newOption = document.createElement('div');
                newOption.className = 'poll-option-input';
                newOption.innerHTML = `
                    <input type="text" name="poll_options[]" placeholder="Option ${optionCount + 1}">
                    <button type="button" class="remove-option-btn" onclick="removePollOption(this)">×</button>
                `;
                container.appendChild(newOption);
                updateRemoveButtons();
            }
        }

        function removePollOption(button) {
            const container = document.querySelector('.poll-options-container');
            const optionCount = container.querySelectorAll('.poll-option-input').length;
            
            if (optionCount > 2) { // Keep at least 2 options
                button.parentElement.remove();
                updateRemoveButtons();
                // Update placeholders
                const options = container.querySelectorAll('.poll-option-input');
                options.forEach((option, index) => {
                    const input = option.querySelector('input');
                    input.placeholder = `Option ${index + 1}`;
                });
            }
        }

        function updateRemoveButtons() {
            const container = document.querySelector('.poll-options-container');
            const options = container.querySelectorAll('.poll-option-input');
            const removeButtons = container.querySelectorAll('.remove-option-btn');
            
            // Show/hide remove buttons based on option count
            removeButtons.forEach(button => {
                button.style.display = options.length > 2 ? 'flex' : 'none';
            });
        }

        // Initialize poll section state
        document.addEventListener('DOMContentLoaded', function() {
            togglePollSection(); // Set initial state
            updateRemoveButtons(); // Set initial button states
        });

        // Search functionality
        let searchTimeout;
        const searchInput = document.getElementById('user-search');
        const searchResults = document.getElementById('search-results');

        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            
            // Clear previous timeout
            clearTimeout(searchTimeout);
            
            if (query.length < 2) {
                searchResults.style.display = 'none';
                return;
            }

            // Debounce search requests
            searchTimeout = setTimeout(() => {
                searchUsers(query);
            }, 300);
        });

        // Hide search results when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.search-container')) {
                searchResults.style.display = 'none';
            }
        });

        function searchUsers(query) {
            fetch(`/search-users?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(users => {
                    displaySearchResults(users);
                })
                .catch(error => {
                    console.error('Search error:', error);
                    searchResults.innerHTML = '<div class="no-results">Error searching users</div>';
                    searchResults.style.display = 'block';
                });
        }

        function displaySearchResults(users) {
            if (users.length === 0) {
                searchResults.innerHTML = '<div class="no-results">No users found</div>';
            } else {
                searchResults.innerHTML = users.map(user => `
                    <div class="search-result-item" onclick="viewUserProfile(${user.id})">
                        <div class="search-result-name">${user.name}</div>
                        <div class="search-result-details">
                            <span class="search-result-department">${user.department}</span>
                            <span>ID: ${user.student_id}</span>
                        </div>
                    </div>
                `).join('');
            }
            searchResults.style.display = 'block';
        }

        function viewUserProfile(userId) {
            window.location.href = `/user/${userId}`;
        }

        // Event Board logic
        const eventModalBackdrop = document.getElementById('event-modal-backdrop');
        const openEventBoard = document.getElementById('open-event-board');
        const closeEventModal = document.getElementById('close-event-modal');
        const calendarGrid = document.getElementById('calendar-grid');
        const calendarMonthLabel = document.getElementById('calendar-month-label');

        let currentYear, currentMonth; // month is 0-based
        let dateToEventName = {}; // { 'YYYY-MM-DD': 'Name' }

        function openEventModal() {
            eventModalBackdrop.style.display = 'flex';
            const now = new Date();
            currentYear = now.getFullYear();
            currentMonth = now.getMonth();
            fetchEvents().then(renderCalendar);
        }

        function closeEvent() {
            eventModalBackdrop.style.display = 'none';
        }

        function fetchEvents() {
            return fetch('/events')
                .then(r => r.json())
                .then(items => {
                    dateToEventName = {};
                    items.forEach(it => {
                        // it.event_date like '2025-09-04'
                        if (it.name) dateToEventName[it.event_date] = it.name;
                    });
                })
                .catch(() => { dateToEventName = {}; });
        }

        function renderCalendar() {
            calendarGrid.innerHTML = '';
            const firstDay = new Date(currentYear, currentMonth, 1);
            const startWeekday = (firstDay.getDay() + 6) % 7; // make Monday=0
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            const prevMonthDays = new Date(currentYear, currentMonth, 0).getDate();

            const monthLabel = firstDay.toLocaleString('default', { month: 'long', year: 'numeric' });
            calendarMonthLabel.textContent = monthLabel;

            // Weekday headers
            const weekdays = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
            weekdays.forEach(wd => {
                const hdr = document.createElement('div');
                hdr.textContent = wd;
                hdr.style.fontWeight = '600';
                calendarGrid.appendChild(hdr);
            });

            // 6 rows * 7 cols = 42 cells after headers
            const totalCells = 42;
            // Fill previous month tail
            for (let i = 0; i < startWeekday; i++) {
                const dayNum = prevMonthDays - startWeekday + i + 1;
                const cell = buildCell(currentYear, currentMonth - 1, dayNum, true);
                calendarGrid.appendChild(cell);
            }

            // Current month
            for (let d = 1; d <= daysInMonth; d++) {
                const cell = buildCell(currentYear, currentMonth, d, false);
                calendarGrid.appendChild(cell);
            }

            // Next month head
            const used = 7 + startWeekday + daysInMonth; // headers + prev + current
            for (let i = used; i < 49; i++) { // include headers so 49 total
                const dayNum = i - used + 1;
                const cell = buildCell(currentYear, currentMonth + 1, dayNum, true);
                calendarGrid.appendChild(cell);
            }
        }

        function pad(n) { return String(n).padStart(2,'0'); }

        function buildCell(year, monthZeroBased, day, muted) {
            const cell = document.createElement('div');
            cell.className = 'calendar-cell' + (muted ? ' muted' : '');
            const dateDiv = document.createElement('div');
            dateDiv.className = 'calendar-date';
            dateDiv.textContent = day;
            cell.appendChild(dateDiv);

            const actual = new Date(year, monthZeroBased, day);
            const iso = `${actual.getFullYear()}-${pad(actual.getMonth()+1)}-${pad(actual.getDate())}`;

            if (dateToEventName[iso]) {
                const ev = document.createElement('div');
                ev.className = 'calendar-event';
                ev.textContent = dateToEventName[iso];
                cell.appendChild(ev);
            }

            cell.addEventListener('click', () => {
                const current = dateToEventName[iso] || '';
                const name = prompt(`Set event for ${iso}`, current || '');
                if (name === null) return; // cancelled
                const trimmed = name.trim();
                if (trimmed === '') {
                    // clear
                    fetch('/events', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ event_date: iso })
                    }).then(() => { delete dateToEventName[iso]; renderCalendar(); });
                } else {
                    fetch('/events', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ event_date: iso, name: trimmed })
                    }).then(r => r.json()).then(() => { dateToEventName[iso] = trimmed; renderCalendar(); });
                }
            });
            return cell;
        }

        openEventBoard.addEventListener('click', openEventModal);
        closeEventModal.addEventListener('click', closeEvent);
        document.getElementById('prev-month').addEventListener('click', () => {
            if (currentMonth === 0) { currentMonth = 11; currentYear--; } else { currentMonth--; }
            renderCalendar();
        });
        document.getElementById('next-month').addEventListener('click', () => {
            if (currentMonth === 11) { currentMonth = 0; currentYear++; } else { currentMonth++; }
            renderCalendar();
        });

        // Chat
        const chatDrawer = document.getElementById('chat-drawer');
        const openChatBtn = document.getElementById('open-chat');
        const closeChatBtn = document.getElementById('close-chat');
        const chatUsersDiv = document.getElementById('chat-users');
        const chatMessagesDiv = document.getElementById('chat-messages');
        const chatInput = document.getElementById('chat-input-text');
        const chatSend = document.getElementById('chat-send');
        let activeUserId = null;
        let lastMessageId = 0;
        let pollTimer = null;
        let renderedMessageIds = new Set();

        function openChat() {
            chatDrawer.style.display = 'flex';
            loadUsers();
        }

        function closeChat() {
            chatDrawer.style.display = 'none';
            activeUserId = null;
            lastMessageId = 0;
            if (pollTimer) { clearInterval(pollTimer); pollTimer = null; }
        }

        function loadUsers() {
            fetch('/chat/users')
                .then(r => r.json())
                .then(users => {
                    chatUsersDiv.innerHTML = users.map(u => `<div class="chat-user-item" data-id="${u.id}">${u.name}</div>`).join('');
                    // Auto-select first user and start polling
                    if (users.length > 0) {
                        const first = chatUsersDiv.querySelector('.chat-user-item');
                        if (first) {
                            [...chatUsersDiv.querySelectorAll('.chat-user-item')].forEach(it => it.classList.remove('active'));
                            first.classList.add('active');
                            activeUserId = parseInt(first.getAttribute('data-id'));
                            lastMessageId = 0;
                            loadMessages(true).then(startPolling);
                        }
                    }
                });
        }

        function loadMessages(initial=false) {
            if (!activeUserId) return Promise.resolve();
            const qs = lastMessageId ? `?since_id=${lastMessageId}` : '';
            return fetch(`/chat/messages/${activeUserId}${qs}`)
                .then(r => r.json())
                .then(msgs => {
                    if (initial) {
                        chatMessagesDiv.innerHTML = '';
                        renderedMessageIds = new Set();
                    }
                    msgs.forEach(m => {
                        if (renderedMessageIds.has(m.id)) return;
                        const div = document.createElement('div');
                        div.className = 'msg ' + (m.sender_id === {{ auth()->id() }} ? 'out' : 'in');
                        div.textContent = m.body;
                        chatMessagesDiv.appendChild(div);
                        renderedMessageIds.add(m.id);
                        lastMessageId = Math.max(lastMessageId, m.id);
                    });
                    chatMessagesDiv.scrollTop = chatMessagesDiv.scrollHeight;
                });
        }

        function startPolling() {
            if (pollTimer) clearInterval(pollTimer);
            pollTimer = setInterval(() => loadMessages(false), 2000);
        }

        chatUsersDiv.addEventListener('click', (e) => {
            const item = e.target.closest('.chat-user-item');
            if (!item) return;
            [...chatUsersDiv.querySelectorAll('.chat-user-item')].forEach(it => it.classList.remove('active'));
            item.classList.add('active');
            activeUserId = parseInt(item.getAttribute('data-id'));
            lastMessageId = 0;
            loadMessages(true).then(startPolling);
        });

        chatSend.addEventListener('click', () => {
            if (!activeUserId) return;
            const body = chatInput.value.trim();
            if (!body) return;
            fetch(`/chat/messages/${activeUserId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ body })
            }).then(r => r.json()).then(m => {
                chatInput.value = '';
                // append immediately
                if (!renderedMessageIds.has(m.id)) {
                    const div = document.createElement('div');
                    div.className = 'msg out';
                    div.textContent = m.body;
                    chatMessagesDiv.appendChild(div);
                    renderedMessageIds.add(m.id);
                }
                lastMessageId = Math.max(lastMessageId, m.id);
                chatMessagesDiv.scrollTop = chatMessagesDiv.scrollHeight;
            });
        });

        chatInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                chatSend.click();
            }
        });

        openChatBtn.addEventListener('click', openChat);
        closeChatBtn.addEventListener('click', closeChat);

        // Quick filter actions
        const filterMyPosts = document.getElementById('filter-my-posts');
        const filterLostFound = document.getElementById('filter-lost-found');
        const currentUserId = {{ auth()->id() }};
        let activeFilter = null; // 'mine' | 'lost' | null

        function applyFilters() {
            const cards = document.querySelectorAll('.post-card');
            cards.forEach(card => {
                const authorId = parseInt(card.getAttribute('data-author-id'));
                const isLost = card.getAttribute('data-lost-and-found') === '1';
                let visible = true;
                if (activeFilter === 'mine') visible = authorId === currentUserId;
                if (activeFilter === 'lost') visible = isLost;
                card.style.display = visible ? '' : 'none';
            });
        }

        function toggleFilter(type) {
            activeFilter = (activeFilter === type) ? null : type;
            // simple active state feedback
            if (filterMyPosts) filterMyPosts.classList.toggle('active', activeFilter === 'mine');
            if (filterLostFound) filterLostFound.classList.toggle('active', activeFilter === 'lost');
            applyFilters();
        }

        if (filterMyPosts) filterMyPosts.addEventListener('click', () => toggleFilter('mine'));
        if (filterLostFound) filterLostFound.addEventListener('click', () => toggleFilter('lost'));
    </script>
</body>
</html>