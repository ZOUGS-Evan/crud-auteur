<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des auteurs</title>


       <style>
        table {
            border-collapse: collapse;
            width: 50%;
            border: 2px solid black;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }


            .btn-delete {
            background-color: #e3342f;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 1.2s ease;
        }

        .btn-delete:hover {
            background-color: #cc1f1a;
            transform: scale(1.05);
        }

        .btn-delete:active {
            transform: scale(0.95);
        }



        .btn-home {
    display: inline-block;
    background-color: #b82888;
    color: white;
    padding: 8px 15px;
    border-radius: 15px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-home:hover {
    background-color: #b82888;
    transform: scale(1.05);
    }

    </style>




</head>
<body>
    <div style="min-height:100vh; background-color:#ffffff;">


    <h1>Voici la liste des auteurs</h1>

    <br><br>

      <a href="{{ route('auteurs.create') }}">Ajouter un auteur</a><br><br><br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(count($auteurs) == 0)
            <tr>
                <td colspan="3">Aucun auteur trouvé.</td>
            </tr>
            @endif
            @foreach ($auteurs as $auteur)
                <tr>
                    <td>{{ $auteur->id }}</td>
                    <td>{{ $auteur->nom }}</td>
                    <td>{{ $auteur->prenom }}</td>
                    <td style="display: flex; gap: 10px;">

                        <a href ="{{ route('auteurs.edit', $auteur) }}">Modifier un auteur</a>
                        <a href ="{{ route('auteurs.show', $auteur) }}">Voir un auteur</a>

                        <form action="{{ route('auteurs.destroy', $auteur) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet auteur ?')">Supprimer</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>

    <a href="{{ url('/') }}" class="btn-home">⬅ Retour à l'accueil</a>


</body>

</html>
