<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des auteurs</title>

     <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 40px;
            color: #222;
        }

        .container {
            width: 70%;
            max-width: 2000px;
            margin: 0 auto;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border-bottom: 1px solid #ddd;
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            max-width: 80px;
            border-radius: 8px;
        }

        .btn {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 15px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-home {
            background-color: #6c757d;
            color: white;
        }

        .btn-home:hover {
            background-color: #495057;
            transform: scale(1.05);
        }

        .btn-delete {
            background-color: #e3342f;
            color: white;
            border: none;
            padding: 10px 10px;
            border-radius: 15px;
            font-weight: bold;
        }

        .btn-delete:hover {
            background-color: #cc1f1a;
            transform: scale(1.05);
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin-top: 30px;
            gap: 10px;
        }

        .pagination li a {
            padding: 8px 12px;
            text-decoration: none;
            color: #4CAF50;
            border: 1px solid #4CAF50;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .pagination li a:hover {
            background-color: #4CAF50;
            color: white;
        }

        .pagination .active span {
            padding: 8px 12px;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        /* Barre de recherche */
        form.search-form {
            display: flex;
            gap: 10px;
            flex: 1;
        }

        form.search-form input[type="text"] {
            flex: 1;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        form.search-form input[type="text"]:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76,175,80,0.5);
        }


        .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #f8f9fa;
        color: #777;
        padding: 15px 40px;
        display: flex;
        justify-content: center;
        gap: 120px;
        font-size: 0.95rem;
        border-top: 1px solid #ddd;
        z-index: 1000;
        }

    </style>


</head>


<body>
    <div class="container">

        <div style="text-align: center; margin-bottom: 60px;">
            <h1>Liste des auteurs</h1>
        </div>


        <!-- Barre de recherche + bouton alignés sur la même ligne -->

        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; margin-bottom: 30px;">
            <form method="GET" action="{{ route('auteurs.index') }}" class="search-form" style="flex: 1; margin-right: 40px;">
                <input type="text" name="search" placeholder="Rechercher un auteur..." value="{{ request('search') }}"
                style="padding: 14px 16px; font-size: 1.2rem; border-radius: 10px; border: 1px solid #ccc; width: 100%;">
                <button type="submit" class="btn btn-home">🔍 Rechercher</button>
            </form>


            <a href="{{ route('auteurs.create') }}" class="btn btn-home">Ajouter un auteur</a>
            <a href="{{ route('auteurs.export.csv') }}" class="btn btn-home" style="margin-left: 10px;">📥 Exporter CSV</a>
            <a href="{{ route('auteurs.import.form') }}" class="btn btn-home" style="margin-left: 10px;">📤 Importer CSV</a>
        </div>


        <span style="display: block; margin-top: 10px; color: #555; font-weight: bold;">
            {{ $auteurs->total() }} auteur(s) trouvé(s).
        </span>


        <span style="display: block; margin-top: 10px; color: #555; font-weight: bold;">
            {{ $auteurs->whereNotNull('image')->count() }} auteur(s) avec une photo.
        </span>




        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(count($auteurs) == 0)
                    <tr>
                        <td colspan="5" style="text-align:center;">Aucun auteur trouvé.</td>
                    </tr>
                @endif
                @foreach ($auteurs as $auteur)
                    <tr>
                        <td>{{ $auteur->id }}</td>
                        <td>{{ $auteur->nom }}</td>
                        <td>{{ $auteur->prenom }}</td>
                        <td>
                            @if($auteur->image)
                                <span style="color: green; font-weight: bold;">Image disponible</span>
                            @else
                               <span style="color: red; font-weight: bold;">Aucune image</span>
                            @endif
                        </td>

                        <td class="actions">
                            <a href="{{ route('auteurs.edit', $auteur) }}" class="btn btn-home">Modifier</a>
                            <a href="{{ route('auteurs.show', $auteur) }}" class="btn btn-home">Voir</a>
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

        <div style="margin-top: 25px;">
            <a href="{{ url('/') }}" class="btn btn-home">⬅ Retour à l'accueil</a>
        </div>


        <div class="pagination-container">
            {{ $auteurs->links('pagination::bootstrap-4') }}
        </div>
    </div>


<footer class="footer">
    <span>© {{ date('M/Y') }}  Tous droits réservés.</span>
</footer>

</body>
</html>
