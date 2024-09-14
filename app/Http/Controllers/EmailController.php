<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'category' => 'required',
            'content' => 'required',
        ]);

        // Enregistrement du mail dans la base de données
        $mail = new Email();
        $mail->name = $request->name;
        $mail->email = $request->email;
        $mail->category = $request->category;
        $mail->content = $request->content;

        $mail->save();

        // Vérification de l'existence de l'adresse e-mail de l'expéditeur
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            // Si l'adresse e-mail n'est pas valide, retourner avec un message d'erreur
            return redirect()->to('#return-message')->with(['error' => 'L\'adresse e-mail de l\'expéditeur est invalide.']);
        }

        Mail::send([], [], function($message) use ($request) {
            $senderName = "{$request->name} • From PresnaTech"; 
            $contentWithEmail = "<{$request->email}> : {$request->content}";
        
            $message->to(env('MAIL_USERNAME')) 
                    ->subject($request->category)
                    ->from($request->email, $senderName)
                    ->text($contentWithEmail);
        });

        return redirect()->to(url()->current() . '#contactForm')->with(['success' => 'Message envoyé avec succès!']);
    }
}
