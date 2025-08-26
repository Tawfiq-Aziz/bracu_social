<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BRACU Social</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f9f9f9;
        color: #333;
        margin: 0;
        padding: 20px;
    }

    .header {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .welcome {
        font-size: 24px;
        font-weight: 600;
        color: #0073e6;
    }

    .logout-btn {
        background: #dc3545;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
    }

    .logout-btn:hover {
        background: #c82333;
    }

    .dashboard-content {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        text-align: center;
    }

    .dashboard-content h2 {
        color: #0073e6;
        margin-bottom: 20px;
    }

    .user-info {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 6px;
        margin: 20px 0;
        text-align: left;
    }

    .user-info p {
        margin: 8px 0;
        font-size: 16px;
    }

    .user-info strong {
        color: #0073e6;
    }
</style>
<body>
    <div class="header">
        <div class="welcome">Welcome to BRACU Social!</div>
        <a href="/logout" class="logout-btn">Logout</a>
    </div>

    <div class="dashboard-content">
        <h2>Dashboard</h2>
        <p>You have successfully logged in to your BRACU Social account.</p>
        
        <div class="user-info">
            <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Department:</strong> {{ auth()->user()->department }}</p>
            <p><strong>Student ID:</strong> {{ auth()->user()->student_id }}</p>
        </div>
        
        <p>This is your personal dashboard where you can manage your profile and interact with other BRACU students.</p>
    </div>
</body>
</html>