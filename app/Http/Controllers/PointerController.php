<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointerArrivals;
use App\Models\PointerDeparts;
use Illuminate\Support\Facades\Session;

class PointerController extends Controller
{
    public function arrival(Request $request) {
        $userId = $request->user_id;
        $date = now()->toDateString();
    
        // Vérifier si l'utilisateur a déjà enregistré son arrivée pour aujourd'hui
        $existingArrival = PointerArrivals::where('user_id', $userId)
                                          ->whereDate('heure_arrivee', $date)
                                          ->exists();
    
        if ($existingArrival) {
            return redirect()->back()->with('error', 'Vous avez déjà enregistré votre arrivée pour aujourd\'hui.');
        }
    
        // Enregistrer l'arrivée de l'utilisateur
        PointerArrivals::create([
            'user_id' => $userId,
            'heure_arrivee' => now()
        ]);
    
        return redirect()->back()->with('success', 'Arrivée enregistrée avec succès!');
    }
    
    public function depart(Request $request) {
        $userId = $request->user_id;
        $date = now()->toDateString();
        // Vérifier si l'utilisateur a déjà enregistré son départ pour aujourd'hui
        $existingDeparture = PointerDeparts::where('user_id', $userId)
                                               ->whereDate('heure_depart', $date)
                                               ->exists();
        if ($existingDeparture) {
            return redirect()->back()->with('error', 'Vous avez déjà enregistré votre départ pour aujourd\'hui.');
        }
        // Vérifier si l'utilisateur a enregistré son arrivée pour aujourd'hui
        $existingArrival = PointerArrivals::where('user_id', $userId)
                                          ->whereDate('heure_arrivee', $date)
                                          ->exists();
        if (!$existingArrival) {
            return redirect()->back()->with('error', 'Vous devez d\'abord enregistrer votre arrivée avant de pouvoir enregistrer votre départ.');
        }
        // Enregistrer le départ de l'utilisateur
        PointerDeparts::create([
            'user_id' => $userId,
            'heure_depart' => now()
        ]);
        return redirect()->back()->with('success', 'Départ enregistré avec succès!');
    }

    public function present()
    {
        return view('present');
    }

    public function showPointerInfo($id) {
        // Récupérer les informations de la table pointer_arrivals pour l'utilisateur spécifié par l'ID
        $arrivals = PointerArrivals::where('user_id', $id)->paginate(10);
    
        // Récupérer les informations de la table pointer_departs pour l'utilisateur spécifié par l'ID
        $departs = PointerDeparts::where('user_id', $id)->paginate(10);
    
        // Passer les données récupérées à la vue
        return view('present', ['arrivals' => $arrivals, 'departs' => $departs]);
    }
}
