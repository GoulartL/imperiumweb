<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductionController extends Controller
{

    public function show(Request $request)
    {

        $company = Auth::user()->company;

        $tableMonth = $this->tableMonth($company);

        return view('system.production.dashboard.dashboard', $tableMonth);
    }

    public function tableMonth(string $company)
    {
        $sectors = [
            '1' => [
                "name" => 'PCP',
                "orders" => 0,
                "qty" => 0,
                "total" => 0,
                "total_all" => 0,
            ],
            '2' => [
                "name" => 'Costura',
                "orders" => 0,
                "qty" => 0,
                "total" => 0,
                "total_all" => 0,
            ],
            '3' => [
                "name" => 'Acabamento',
                "orders" => 0,
                "qty" => 0,
                "total" => 0,
                "total_all" => 0,
            ],
            '4' => [
                "name" => 'Expedição',
                "orders" => 0,
                "qty" => 0,
                "total" => 0,
                "total_all" => 0,
            ]
        ];

        $status = DB::select('SELECT sector, count(sector) orders, sum(qty) qty, sum(price*qty) total,
            (SELECT sum(A.price*A.qty) FROM orders A WHERE sector <> 5) as total_all
            FROM orders B
            WHERE sector <> 5
            and company = :COMPANY
            group by sector', [
            ':COMPANY' => $company
        ]);

        $indicators = DB::select("SELECT
        (
            SELECT count(id) opened_today
            FROM orders
            WHERE entry_date = DATE(now()) and company = :COMPANY1
        ) as opened_today,
        (
            SELECT count(id) finished_today
            FROM orders
            WHERE sector = 5
            and departure_date_expedition = DATE(now()) and company = :COMPANY2
        ) as finished_today,
        (
            SELECT count(id) finished_month
            FROM orders
            WHERE sector = 5 and company = :COMPANY3
            and month(departure_date_expedition) = month(now()) and year(departure_date_expedition) = year(now())
        ) as finished_month,
        (
            SELECT count(id) opened_month
            FROM orders
            WHERE month(entry_date) = month(now()) and year(entry_date) = year(now()) and company = :COMPANY4
        ) as opened_month", [
            ':COMPANY1' => $company,
            ':COMPANY2' => $company,
            ':COMPANY3' => $company,
            ':COMPANY4' => $company,
        ])[0];

        foreach ($status as $key => $value) {
            $sectors[$value->sector]['orders'] = $value->orders;
            $sectors[$value->sector]['qty'] = $value->qty;
            $sectors[$value->sector]['total'] = $value->total;
            $sectors[$value->sector]['total_all'] = $value->total / $value->total_all;
        }

        return [
            "sectors" => $sectors,
            "indicators" => $indicators
        ];
    }

    public function HistoryMonth(Request $request)
    {
        $company = $request->header('company');

        $history = DB::select(
            "select DATE_FORMAT(date, '%d/%m/%Y') date, SUM(production_diary.qty*orders.price) total
            FROM production_diary
            inner join orders on orders.id = production_diary.order
            where date between curdate()-30 and curdate() and production_diary.company = :COMPANY
            group by production_diary.date
            ORDER BY date",
            [
                ':COMPANY' => $company
            ]
        );

        return response(
            array(
                "label" => array_column($history, "date"),
                "data" => array_column($history, "total")
            )
        );
    }
}
