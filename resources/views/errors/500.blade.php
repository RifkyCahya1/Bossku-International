<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page - Page Not Found</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1a237e 0%, #311b92 100%);
            color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .error-container {
            max-width: 900px;
            width: 100%;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            display: grid;
            grid-template-columns: 1fr 1fr;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-content {
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .error-graphic {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.15);
            padding: 30px;
        }

        .error-code {
            font-size: 140px;
            font-weight: 800;
            line-height: 1;
            color: #ff4081;
            text-shadow: 3px 3px 0 rgba(0, 0, 0, 0.2);
            margin-bottom: 10px;
        }

        .error-title {
            font-size: 36px;
            margin-bottom: 15px;
            color: #e3f2fd;
        }

        .error-description {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #bbdefb;
        }

        .error-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 40px;
        }

        .btn {
            padding: 14px 28px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-primary {
            background: #ff4081;
            color: white;
            box-shadow: 0 5px 15px rgba(255, 64, 129, 0.3);
        }

        .btn-primary:hover {
            background: #f50057;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 64, 129, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        .error-details {
            background: rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
        }

        .error-details summary {
            font-weight: 600;
            cursor: pointer;
            padding: 5px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .error-details-content {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 14px;
            line-height: 1.5;
            color: #e1f5fe;
        }

        .robot-container {
            position: relative;
            width: 280px;
            height: 280px;
        }

        .robot {
            width: 200px;
            height: 200px;
            background: #3949ab;
            border-radius: 50% 50% 45% 45%;
            position: relative;
            animation: robotFloat 4s ease-in-out infinite;
        }

        @keyframes robotFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .robot:before,
        .robot:after {
            content: '';
            position: absolute;
            background: #5c6bc0;
        }

        .robot:before {
            width: 60px;
            height: 30px;
            border-radius: 20px;
            top: 40px;
            left: 50%;
            transform: translateX(-50%);
        }

        .robot:after {
            width: 100px;
            height: 15px;
            border-radius: 10px;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
        }

        .eye {
            position: absolute;
            width: 30px;
            height: 30px;
            background: white;
            border-radius: 50%;
            top: 55px;
            animation: blink 3s infinite;
        }

        .eye.left {
            left: 60px;
        }

        .eye.right {
            right: 60px;
        }

        .eye:before {
            content: '';
            position: absolute;
            width: 15px;
            height: 15px;
            background: #222;
            border-radius: 50%;
            top: 5px;
            left: 5px;
        }

        @keyframes blink {

            0%,
            45%,
            55%,
            100% {
                transform: scaleY(1);
            }

            50% {
                transform: scaleY(0.1);
            }
        }

        .antenna {
            position: absolute;
            width: 8px;
            height: 40px;
            background: #ff4081;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 4px 4px 0 0;
        }

        .antenna:before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: #ff4081;
            border-radius: 50%;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.7;
            }

            50% {
                opacity: 1;
            }
        }

        .error-bubbles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }

        .bubble {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatUp 15s infinite linear;
        }

        @keyframes floatUp {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 0.7;
            }

            90% {
                opacity: 0.7;
            }

            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        .search-container {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .search-input {
            flex: 1;
            padding: 12px 20px;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 16px;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .search-btn {
            padding: 12px 25px;
            background: #3949ab;
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .search-btn:hover {
            background: #303f9f;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .error-container {
                grid-template-columns: 1fr;
            }

            .error-code {
                font-size: 100px;
            }

            .error-title {
                font-size: 28px;
            }

            .error-content {
                padding: 40px 25px;
            }

            .robot-container {
                width: 220px;
                height: 220px;
                margin: 0 auto;
            }

            .robot {
                width: 160px;
                height: 160px;
            }

            .error-actions {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .error-actions {
                flex-direction: column;
            }

            .btn {
                justify-content: center;
            }

            .error-code {
                font-size: 80px;
            }

            .search-container {
                flex-direction: column;
            }
        }

        .footer-note {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #90caf9;
            opacity: 0.8;
        }

        .status-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #4caf50;
            animation: statusPulse 2s infinite;
        }

        @keyframes statusPulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-content">
            <div class="status-indicator">
                <div class="status-dot"></div>
                <span>Service Status: Operational</span>
            </div>

            <div class="error-code">404</div>
            <h1 class="error-title">Page Not Found</h1>
            <p class="error-description">
                The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
                Please check the URL for spelling errors or try one of the options below.
            </p>

            <div class="error-actions">
                <a href="/" class="btn btn-primary">
                    <i class="fas fa-home"></i> Back to Homepage
                </a>
                <a href="#" onclick="history.back()" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Go Back
                </a>
                <a href="mailto:support@example.com" class="btn btn-secondary">
                    <i class="fas fa-envelope"></i> Contact Support
                </a>
            </div>

            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search our website...">
                <button class="search-btn">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>

            <details class="error-details">
                <summary>
                    <i class="fas fa-info-circle"></i> Technical Details
                </summary>
                <div class="error-details-content">
                    <p><strong>Error Code:</strong> 404 - Not Found</p>
                    <p><strong>Description:</strong> The server cannot find the requested resource.</p>
                    <p><strong>Possible causes:</strong></p>
                    <ul>
                        <li>The URL might be misspelled</li>
                        <li>The page may have been moved or deleted</li>
                        <li>The link pointing to this page might be outdated</li>
                        <li>Temporary server issues</li>
                    </ul>
                    <p><strong>Timestamp:</strong> <span id="error-timestamp"></span></p>
                    <p><strong>Request ID:</strong> ERR-404-<span id="request-id"></span></p>
                </div>
            </details>

            <div class="footer-note">
                <p><i class="fas fa-clock"></i> Access Time: <span id="current-time"></span></p>
                <p>If you continue to experience issues, please contact our support team.</p>
            </div>
        </div>

        <div class="error-graphic">
            <div class="robot-container">
                <div class="robot">
                    <div class="antenna"></div>
                    <div class="eye left"></div>
                    <div class="eye right"></div>
                </div>
            </div>

            <div class="error-bubbles" id="bubbles"></div>
        </div>
    </div>

    <script>
        // Display current time
        function updateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                timeZoneName: 'short'
            };
            document.getElementById('current-time').textContent = now.toLocaleDateString('en-US', options);
            document.getElementById('error-timestamp').textContent = now.toISOString();
        }

        // Generate random request ID
        function generateRequestId() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let result = '';
            for (let i = 0; i < 8; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            document.getElementById('request-id').textContent = result;
        }

        updateTime();
        generateRequestId();
        setInterval(updateTime, 1000);

        // Create animated bubbles
        const bubblesContainer = document.getElementById('bubbles');

        for (let i = 0; i < 15; i++) {
            const bubble = document.createElement('div');
            bubble.classList.add('bubble');

            // Random size and position
            const size = Math.random() * 30 + 10;
            const left = Math.random() * 100;
            const delay = Math.random() * 15;
            const duration = Math.random() * 10 + 10;

            bubble.style.width = `${size}px`;
            bubble.style.height = `${size}px`;
            bubble.style.left = `${left}%`;
            bubble.style.animationDelay = `${delay}s`;
            bubble.style.animationDuration = `${duration}s`;

            bubblesContainer.appendChild(bubble);
        }

        // Simulate error logging
        console.error("Error 404: Page not found. Path: " + window.location.pathname);
        console.log("Request ID: ERR-404-" + document.getElementById('request-id').textContent);

        // Search functionality
        document.querySelector('.search-btn').addEventListener('click', function() {
            const searchInput = document.querySelector('.search-input');
            if (searchInput.value.trim()) {
                // In a real implementation, this would redirect to search results
                alert('Search functionality would normally redirect to search results for: "' + searchInput.value + '"');
                searchInput.value = '';
            } else {
                searchInput.focus();
            }
        });

        // Allow Enter key to trigger search
        document.querySelector('.search-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.querySelector('.search-btn').click();
            }
        });

        // Button effects
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function(e) {
                if (this.getAttribute('href') === '#') {
                    e.preventDefault();

                    // Add loading effect
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                    this.style.pointerEvents = 'none';

                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.style.pointerEvents = 'auto';
                        if (this.classList.contains('btn-primary')) {
                            window.location.href = '/';
                        }
                    }, 1500);
                }
            });
        });

        // Simulate network status check
        window.addEventListener('online', updateNetworkStatus);
        window.addEventListener('offline', updateNetworkStatus);

        function updateNetworkStatus() {
            const statusDot = document.querySelector('.status-dot');
            const statusText = document.querySelector('.status-indicator span');

            if (navigator.onLine) {
                statusDot.style.background = '#4caf50';
                statusText.textContent = 'Service Status: Operational';
            } else {
                statusDot.style.background = '#ff9800';
                statusText.textContent = 'Service Status: Offline - Check Connection';
            }
        }

        // Initialize network status
        updateNetworkStatus();
    </script>
</body>

</html>