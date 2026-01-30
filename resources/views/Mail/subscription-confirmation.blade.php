<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to BOSSKU.TOURS</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #1a1a1a 0%, #111 100%);
            padding: 40px 20px;
            text-align: center;
        }

        .logo {
            max-width: 150px;
            height: auto;
        }

        .content {
            padding: 40px 30px;
        }

        h1 {
            color: #1a1a1a;
            margin-top: 0;
            font-size: 28px;
        }

        p {
            margin-bottom: 20px;
            font-size: 16px;
            color: #555;
        }

        .highlight {
            background-color: #fff8e1;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 25px 0;
            border-radius: 4px;
        }

        .cta-button {
            display: inline-block;
            background: #1a1a1a;
            color: white;
            padding: 14px 28px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 20px 0;
            transition: background 0.3s;
        }

        .cta-button:hover {
            background: #333;
        }

        .footer {
            background: #f5f5f5;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #eee;
            font-size: 14px;
            color: #777;
        }

        .unsubscribe {
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }

        .social-links {
            margin: 20px 0;
        }

        .social-links a {
            margin: 0 10px;
            color: #1a1a1a;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://yourdomain.com/img/Bossku.tours.png" alt="BOSSKU.TOURS" class="logo">
        </div>

        <div class="content">
            <h1>Welcome Aboard! ✈️</h1>

            <p>Hello,</p>

            <p>Thank you for subscribing to <strong>BOSSKU.TOURS</strong> newsletter. We're thrilled to have you on board!</p>

            <div class="highlight">
                <p><strong>What to expect:</strong></p>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>🎯 Curated travel inspirations</li>
                    <li>🗺️ Exclusive routes and hidden gems</li>
                    <li>📅 Early access to special departures</li>
                    <li>💎 Member-only promotions</li>
                </ul>
            </div>

            <p>Our next newsletter will arrive in your inbox soon. In the meantime, you can:</p>

            <a href="https://yourdomain.com/Tour" class="cta-button">Explore Our Tours</a>

            <p>Journeys worth remembering. Stories worth opening.</p>

            <p>Happy travels,<br>
                <strong>The BOSSKU.TOURS Team</strong>
            </p>
        </div>

        <div class="footer">
            <div class="social-links">
                <a href="https://www.instagram.com/bossku.tours/" target="_blank">Instagram</a>
                <a href="https://wa.me/6285727767777" target="_blank">WhatsApp</a>
                <a href="https://facebook.com" target="_blank">Facebook</a>
                <a href="https://youtube.com" target="_blank">YouTube</a>
            </div>

            <p>© {{ $currentYear }} BOSSKU.TOURS. All rights reserved.</p>
            <p>Jl. Example Street No. 123, Jakarta, Indonesia</p>

            <div class="unsubscribe">
                <p>You received this email because you subscribed to BOSSKU.TOURS newsletter.</p>
                <p>
                    <a href="https://yourdomain.com/unsubscribe?email={{ urlencode($email) }}&token={{ $unsubscribeToken }}"
                        style="color: #999; text-decoration: underline;">
                        Unsubscribe from future emails
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>