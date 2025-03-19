<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nuovo messaggio di contatto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .message-content {
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 4px solid #0066cc;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 12px;
            color: #666;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Nuovo messaggio dal form di contatto</h2>
        </div>
        
        <p><strong>Da:</strong> {{ $contactName }} ({{ $contactEmail }})</p>
        <p><strong>Oggetto:</strong> {{ $contactSubject }}</p>
        
        <div class="message-content">
            {{ $contactMessage }}
        </div>
        
        <div class="footer">
            <p>Questo messaggio è stato inviato tramite il form di contatto sul sito Noleggio EV.</p>
        </div>
    </div>
</body>
</html>