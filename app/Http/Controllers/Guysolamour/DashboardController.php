<?php

namespace App\Http\Controllers\Guysolamour;

use App\User;
use App\Models\Watch;
use App\Models\Montre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MontreFormRequest;



class DashboardController extends Controller
{

    public function index()
    {
        // Auth::loginUsingId(5);
        return view('dashboard.index');
    }

    public function montres()
    {
        // Auth::loginUsingId(5);
        // dd(auth()->user());

        return view('dashboard.watch.index', [
            'user' => auth()->user()
        ]);
    }

    public function edit(Montre $montre)
    {
                //

        // auth()->logout();
        $montre->load([
            'forme', 'forme.index', 'index', 'index.images',
             'indexImage', 'aiguille', 'arrierePlan', 'arrierePlan.images',
             'arrierePlanImage'
        ]);
        // dd($montre->indexImage);



        return view('dashboard.watch.edit', [
            'montre' => $montre
        ]);
    }

    public function update(Montre $montre, MontreFormRequest $request)
    {
        // dd($request->all());
        $montre->update($request->validated());

        return back();

        // return view('dashboard.watch.edit', [
        //     'watch' => $watch
        // ]);
    }
}
