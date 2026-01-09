<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Mettre à jour un auteur</h1>
    <form action="{{ route('auteurs.update', $auteur) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="{{ $auteur->nom }}" required>
        </div>
        <div>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" value="{{ $auteur->prenom }}" required>
        </div>
        <button type="submit">Mettre à jour</button>
    </form>

</body>
</html>
