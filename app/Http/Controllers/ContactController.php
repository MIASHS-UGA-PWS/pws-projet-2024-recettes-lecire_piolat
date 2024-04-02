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
            'captcha.required' => 'Remplissez le captcha.',
            'captcha.captcha' => 'Le captcha est incorrect, essayez à nouveau.',
        ];
        //dd($messages);
      //  dd($request->all());
        //validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'captcha' => 'required|captcha'
        ], $messages);


        //create a new contact model
        Contact::create([
            'email' => $request->input('email'),
            'message' => $request->input('message')
        ]);
        // dd($contact);

        // try {
        //     $contact->save();
        // } catch (\Exception $e) {
        //     Log::error('Failed to save model: ' . $e->getMessage());
        //     // redirect back with an error message
        //     return back()->withErrors('Erreur avec l\'envoi du formulaire, veuillez reessayer.');
        // }

        return back()->with('success', 'Votre message a bien été envoyé.');
    }
}
