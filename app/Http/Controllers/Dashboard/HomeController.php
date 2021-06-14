<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function show(Request $request)
    {
        $company = Auth::user()->company;
        $production = new ProductionController();
        $productionMonth = $production->tableMonth($company);
        $financial = new CashFlowController();
        $indicatorsFinance = $financial->indicators($company);

        return view('system.home.home',[
            'username' => Auth::user()->name,
            'productionMonth' => $productionMonth,
            'indicatorsFinance' => $indicatorsFinance,
        ]);
    }
}
