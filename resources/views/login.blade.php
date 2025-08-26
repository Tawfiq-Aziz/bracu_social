<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background: #f9f9f9;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 40px;
}

h1, h2 {
    margin: 10px 0;
    font-weight: 600;
    text-align: center;
}

.login-form {
    background: #fff;
    padding: 20px 25px;
    border: 1px solid #ddd;
    border-radius: 8px;
    width: 100%;
    max-width: 350px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.login-form input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    width: 100%;
    box-sizing: border-box;
}

.login-form input:focus {
    border-color: #0073e6;
    outline: none;
}

.login-form button {
    background: #0073e6;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    transition: background 0.2s;
}

.login-form button:hover {
    background: #005bb5;
}

.back-link {
    margin-top: 15px;
    text-align: center;
}

.back-link a {
    color: #0073e6;
    text-decoration: none;
    font-size: 14px;
}

.back-link a:hover {
    text-decoration: underline;
}
</style>
<body>
    <h1>BRACU SOCIAL</h1>
    <h2>Login</h2>
    <form action="/login" method="POST" class="login-form">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>
    
    <div class="back-link">
        <a href="/">Back to Registration</a>
    </div>
</body>
</html>

