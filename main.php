<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background: #f7f7f7;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url('https://www.w3schools.com/w3images/forest.jpg') no-repeat center center/cover;
            overflow: hidden;
        }

        .main-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.8);
            padding: 40px 50px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 600px;
        }

        header {
            font-size: 3.2rem;
            font-weight: 700;
            letter-spacing: 2px;
            color: green;
            margin-bottom: 30px;
            text-transform: uppercase;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.15);
        }

        button {
            background-color: green;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 18px 35px;
            font-size: 1.2rem;
            margin: 15px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
        }

        button:hover {
            background-color: #9b59b6;
            transform: scale(1.1) rotate(2deg);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(141, 68, 173, 0.6);
        }

        footer {
            position: absolute;
            bottom: 20px;
            font-size: 1rem;
            color: #2c3e50;
            opacity: 0.7;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1);
        }

        button:active {
            transform: scale(0.98);
        }

        @keyframes headerSlideIn {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        header {
            animation: headerSlideIn 1s ease-out forwards;
        }

        @media (max-width: 768px) {
            header {
                font-size: 2.5rem;
            }

            button {
                font-size: 1.1rem;
                padding: 14px 28px;
            }
        }

        @media (max-width: 480px) {
            .main-container {
                padding: 30px 20px;
            }

            header {
                font-size: 2rem;
            }

            button {
                font-size: 1rem;
                padding: 12px 24px;
            }

            footer {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>Welcome Our Beloved Partners</h1>
    </header>

    <main>
        <div class="main-container">
            <button onclick="window.location.href='spguide.php'">Sustainable Practices Guide</button>
            <button onclick="window.location.href='eventcalendar.php'">Event Calendar</button>
            <button onclick="window.location.href='landsection.php'">Land Section</button>
            <button onclick="window.location.href='watersection.php'">Water Section</button>
            <button onclick="window.location.href='airsection.php'">Air Section</button>
        </div>
    </main>

    <footer>
        <p>The Guardians</p>
    </footer>

</body>
</html>
