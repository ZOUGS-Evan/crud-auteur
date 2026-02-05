<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voir un auteur</title>

     <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

</head>
<body>
    <div class="container">
        <h1>Voir un auteur</h1>
        <p><strong>Nom:</strong> {{ $auteur->nom }}</p>
        <p><strong>Prenom:</strong> {{ $auteur->prenom }}</p>


        <h2>Photo de {{ $auteur->nom }} {{ $auteur->prenom }}</h2>
        @if($auteur->image)
            <img src="{{ asset('storage/' . $auteur->image) }}" style="max-width: 500px;">
        @else
            <p><strong>Aucune image disponible.</strong></p>
        @endif

         <div style="margin-top: 20px;">
            <a href="{{ route('auteurs.index') }}" class="btn-home-1">⬅ Retour à la liste des auteurs</a>
        </div>


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
        background: #f0f4f8;
        color: #333;
        padding: 20px;
    }

    /* Conteneur central */
    .container {
        max-width: 700px;
        width: 90%;
        margin: 40px auto;
        padding: 40px 30px;
        background-color: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    /* Titres */
    h1 {
        text-align: center;
        color: #2779bd;
        margin-bottom: 30px;
        font-size: 2rem;
    }

    /* Formulaire */
    form div {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    input[type="text"],
    input[type="file"] {
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="file"]:focus {
        outline: none;
        border-color: #2779bd;
        box-shadow: 0 0 5px rgba(39,121,189,0.3);
    }

    /* Boutons */
    button, .btn-home-1 {
        display: inline-block;
        background-color: #2779bd;
        color: white;
        padding: 12px 25px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: bold;
        font-size: 1rem;
        cursor: pointer;
        border: none;
        transition: all 0.3s ease, box-shadow 0.3s ease;
    }

    button:hover,
    .btn-home-1:hover {
        background-color: #1b4f8b;
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    /* Image auteur */
    img {
        max-width: 200px;
        border-radius: 10px;
        margin-top: 40px;
        margin-bottom: 20px;
    }

    /* Paragraphes pour détails */
    p {
        font-size: 1.1rem;
        margin-bottom: 10px;
        color: #555;
    }

    /* Responsive */
    @media(max-width: 500px) {
        .container { padding: 30px 20px; }
        h1 { font-size: 1.5rem; }
        button, .btn-home-1 { padding: 10px 20px; font-size: 0.95rem; }
    }

 </style>
