<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\PointerArrivals;
use App\Models\PointerDeparts;
Use Carbon\Carbon;

class UserController extends Controller
{
    //On liste les utilisateurs
    public function dashboard(Request $request) {
        // Réinitialiser les enregistrements d'arrivées et de départs de l'utilisateur pour la nouvelle journée
        $userId = $request->user_id;
        $date = now()->toDateString();
    
        PointerArrivals::where('user_id', $userId)->whereDate('heure_arrivee', '<>', $date)->delete();
        PointerDeparts::where('user_id', $userId)->whereDate('heure_depart', '<>', $date)->delete();
    
        // Vérifier si c'est l'anniversaire de l'utilisateur connecté
        $user = Auth::user();
        $birthdayMessage = $this->checkBirthday($user);
    
        // Récupérer les utilisateurs avec le rôle 1 depuis la base de données
        $usersRole1 = User::where('role', 1)->paginate(2);
    
        // Récupérer les utilisateurs avec le rôle 2 depuis la base de données
        $usersRole2 = User::where('role', 2)->paginate(3);
    
        // Passer les utilisateurs récupérés à la vue de la page dashboard
        return view('dashboard', [
            'usersRole1' => $usersRole1,
            'usersRole2' => $usersRole2,
            'birthdayMessage' => $birthdayMessage // Passer le message d'anniversaire à la vue
        ]);
    }

    public function show($id) {
        $user = User::findOrFail($id);
        
        // Générer le code QR en tant qu'image
        //$qrCodeImage = QrCode::format('png')->size(300)->generate($user->qr_code);
        
        // Convertir l'image en base64 pour l'utiliser dans la vue
        //$imageData = base64_encode($qrCodeImage);
        //$qrCodeUrl = 'data:image/png;base64,' . $imageData;
    
        //Avec QrCode de la base de donnée
        //return view('see', compact('user', 'qrCodeUrl'));

        //Sans
        return view('see', compact('user'));
    }

    public function destroy($id) {
        $user = User::findOrFail($id); 

        // Vérifier si l'utilisateur en cours de suppression est un compte administrateur
        if ($user->role == 1) {
            // Supprimer le compte administrateur
            $user->delete();

            // Déconnexion de l'utilisateur administrateur
            Auth::logout();

            // Redirection vers la page welcome
            return redirect()->route('welcome')->with('success', 'Votre compte administrateur a été supprimé avec succès.');
        } else {
            // Supprimer les autres types de comptes
            $user->delete();

            // Redirection vers une autre page ou une page précédente
            return redirect()->back()->with('success', 'Utilisateur supprimé avec succès.');
        }
    }

    public function store(Request $request) {
        // Vérifier si le numéro de téléphone existe déjà
        $existingPhone = User::where('phone', $request->phone)->exists();
        if ($existingPhone) {
            return redirect()->back()->with('error', 'Ce numéro de téléphone est déjà rattaché à un utilisateur.');
        }
    
        // Vérifier si la CNI existe déjà
        $existingCni = User::where('cni', $request->cni)->exists();
        if ($existingCni) {
            return redirect()->back()->with('error', 'Ce numéro d\'identité est déjà rattaché à un utilisateur.');
        }
    
        // Vérifier si l'email existe déjà
        $existingEmail = User::where('email', $request->email)->exists();
        if ($existingEmail) {
            return redirect()->back()->with('error', 'L\'adresse e-mail est déjà rattaché à un utilisateur.');
        }
    
        // Valider les autres données du formulaire
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'first_name' => 'required',
            'date_naissance' => 'required',
            'sexe' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'cjm' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
    
        // Vérifier si la validation échoue
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Créer un nouvel utilisateur avec les données du formulaire
        $user = new User();
        $user->name = $request->input('name');
        $user->first_name = $request->input('first_name');
        $user->date_naissance = $request->input('date_naissance');
        $user->sexe = $request->input('sexe');
        $user->phone = $request->input('phone');
        $user->cni = $request->input('cni');
        $user->heure_debut = $request->input('heure_debut');
        $user->heure_fin = $request->input('heure_fin');
        $user->cjm = $request->input('cjm');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password')); // hasher le mot de passe
        $user->role = $request->input('role');
        $user->etat_comptes = 1; // Le compye actif à 1 et desactivé à 2
    
        // Générer un code QR unique pour l'utilisateur
        $qrCode = QrCode::generate($user->email); // Vous pouvez utiliser n'importe quelle donnée unique ici
    
        // Enregistrez l'utilisateur dans la base de données
        $user->qr_code = $qrCode;
        $user->save();
    
        // On reste sur la même page
        return redirect()->back()->with('success', 'Utilisateur ajouté avec succès.');
    }

    public function edit(User $user) {
        return view('update', compact('user'));
    }

    public function update(Request $request, $id) {
        // Récupérer l'utilisateur à modifier
        $user = User::findOrFail($id);

        // Vérifier si le numéro de téléphone existe déjà pour un autre utilisateur
        if ($request->phone !== $user->phone) {
            $existingPhone = User::where('phone', $request->phone)->exists();
            if ($existingPhone) {
                return redirect()->back()->with('error', 'Ce numéro de téléphone est déjà rattaché à un utilisateur.');
            }
        }

        // Vérifier si la CNI existe déjà pour un autre utilisateur
        if ($request->cni !== $user->cni) {
            $existingCni = User::where('cni', $request->cni)->exists();
            if ($existingCni) {
                return redirect()->back()->with('error', 'Ce numéro d\'identité est déjà rattaché à un utilisateur.');
            }
        }

        // Vérifier si l'email existe déjà pour un autre utilisateur
        if ($request->email !== $user->email) {
            $existingEmail = User::where('email', $request->email)->exists();
            if ($existingEmail) {
                return redirect()->back()->with('error', 'L\'adresse e-mail est déjà rattachée à un utilisateur.');
            }
        }

        // Valider les autres données du formulaire
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'first_name' => 'required',
            'date_naissance' => 'required',
            'sexe' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'cjm' => 'required',
            'role' => 'required',
        ]);

        // Vérifier si la validation échoue
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Mettre à jour les données de l'utilisateur
        $user->name = $request->input('name');
        $user->first_name = $request->input('first_name');
        $user->date_naissance = $request->input('date_naissance');
        $user->sexe = $request->input('sexe');
        $user->phone = $request->input('phone');
        $user->cni = $request->input('cni');
        $user->heure_debut = $request->input('heure_debut');
        $user->heure_fin = $request->input('heure_fin');
        $user->cjm = $request->input('cjm');
        $user->role = $request->input('role');

        // Sauvegarder les modifications de l'utilisateur
        $user->save();

        // Rediriger l'utilisateur avec un message de succès
        return redirect()->route('dashboard')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    private function checkBirthday($user) {
        $birthday = Carbon::parse($user->date_naissance);
        $today = Carbon::today();

        if ($birthday->isBirthday($today)) {
            return 'Joyeux anniversaire, ' . ($user->sexe == 'Masculin' ? 'M. ' : 'Mme. ') . $user->name . '!';
        }

        return null;
    }

    // Fonction pour Désactiver le compte
    public function disableAccount(Request $request) {
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);
        $user->etat_comptes = 2; // 2 : Compte suspendu
        $user->save();
    
        return redirect()->back()->with('success', 'Compte désactivé avec succès.');
    }

    // Fonction pour Réactiver le compte
    public function enableAccount(Request $request) {
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);
        $user->etat_comptes = 1; //1 : Compte actif
        $user->save();

        return redirect()->back()->with('success', 'Compte réactivé avec succès.');
    }

}
