<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    function index(){ //loads the contact form template in the view
        return view('contact');
    }

    //ajout de la fonction store pour le formulaire de contact
    function store(Request $request){
        //custom error messages
        $messages = [
            'captcha.required' => 'The captcha field is required.',
            'captcha.captcha' => 'The captcha is incorrect, please try again.',
        ];
        //dd($messages);
      //  dd($request->all());
        //validate the form data
        $request->validate([
            'nom' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'captcha' => 'required|captcha'
        ], $messages);

        $contact = new Contact();
        $contact->nom = request('nom');
        $contact->email = request('email');
        $contact->message = request('message');

        // dd($contact);

        try {
            $contact->save();
        } catch (\Exception $e) {
            Log::error('Failed to save model: ' . $e->getMessage());
            // redirect back with an error message
            return back()->withErrors('Erreur avec l\'envoi du formulaire, veuillez reessayer.');
        }

        return back()->with('success', 'Votre message a bien été envoyé.');
    }
}
