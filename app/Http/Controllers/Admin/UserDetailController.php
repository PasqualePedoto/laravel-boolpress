<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDetailController extends Controller
{
    public function edit(){
        // Preleviamo l'utente attualmente loggato nella sessione
        $user = Auth::user();

        // Preleviamo i suoi dati personali e passiamoli alla edit
        $details = $user->userDetail;
        return view('admin.userdetails.edit',compact('details'));
    }

    public function update(Request $request){

        // Preleviamo l'user e i suoi details
        // attualmente loggato in questa sessione
        $user = Auth::user();
        $details = $user->userDetail;

        // Validazione dei dati in arrivo
        $request->validate([
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'year_of_birth' => 'nullable|date_format:Y',
            'address' => 'nullable|string',
        ],[
            'numeric' => 'La data di nascita deve essere numerica!'
        ]);

        // Assegnazione dei dati
        $data = $request->all();

        // Update dei dati
        $details->update($data);

        return redirect()->route('admin.posts.index');
    }
}
