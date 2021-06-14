<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashFlowController extends Controller
{

    public function show(Request $request)
    {
        $company = Auth::user()->company;
        $indicators = $this->indicators($company);

        return view('system.financial.cash-flow.cash-flow', $indicators);
    }

    public function indicators(string $company)
    {
        $balance = DB::select('SELECT IFNULL(RECEIPT, 0)-IFNULL(PAYMENT, 0) TOTAL
        FROM
          (SELECT
             (SELECT SUM(receipt_value)
              FROM receipts
              WHERE company = :COMPANY1 ) AS RECEIPT,
             (SELECT SUM(payment_value)
              FROM payments
              WHERE company = :COMPANY2 ) AS PAYMENT
        ) AS TEMP', [
            ':COMPANY1' => $company,
            ':COMPANY2' => $company
        ])[0]->TOTAL;

        $dueReceipt = DB::select('SELECT IFNULL(RECEIPT, 0) AS TOTAL
        FROM
          (SELECT
             (SELECT SUM(IFNULL(value,0))-SUM(IFNULL(receipt_value,0))
              FROM receipts
              WHERE company = :COMPANY and due_date < NOW()) AS RECEIPT
        ) AS TEMP', [
            ':COMPANY' => $company
        ])[0]->TOTAL;

        $duePayment = DB::select('SELECT IFNULL(PAYMENT, 0) TOTAL
        FROM
          (SELECT
             (SELECT SUM(IFNULL(value,0))-SUM(IFNULL(payment_value,0))
              FROM payments
              WHERE company = :COMPANY and due_date < NOW() ) AS PAYMENT
        ) AS TEMP', [
            ':COMPANY' => $company
        ])[0]->TOTAL;

        return [
            "balance" => number_format($balance,2, ',', '.'),
            "dueReceipt" => number_format($dueReceipt,2, ',', '.'),
            "duePayment" => number_format($duePayment,2, ',', '.')
        ];
    }

    public function HistoryMonth(Request $request)
    {
        $company = $request->header('company');

        $history = DB::select(
            "SELECT 
                IFNULL(TO_PAYMENT, 0) AS TO_PAYMENT, 
                IFNULL(TO_RECEIVE, 0) AS TO_RECEIVE,
                IFNULL(RECEIVE, 0) AS RECEIVE,
                IFNULL(PAYMENT, 0) AS PAYMENT
            FROM
            (SELECT
                (SELECT SUM(IFNULL(value,0))-SUM(IFNULL(payment_value,0)) TO_PAYMENT
                FROM payments
                WHERE company = :COMPANY1
                    and month(due_date) = month(now()) and year(due_date) = year(now())
                ) AS TO_PAYMENT,
                (SELECT SUM(IFNULL(value,0))-SUM(IFNULL(receipt_value,0)) TO_RECEIVE
                FROM receipts
                WHERE company = :COMPANY2
                    and month(due_date) = month(now()) and year(due_date) = year(now())
                ) AS TO_RECEIVE,
                (SELECT SUM(IFNULL(receipt_value,0)) RECEIVE
                FROM receipts
                WHERE company = :COMPANY3
                    and month(receipt_date) = month(now()) and year(receipt_date) = year(now())
                ) AS RECEIVE,
                (SELECT SUM(IFNULL(payment_value,0)) PAYMENT
                FROM payments
                WHERE company = :COMPANY4
                    and month(payment_date) = month(now()) and year(payment_date) = year(now())
                ) AS PAYMENT
            ) AS TEMP",
            [
                ':COMPANY1' => $company,
                ':COMPANY2' => $company,
                ':COMPANY3' => $company,
                ':COMPANY4' => $company,
            ]
        )[0];

        return response(
            array(
                "label" => [
                    "A pagar", "A receber", "Pago", "Recebido"
                ],
                "data" => [
                    $history->TO_PAYMENT, $history->TO_RECEIVE, $history->PAYMENT, $history->RECEIVE
                ]
            )
        );
    }

    public function historyDay(Request $request)
    {
        $company = $request->header('company');

        $history = DB::select(
            "SELECT 
                IFNULL(TO_PAYMENT, 0) AS TO_PAYMENT, 
                IFNULL(TO_RECEIVE, 0) AS TO_RECEIVE
            FROM
            (SELECT
                (SELECT SUM(IFNULL(value,0))-SUM(IFNULL(payment_value,0)) TO_PAYMENT
                FROM payments
                WHERE company = :COMPANY1
                    and date(due_date) = date(now())
                ) AS TO_PAYMENT,
                (SELECT SUM(IFNULL(value,0))-SUM(IFNULL(receipt_value,0)) TO_RECEIVE
                FROM receipts
                WHERE company = :COMPANY2
                and date(due_date) = date(now())
                ) AS TO_RECEIVE
            ) AS TEMP",
            [
                ':COMPANY1' => $company,
                ':COMPANY2' => $company,
            ]
        )[0];

        return response(
            array(
                "label" => [
                    "A pagar", "A receber"
                ],
                "data" => [
                    $history->TO_PAYMENT, $history->TO_RECEIVE
                ]
            )
        );
    }


    public function PayOnTheDay(Request $request)
    {
        $company = $request->header('company');

        $history = DB::select(
            "SELECT pay.id, pay.description, sup.name supplier_name, pay.portion, pay.value, ifnull(pay.payment_value,0) payment_value
            FROM payments pay
            JOIN suppliers sup on sup.id = pay.supplier and pay.company = sup.company
            WHERE date(due_date) = date(now())
            AND value > ifnull(payment_value,0)
            AND pay.company = :COMPANY",
            [
                ':COMPANY' => $company,
            ]
        );

        return response(
            array(
                "data" => $history
            )
        );

    }

    public function ReceiveOnTheDay(Request $request)
    {
        $company = $request->header('company');

        $history = DB::select(
            "SELECT rec.id, rec.description, customer.name customer_name, rec.portion, rec.value, ifnull(rec.receipt_value,0) receipt_value
            FROM receipts rec
            JOIN customers customer on customer.id = rec.client and rec.company = customer.company
            WHERE date(due_date) = date(now())
            AND value > ifnull(receipt_value,0)
            AND rec.company = :COMPANY",
            [
                ':COMPANY' => $company,
            ]
        );

        return response(
            array(
                "data" => $history
            )
        );
    }
}
