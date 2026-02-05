<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Validation Import CSV</title>
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" />

  <style>

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #2779bd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            border: none;
            margin: 5px;
            transition: 0.3s;
        }

        .btn-accept {
            background-color: #28a745;
            color: white;
        }

        .btn-accept:hover {
            background-color: #218838;
        }

        .btn-ignore {
            background-color: #dc3545;
            color: white;
        }

        .btn-ignore:hover {
            background-color: #c82333;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
        }

        .back:hover {
            background-color: #495057;
        }

        .radio-group {
            display: flex;
            justify-content: center;
            gap: 15px; /* espace entre les options */
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 5px; /* espace entre le bouton radio et le texte */
            cursor: pointer;
        }
        .summary {
            font-size: 1.1em;
            margin-bottom: 20px;
            text-align: center;
        }

        .btn-confirm {
            display: inline-block;
            background-color: #007bff; /* bleu vif */
            color: white;
            padding: 12px 25px;
            font-size: 1em;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            margin-top: 20px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .btn-confirm:hover {
            background-color: #0056b3; /* bleu plus foncé au survol */
            transform: translateY(-2px) scale(1.05); /* léger effet de “pop” */
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

       .btn-home {
            display: inline-block;
            background-color: #6c757d; /* gris neutre */
            color: white;
            margin-top: 20px;
            padding: 12px 25px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1em;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .btn-home:hover {
            background-color: #495057; /* un peu plus foncé au survol */
            transform: translateY(-2px) scale(1.05); /* effet léger de “pop” */
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }



  </style>

</head>
<body>
  <div class="container">
    <h1>Validation Import CSV</h1>
    <p class="summary">{{ count($conflits) }} conflit(s) détecté(s). Choisissez d’importer ou d’ignorer.</p>

    <form action="{{ route('auteurs.import.confirm') }}" method="POST">
      @csrf
      <table>
        <thead>
          <tr>
            <th>ID existant</th>
            <th>Ancien Nom</th>
            <th>Ancien Prénom</th>
            <th>Nouveau Nom</th>
            <th>Nouveau Prénom</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($conflits as $index => $conflit)
            <tr>
              <td>{{ $conflit['id'] }}</td>
              <td>{{ $conflit['ancien_nom'] }}</td>
              <td>{{ $conflit['ancien_prenom'] }}</td>
              <td>{{ $conflit['nouveau_nom'] }}</td>
              <td>{{ $conflit['nouveau_prenom'] }}</td>
              <td class="actions">
                <input type="hidden" name="conflits[{{ $index }}][id]" value="{{ $conflit['id'] }}" />
                <input type="hidden" name="conflits[{{ $index }}][nouveau_nom]" value="{{ $conflit['nouveau_nom'] }}" />
                <input type="hidden" name="conflits[{{ $index }}][nouveau_prenom]" value="{{ $conflit['nouveau_prenom'] }}" />

                <label class="radio-label">
                  <input type="radio" name="actions[{{ $index }}]" value="accept" required />
                  <span>Importer</span>
                </label>

                <label class="radio-label">
                  <input type="radio" name="actions[{{ $index }}]" value="ignore" required />
                  <span>Ignorer</span>
                </label>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <button type="submit" class="btn-confirm">Confirmer les choix</button>
    </form>

    <a href="{{ route('auteurs.import.form') }}" class="btn btn-home">⬅ Retour à l’import CSV</a>
  </div>
</body>
</html>
