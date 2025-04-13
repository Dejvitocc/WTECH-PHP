<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
class UserData extends Controller
{
    public function index(){
        $user = Auth::check() ? Customer::find(Auth::id()) : null;
        if(!$user) {
            return redirect('/prihlásenie')->with('warning', 'Musíte byť prihlásení, aby ste mohli upravovať svoje údaje.');
        }
        return view('client.pouzivatelske_udaje', compact('user'));
    }

    public function update(Request $request){
        if (!Auth::check()) {
            return redirect('/prihlásenie')->with('warning','Musíte byť prihlásení, aby ste mohli upravovať svoje údaje.');
        }

        $validate=$request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone-number' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'home-number' => 'required|string|max:20',
            'postal' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'country' => 'required|string|in:SK,CZ,AT,DE,PL,HU,FR,IT,ES,GB',
        ]);

        $user=Customer::find(Auth::id());

        $user->name=$validate['name'];
        $user->surname=$validate['surname'];
        $user->email=$validate['email'];
        $user->phone_number=$validate['phone-number'];
        $user->street=$validate['street'];
        $user->home_number=$validate['home-number'];
        $user->postal_code=$validate['postal'];
        $user->city=$validate['city'];
        $user->country=$validate['country'];
        $user->save();

        return redirect()->back()->with('success', 'Údaje boli úspešne aktualizované!');
    }

    public function delete(Request $request){
        if (!Auth::check()) {
            return redirect('/prihlasenie')->with('warning','Musíte byť prihlásený aby ste mohli vymazať svoje konto.');
        }

        $user=Customer::find(Auth::id());

        Auth::logout();
        $user->delete();

        return redirect('/')->with('success','Vaše konto bolo úspešne zmazané.');
    }
}
