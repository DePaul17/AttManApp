<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    
    public function store(Request $request): RedirectResponse {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cni' => ['required', 'string', 'regex:/^SN\d{13}$/'],
            'phone' => ['required', 'string', 'regex:/^\d{9}$/'],
            'heure_debut' => ['required', 'numeric', 'between:0,23'],
            'heure_fin' => ['required', 'numeric', 'between:0,23'],
            'cjm' => ['required', 'numeric'],
            'role' => ['required', 'in:1,2'],
        ]);

        // Vérifier si l'e-mail est propre à un utilisateur
        $emailExists = User::where('email', $request->email)->exists();
        if ($emailExists) {
            return back()->withInput()->withErrors(['email' => 'Cet e-mail est déjà associé à un compte.']);
        }

        // Vérifier si l'e-mail est propre à un utilisateur
        $phoneExists = User::where('phone', $request->phone)->exists();
        if ($phoneExists) {
            return back()->withInput()->withErrors(['phone' => 'Ce numéro est déjà associé à un compte.']);
        }

        // Vérifier si l'e-mail est propre à un utilisateur
        $cniExists = User::where('cni', $request->cni)->exists();
        if ($cniExists) {
            return back()->withInput()->withErrors(['cni' => 'Ce numéro d\'identité est déjà associé à une personne.']);
        }

        // Générer un QR code unique pour l'utilisateur
        $qrCode = Str::random(20); // Générez un code QR aléatoire pour l'utilisateur, vous pouvez utiliser une méthode plus sophistiquée selon vos besoins

        // Vérifier si le QR code est propre à un utilisateur
        $qrCodeExists = User::where('qr_code', $qrCode)->exists();
        if ($qrCodeExists) {
            return back()->withInput()->withErrors(['qr_code' => 'Erreur lors de la génération du code QR. Veuillez réessayer.']);
        }

        $user = User::create([
            'name' => $request->name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cni' => $request->cni,
            'phone' => $request->phone,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'cjm' => $request->cjm,
            'role' => $request->role,
            'qr_code' => $qrCode, // Stockez le QR code dans la base de données
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('login'));
    }
}
