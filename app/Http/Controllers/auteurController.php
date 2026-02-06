<?php

namespace App\Http\Controllers;

use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) // Ajout de Request $request pour gérer la recherche
    {
        $search = $request->input('search'); // Récupère le terme de recherche depuis la requête
        if ($search) { // Si un terme de recherche est présent
            $auteurs = Auteur::where('nom', 'like', "%$search%") // Recherche par nom
                ->orWhere('prenom', 'like', "%$search%") // Ou par prénom
                ->paginate(5); // Pagination avec 5 auteurs par page
        } else {
            $auteurs = Auteur::paginate(5); // Pagination avec 5 auteurs par page
        }

        return view('auteur.index', [
            'auteurs' => $auteurs, // Passe les auteurs paginés à la vue
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auteur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);
        $data = $request->all(); // Récupère toutes les données du formulaire
        if ($request->hasFile('image')) { // Vérifie si une image a été téléchargée
            $path = $request->file('image')->store('auteurs', 'public'); // Stocke l'image dans le dossier 'auteurs' du disque 'public'
            $data['image'] = $path; // Ajoute le chemin de l'image aux données
        }
        Auteur::create($data); // Utilise les données modifiées pour créer l'auteur

        return redirect()->route('auteurs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Auteur $auteur)
    {
        return view('auteur.show', [
            'auteur' => $auteur,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auteur $auteur)
    {
        return view('auteur.edit', [
            'auteur' => $auteur,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Auteur $auteur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('auteurs', 'public');
            $data['image'] = $path;
        }
        $auteur->update($data);

        return redirect()->route('auteurs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auteur $auteur)
    {
        $auteur->delete();

        return redirect()->route('auteurs.index');
    }

    public function exportCsv()
    {
        $auteurs = Auteur::all();
        $filename = 'Liste_Auteurs.csv';
        $handle = fopen($filename, 'w+'); // Ouvre un fichier en écriture

        fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // Ajoute l BOM pour UTF-8
        fputcsv($handle, ['ID', 'Nom', 'Prenom'], ';'); // Écrit l'en-tête du CSV

        foreach ($auteurs as $auteur) {
            fputcsv($handle, [$auteur->id, $auteur->nom, $auteur->prenom], ';'); // Écrit chaque auteur dans le CSV
        }
        fclose($handle); // Ferme le fichier

        return response()->download($filename); // Télécharge le fichier
    }

    public function importCsvForm() // Affiche le formulaire d'importation CSV
    {
        return view('auteur.import');
    }




    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file'); // Récupère le fichier CSV téléchargé
        $handle = fopen($file->getRealPath(), 'r'); // Ouvre le fichier pour la lecture

        $header = fgetcsv($handle, 0, ';'); // CSV séparé par ;

        $conflits = []; // Pour stocker les conflits détectés


        while (($row = fgetcsv($handle, 0, ';')) !== false) { // Lit chaque ligne du CSV

            try {

                $data = array_combine($header, $row); // Combine les en-têtes avec les valeurs

                // Vérifie si un auteur existe avec ce nom ou ce prénom
                $auteur = Auteur::where('nom', $data['Nom'])
                    ->orWhere('prenom', $data['Prenom'])
                    ->first();

                // 1️⃣ Doublon exact → ignorer
                if ($auteur &&
                $auteur->nom === $data['Nom'] &&
                $auteur->prenom === $data['Prenom']) {
                    continue;
                }

                // 2️⃣ Conflit → nom ou prénom différent
                if ($auteur &&
                ($auteur->nom !== $data['Nom'] || $auteur->prenom !== $data['Prenom'])) {

                    $conflits[] = [
                        'id' => $auteur->id,
                        'ancien_nom' => $auteur->nom,
                        'ancien_prenom' => $auteur->prenom,
                        'nouveau_nom' => $data['Nom'],
                        'nouveau_prenom' => $data['Prenom'],
                    ];

                    continue;
                }
            } catch (\Exception $e) {
                echo 'Erreur lors de la lecture du fichier CSV : '.$e->getMessage().'. Voici les donnée présentes dans le array DATA : '.print_r($data, true);
                var_dump($header);
                var_dump($row);
                var_dump($data);
                die();
            }

            // 3️⃣ Aucun auteur → import direct
            Auteur::create([
                'nom' => $data['Nom'],
                'prenom' => $data['Prenom'],
            ]);
        }

        fclose($handle);

        // Si conflits → rediriger vers page de validation
        if (! empty($conflits)) {
            return view('auteur.import_validation', compact('conflits'));
        }

        return redirect()->route('auteurs.index');
    }



      public function confirmImport(Request $request)
        {
            $conflits = $request->input('conflits', []); // Récupère les conflits depuis la requête
            $actions = $request->input('actions', []); // Récupère les actions (accept/ignore) depuis la requête

            foreach ($conflits as $index => $conflit) { // Parcourt chaque conflit
                if (isset($actions[$index]) && $actions[$index] === 'accept') { // Si l'action est "accept"
                    $auteur = Auteur::find($conflit['id']); // Trouve l'auteur par ID
                    if ($auteur) { // Si l'auteur existe, met à jour ses informations
                        $auteur->update([
                            'nom' => $conflit['nouveau_nom'],
                            'prenom' => $conflit['nouveau_prenom'],
                        ]);
                    }
                }

            }

            return redirect()->route('auteurs.index');
        }


}


    /*

   public function importCsv(Request $request): RedirectResponse
    {
        $request ->validate([
            'csv_file' => ['required', 'file', 'mimes:csv,txt'],
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');

        // Lecture du header
        $rawHeader = fgetcsv($handle, 0, ',');

        // Nettoyage des clés
        $header = array_map(function ($key) {
        return trim($key);
        }, $rawHeader);


        $doublons = 0;
        $importes = 0;


        while (($row = fgetcsv($handle, 0, ',')) !== false) {

            $data = array_combine($header, $row);

            $societe = CompteT::where('CT_Intitule', 'LIKE', $data['Raison Sociale'])->first();
            $product =Product::where('nom', '=', $data["Libellé produit"])->first();


                $licence = Licence::where('produit_id', $product->id)
                    ->where('societe_id', $societe->CT_Num)
                    ->first();

                if ($licence) {
                    $doublons++;
                    continue; // on passe à la ligne suivante si il y a un doublon
                }


                Licence::create([
                'produit_id'        => $product->id,
                'cle'               => $data['N° Série'],
                'reference_produit' => $data['Référence produit'] ?? null,
                'code_activation'   => null,
                'date_expiration'   => $data['Date fin contrat'] ?? null,
                'societe_id'        => $societe->CT_Num,
                'numero_serie'      => $data['N° Série'] ?? null,
                'version_disponible'=> $data['Version'] ?? null,
                'cle_referencement' => null,
                'nb_users'          => null,
            ]);

            $importes++;
        }


         if ($doublons > 0) {
        return redirect()->route('licences.index')

            ->with('warning', "$importes licences importées. $doublons doublon(s) ignoré(s).");
         }

      return redirect()->route('licences.index')
            ->with('success', "Licence créée avec succès, $importes licences importées.");

    }




    public function importForm(): Response // Affiche le formulaire d'importation de licences
    {

        return Inertia::render('licences/import'); // Affiche le formulaire d'importation de licences
    }
}

*/
