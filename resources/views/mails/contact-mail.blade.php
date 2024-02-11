<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .contact-mail {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .contact-mail .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .contact-mail .content {
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .contact-mail .strong {
            font-weight: bold;
        }
        .contact-mail .message {
            margin-top: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="contact-mail">
        <div class="header">
            <h1>Contact Form Submission</h1>
        </div>
        <div class="content">
            <p>Hello Amala247,</p>
            <p>You have received a new contact form submission with the following details:</p>
            <p class="strong">Name:</p>
            <p>{{ $data['name'] }}</p>
            <p class="strong">Email:</p>
            <p>{{ $data['email'] }}</p>
            <p class="strong">Message:</p>
            <p class="contact-mail message">{{ $data['message'] }}</p>
        </div>
    </div>
</body>
</html>

