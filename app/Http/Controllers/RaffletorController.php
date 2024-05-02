<?php

namespace App\Http\Controllers;

use App\Models\Raffletor;
use Illuminate\Http\Request;
use App\Mail\PasswordMailable;
use Illuminate\Support\Facades\Mail;

class RaffletorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('raffletors.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('raffletors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $messages = makeMessages();
        $password = mt_rand(100000, 999999);
        //Validar datos
        $request->validate([
            'name' => ['required', 'min:3'],
            'age' => ['required', 'numeric', 'min:18', 'max:65'],
            'email' => ['required', 'email', 'unique:raffletors'],
            'password' => ['required', 'min:5']
        ], $messages);

        //Crea el sorteador
        Raffletor::create([
            'name' => $request->name,
            'age' => $request->age,
            'email' => $request->email,
            'password' => $password,
        ]);

        Mail::to($request->email)->send(new PasswordMailable($password));

        auth()->attempt([
            'email' => $request->email,
            'password' => $password,
        ]);


        //Redirecciona el sorteador
        return redirect()->route('raffletors');
    }

    /**
     * Display the specified resource.
     */
    public function show(Raffletor $raffletor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Raffletor $raffletor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Raffletor $raffletor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Raffletor $raffletor)
    {
        //
    }
}
