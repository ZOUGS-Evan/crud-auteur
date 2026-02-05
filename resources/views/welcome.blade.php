<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>

     <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

</head>
<body>
    <div class="welcome-container">
        <h1>Bienvenue sur notre application !</h1>
        <p>Gérez facilement vos auteurs : ajoutez, modifiez, supprimez et parcourez-les en toute simplicité.</p>

        <a href="{{ route('auteurs.index') }}" class="btn-home"> Aller à la page des auteurs</a>
    </div>
</body>
</html>


  <style>
        /* Reset minimal */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .welcome-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 70px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 5000px;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #2779bd;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 40px;
            color: #555;
        }

        .btn-home {
            display: inline-block;
            background-color: #4f83d1;
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1rem;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .btn-home:hover {
            background-color: #7caacf;
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        /* Animation subtile du titre */
        h1 {
            animation: slideDown .8s ease-out;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media(max-width: 500px) {
            h1 { font-size: 2rem; }
            p { font-size: 1rem; }
            .btn-home { padding: 10px 20px; font-size: 1rem; }
        }
    </style>
