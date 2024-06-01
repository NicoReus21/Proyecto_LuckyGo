<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raffletor;

class ManageRaffletorsController extends Controller
{

    public function showManageForm()
{
    $raffletors = Raffletor::withCount('raffles')->get();

    if ($raffletors->isEmpty()) {
        $messages = makeMessages();
        $noRaffletorsMessage = $messages['no_raffletors'];
        return view('raffletors.manage', compact('raffletors', 'noRaffletorsMessage'));
    }

    return view('raffletors.manage', compact('raffletors'));
}

    public function manage(Request $request)
    {

        $statuses = $request->input('statuses', []);

        foreach ($statuses as $id => $status) {
            $raffletor = Raffletor::find($id);
            if ($raffletor) {
                $raffletor->status = ($status == 'Habilitado');
                $raffletor->save();
            }
        }

        return redirect()->back()->with('success', 'Estado actualizado con éxito');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $raffletors = Raffletor::withCount('raffles')
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orderBy('name')
                ->get();
        } else {
            $raffletors = Raffletor::withCount('raffles')->orderBy('name')->get();
        }

        return view('raffletors.index', compact('raffletors'));
    }
}
