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

    .post-options {
        margin: 16px 0;
        padding: 16px;
        background: #f8f9fa;
        border-radius: 12px;
        border: 1px solid #e8ecf0;
    }

    .checkbox-option {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: 16px;
        font-weight: 500;
        color: #2d3748;
        position: relative;
        padding-left: 35px;
    }

    .checkbox-option input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .checkmark {
        position: absolute;
        top: 2px;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #fff;
        border: 2px solid #d1d5db;
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .checkbox-option:hover .checkmark {
        border-color: #0073e6;
        background-color: #f0f8ff;
    }

    .checkbox-option input:checked ~ .checkmark {
        background-color: #0073e6;
        border-color: #0073e6;
    }

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    .checkbox-option input:checked ~ .checkmark:after {
        display: block;
    }

    .checkbox-option .checkmark:after {
        left: 6px;
        top: 2px;
        width: 6px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
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

    /* Post Actions Buttons */
    .post-actions-buttons {
        display: flex;
        gap: 12px;
        margin-top: 12px;
        flex-wrap: wrap;
    }

    .mark-resolved-form {
        margin: 0;
    }

    .mark-resolved-btn {
        background: #10b981;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .mark-resolved-btn:hover {
        background: #059669;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .mark-resolved-btn .resolved-icon {
        background: white;
        color: #10b981;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
    }

    /* Poll Creation Styles */
    .poll-creation-section {
        margin: 16px 0;
        padding: 20px;
        background: #f0f8ff;
        border-radius: 12px;
        border: 2px solid #0073e6;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .poll-question-section {
        margin-bottom: 20px;
    }

    .poll-question-section label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #2d3748;
    }

    .poll-question-section input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e8ecf0;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.2s ease;
    }

    .poll-question-section input:focus {
        outline: none;
        border-color: #0073e6;
        box-shadow: 0 0 0 3px rgba(0, 115, 230, 0.1);
    }

    .poll-options-section label {
        display: block;
        margin-bottom: 12px;
        font-weight: 600;
        color: #2d3748;
    }

    .poll-option-input {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        gap: 8px;
    }

    .poll-option-input input {
        flex: 1;
        padding: 10px 14px;
        border: 2px solid #e8ecf0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .poll-option-input input:focus {
        outline: none;
        border-color: #0073e6;
        box-shadow: 0 0 0 3px rgba(0, 115, 230, 0.1);
    }

    .remove-option-btn {
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .remove-option-btn:hover {
        background: #c82333;
        transform: scale(1.1);
    }

    .add-option-btn {
        background: #28a745;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-top: 8px;
    }

    .add-option-btn:hover {
        background: #218838;
        transform: translateY(-1px);
    }

    .poll-settings {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #e8ecf0;
    }

    /* Poll Mode Styling */
    .post-content-fields.poll-mode {
        opacity: 0.7;
        background: #f8f9fa;
        padding: 16px;
        border-radius: 8px;
        border: 2px dashed #dee2e6;
    }

    .post-content-fields.poll-mode input,
    .post-content-fields.poll-mode textarea {
        background: #f8f9fa;
        border-color: #dee2e6;
    }

    .post-content-fields.poll-mode::before {
        content: "📊 Poll Mode - Post content is optional";
        display: block;
        font-size: 14px;
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 12px;
        text-align: center;
        font-style: italic;
    }

    /* Poll Display Styles */
    .poll-section {
        margin: 20px 0;
        padding: 20px;
        background: #f8fafc;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
    }

    .poll-question {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 8px;
    }

    .poll-question h4 {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin: 0;
        flex: 1;
    }

    .poll-type-badge {
        background: #0073e6;
        color: white;
        padding: 4px 12px;
        border-radius: 16px;
        font-size: 12px;
        font-weight: 500;
    }

    /* Poll Voting Interface */
    .poll-voting-form {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .poll-options {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .poll-option-label {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        background: white;
        border: 2px solid #e2e8f0;
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
        width: 18px;
        height: 18px;
        margin: 0;
    }

    .poll-option-label .poll-option-text {
        font-size: 16px;
        color: #2d3748;
        flex: 1;
    }

    .vote-btn {
        background: #0073e6;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        align-self: flex-start;
    }

    .vote-btn:hover {
        background: #005bb5;
        transform: translateY(-1px);
    }

    /* Poll Results Display */
    .poll-results {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .poll-option-result {
        position: relative;
    }

    .poll-option-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
        flex-wrap: wrap;
        gap: 8px;
    }

    .poll-option-result .poll-option-text {
        font-size: 16px;
        font-weight: 500;
        color: #2d3748;
    }

    .poll-option-stats {
        font-size: 14px;
        color: #6b7280;
        font-weight: 500;
    }

    .poll-progress-bar {
        width: 100%;
        height: 8px;
        background: #e2e8f0;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 8px;
    }

    .poll-progress-fill {
        height: 100%;
        background: linear-gradient(135deg, #0073e6, #005bb5);
        border-radius: 4px;
        transition: width 0.6s ease;
    }

    .your-vote-indicator {
        font-size: 12px;
        color: #10b981;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .poll-stats {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #e2e8f0;
        font-size: 14px;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .remove-vote-btn {
        background: #dc3545;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .remove-vote-btn:hover {
        background: #c82333;
        transform: translateY(-1px);
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

    .search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #ffffff;
        border: 1px solid #e8ecf0;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000;
        display: none;
    }

    .search-result-item {
        padding: 12px 16px;
        border-bottom: 1px solid #f1f3f4;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .search-result-item:last-child {
        border-bottom: none;
    }

    .search-result-item:hover {
        background-color: #f8f9fa;
    }

    .search-result-name {
        font-weight: 600;
        color: #1a1a1a;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .search-result-details {
        font-size: 12px;
        color: #6b7280;
    }

    .search-result-department {
        margin-right: 8px;
    }

    .no-results {
        padding: 16px;
        text-align: center;
        color: #6b7280;
        font-size: 14px;
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
                            <a href="#" class="nav-link">Resources</a>
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
                    <div class="poll-creation-section" id="poll_creation_section" style="display: none;">
                        <div class="poll-question-section">
                            <label for="poll_question">Poll Question:</label>
                            <input type="text" name="poll_question" id="poll_question" placeholder="What would you like to ask?">
                        </div>
                        
                        <div class="poll-options-section">
                            <label>Poll Options:</label>
                            <div class="poll-options-container" id="poll_options_container">
                                <div class="poll-option-input">
                                    <input type="text" name="poll_options[]" placeholder="Option 1" required>
                                    <button type="button" class="remove-option-btn" onclick="removePollOption(this)" style="display: none;">×</button>
                                </div>
                                <div class="poll-option-input">
                                    <input type="text" name="poll_options[]" placeholder="Option 2" required>
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
                <div class="post-card" data-post-id="{{$post->id}}">
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
                            <div class="post-time">{{$post->created_at->format('M j, Y \a\t g:i A')}}</div>
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
            <div class="search-section">
                <h3>Search Users</h3>
                <div class="search-container">
                    <input type="text" id="user-search" placeholder="Search by name..." class="search-input">
                    <div id="search-results" class="search-results"></div>
                </div>
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

        // Poll creation functionality
        function togglePollSection() {
            const checkbox = document.getElementById('has_poll_checkbox');
            const pollSection = document.getElementById('poll_creation_section');
            const postFields = document.getElementById('post_content_fields');
            const postTitle = document.getElementById('post_title');
            const postBody = document.getElementById('post_body');
            
            if (checkbox.checked) {
                pollSection.style.display = 'block';
                // Make poll question required
                document.getElementById('poll_question').required = true;
                
                // Make post title and body optional for polls
                postTitle.required = false;
                postBody.required = false;
                postTitle.placeholder = "Post Title (Optional for polls)";
                postBody.placeholder = "Additional thoughts (Optional for polls)";
                
                // Add visual indication that these are optional
                postFields.classList.add('poll-mode');
            } else {
                pollSection.style.display = 'none';
                // Remove required attribute
                document.getElementById('poll_question').required = false;
                // Clear poll data
                document.getElementById('poll_question').value = '';
                const optionInputs = document.querySelectorAll('input[name="poll_options[]"]');
                optionInputs.forEach(input => input.value = '');
                
                // Make post title and body required again for regular posts
                postTitle.required = true;
                postBody.required = true;
                postTitle.placeholder = "Post Title";
                postBody.placeholder = "Share your thoughts...";
                
                // Remove poll mode styling
                postFields.classList.remove('poll-mode');
            }
            updateRemoveButtons();
        }

        function addPollOption() {
            const container = document.getElementById('poll_options_container');
            const optionCount = container.querySelectorAll('.poll-option-input').length;
            
            if (optionCount < 6) { // Limit to 6 options
                const newOption = document.createElement('div');
                newOption.className = 'poll-option-input';
                newOption.innerHTML = `
                    <input type="text" name="poll_options[]" placeholder="Option ${optionCount + 1}" required>
                    <button type="button" class="remove-option-btn" onclick="removePollOption(this)">×</button>
                `;
                container.appendChild(newOption);
                updateRemoveButtons();
            }
        }

        function removePollOption(button) {
            const container = document.getElementById('poll_options_container');
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
            const container = document.getElementById('poll_options_container');
            const options = container.querySelectorAll('.poll-option-input');
            const removeButtons = container.querySelectorAll('.remove-option-btn');
            
            // Show/hide remove buttons based on option count
            removeButtons.forEach(button => {
                button.style.display = options.length > 2 ? 'flex' : 'none';
            });
        }

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
    </script>
</body>
</html>