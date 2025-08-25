<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="C:\Program Files\php\bracu_social\resources\css\app.css">
    <title>Document</title>
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

.register-form {
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

.register-form input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    width: 100%;
    box-sizing: border-box;
}

.register-form input:focus {
    border-color: #0073e6;
    outline: none;
}

.register-form button {
    background: #0073e6;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    transition: background 0.2s;
}

.register-form button:hover {
    background: #005bb5;
}

</style>
<body>
    <h1>BRACU SOCIAL</h1>
    <h2>Register</h2>
    <form action="/register" method="POST" class="register-form">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="department" placeholder="Department" required>
        <input type="text" name="student_id" placeholder="Student ID" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Register</button>
    </form>
</body>
</html>