<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Search Results - BRACU Social</title>
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
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
        min-height: 100vh;
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

    /* Search Section */
    .search-section {
        background: #ffffff;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.04);
        border: 1px solid #e8ecf0;
        margin-bottom: 20px;
    }

    .search-section h2 {
        color: #1a1a1a;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 20px;
        text-align: center;
    }

    .search-container {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
    }

    .search-input {
        flex: 1;
        padding: 12px 16px;
        border: 2px solid #e8ecf0;
        border-radius: 12px;
        font-size: 16px;
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
        background: #0073e6;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .search-btn:hover {
        background: #0056b3;
        transform: translateY(-1px);
    }

    .search-info {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 20px;
    }

    /* Results Section */
    .results-section {
        background: #ffffff;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.04);
        border: 1px solid #e8ecf0;
    }

    .results-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .user-card {
        background: #fafbfc;
        border: 1px solid #e8ecf0;
        border-radius: 12px;
        padding: 20px;
        transition: all 0.2s ease;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
    }

    .user-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        border-color: #0073e6;
        text-decoration: none;
        color: inherit;
    }

    .user-name {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .user-department {
        font-size: 14px;
        color: #0073e6;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .user-id {
        font-size: 12px;
        color: #6b7280;
    }

    .no-results {
        text-align: center;
        padding: 40px 20px;
        color: #6b7280;
        font-size: 16px;
    }

    .no-results-icon {
        font-size: 48px;
        margin-bottom: 16px;
        display: block;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #0073e6;
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 20px;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .back-link:hover {
        background: #f0f8ff;
        transform: translateX(-2px);
    }

</style>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="main-title">BRACU SOCIAL</div>
            <div class="nav-bar">
                <div class="nav-left">
                    <div class="nav-links">
                        <a href="/dashboard" class="nav-link">Dashboard</a>
                        <a href="/profile" class="nav-link">Profile</a>
                        <a href="#" class="nav-link">Exchange</a>
                        <a href="#" class="nav-link">Lost&Found</a>
                    </div>
                </div>
                <a href="/logout" class="logout-btn">Logout</a>
            </div>
        </div>

        <!-- Back to Dashboard Link -->
        <a href="/dashboard" class="back-link">
            ← Back to Dashboard
        </a>

        <!-- Search Section -->
        <div class="search-section">
            <h2>Search Users</h2>
            <form action="/search-users" method="GET">
                <div class="search-container">
                    <input type="text" name="query" placeholder="Search by name..." class="search-input" value="{{ $query }}">
                    <button type="submit" class="search-btn">Search</button>
                </div>
            </form>
            
            @if($query)
                <div class="search-info">
                    Search results for: <strong>"{{ $query }}"</strong>
                    @if($users->count() > 0)
                        - Found {{ $users->count() }} user(s)
                    @endif
                </div>
            @endif
        </div>

        <!-- Results Section -->
        <div class="results-section">
            @if($query && $users->count() > 0)
                <div class="results-grid">
                    @foreach($users as $user)
                        <a href="/user/{{ $user->id }}" class="user-card">
                            <div class="user-name">{{ $user->name }}</div>
                            <div class="user-department">{{ $user->department }}</div>
                            <div class="user-id">ID: {{ $user->student_id }}</div>
                        </a>
                    @endforeach
                </div>
            @elseif($query && $users->count() == 0)
                <div class="no-results">
                    <span class="no-results-icon">🔍</span>
                    <div>No users found for "{{ $query }}"</div>
                    <div style="margin-top: 8px; font-size: 14px;">Try searching with different keywords or check the spelling.</div>
                </div>
            @else
                <div class="no-results">
                    <span class="no-results-icon">👥</span>
                    <div>Search for users by name</div>
                    <div style="margin-top: 8px; font-size: 14px;">Enter a name in the search box above to find other users.</div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
