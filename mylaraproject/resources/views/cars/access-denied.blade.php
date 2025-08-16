<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Access Denied</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            padding: 40px 20px;
            color: #333;
            text-align: center;
        }
        .message-box {
            max-width: 450px;
            margin: 0 auto;
            background: white;
            padding: 30px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .emoji {
            font-size: 4rem;
            margin-bottom: 20px;
        }
        .btn-home {
            margin-top: 25px;
            padding: 10px 25px;
            background-color: #0d6efd;
            border: none;
            color: white;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-home:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <div class="emoji">🚫</div>
        <h2>Access Denied</h2>
        <p>
            Sorry, <strong>{{ $selectedUser->name }}</strong> is under 16 years old and cannot view cars yet.
        </p>
        <p>Please select another user from the previous page.</p>
        <button onclick="window.history.back()" class="btn-home">Go Back</button>
    </div>
</body>
</html>
