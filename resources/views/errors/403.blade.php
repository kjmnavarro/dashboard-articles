<!-- resources/views/errors/403.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        .error-container {
            max-width: 600px;
            padding: 30px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 3rem;
            color: #dc3545;
        }
        p {
            font-size: 1.2rem;
            margin: 20px 0;
        }
        .btn-home {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>403</h1>
        <p>You do not have permission to access this resource.</p>
        <a href="{{ url('/') }}" class="btn btn-info btn-home">Go to Home</a>
    </div>
</body>
</html>
