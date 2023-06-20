<!DOCTYPE html>
<html>
<head>
    <title>Expert Account Reactivation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        .form-group .error-message {
            color: red;
            margin-top: 5px;
        }

        .form-group .success-message {
            color: green;
            margin-top: 5px;
        }

        .form-group .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .form-group .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Expert Account Reactivation</h1>
    <div class="container">
        <form action="process_registration.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="reactivate" class="submit-btn">
            </div>
        </form>
    </div>
</body>
</html>
