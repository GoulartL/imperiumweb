<?php

namespace App\Http\Controllers\Order;

use App\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $query = DB::table('orders')
            ->join('customers', 'customers.id', '=', 'orders.customer')
            ->select('orders.*', 'customers.name as customer_name', 'orders.qty * orders.price as total', 'orders.id');

        return DataTables::of($query)->make(true);
    }

    public function show(Order $order)
    {
        return $order->toJson();
    }

    /*public function store(Request $request)
    {
        $order = new Order();
        try {
            $error = "";
            $errorData = [];

            $validatedData = $request->validate(Order::$fieldsRules);

            $order->company = 1;
            $order->type = strtoupper($request->type) == "CNPJ" ? 1 : 2;
            $order->taxvat = $request->taxvat;
            $order->state_register_id = $request->idregister;
            $order->name = $request->name;
            $order->fantasy_name = $request->shortname;
            $order->address = $request->address;
            $order->number = $request->number;
            $order->district = $request->district;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->complement = $request->complement;
            $order->zip_code = $request->zipcode;
            $order->contact_name = $request->contactname;
            $order->phone_number_1 = $request->tel1;
            $order->phone_number_2 = $request->tel2;
            $order->email_1 = $request->email1;
            $order->email_2 = $request->email2;
            $order->bank = $request->bank;
            $order->agency = $request->agency;
            $order->account = $request->accountnumber;
            $order->account_name = $request->accountname;
            $order->observation = $request->observations;
            $order->save();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $error = "Há campos que não foram preenchidos corretamente!";
            $errorData = $e->errors();
        } catch (\Exception $th) {
            $error = $th->getMessage();
        }


        return json_encode([
            "status" => !$error ? "success" : "error",
            "message" => !$error ? "Cadastrado com sucesso!" : $error,
            "data" =>  $errorData
        ]);
    }

    public function update(Order $order, Request $request)
    {
        try {
            $error = "";
            $errorData = [];

            $validatedData = $request->validate(Order::$fieldsRules);

            $order->type = strtoupper($request->type) == "CNPJ" ? 1 : 0;
            $order->taxvat = $request->taxvat;
            $order->state_register_id = $request->idregister;
            $order->name = $request->name;
            $order->fantasy_name = $request->shortname;
            $order->address = $request->address;
            $order->number = $request->number;
            $order->district = $request->district;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->complement = $request->complement;
            $order->zip_code = $request->zipcode;
            $order->contact_name = $request->contactname;
            $order->phone_number_1 = $request->tel1;
            $order->phone_number_2 = $request->tel2;
            $order->email_1 = $request->email1;
            $order->email_2 = $request->email2;
            $order->bank = $request->bank;
            $order->agency = $request->agency;
            $order->account = $request->accountnumber;
            $order->account_name = $request->accountname;
            $order->observation = $request->observations;
            $order->save();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $error = "Há campos que não foram preenchidos corretamente!";
            $errorData = $e->errors();
        } catch (\Exception $th) {
            $error = $th->getMessage();
        }

        return json_encode([
            "status" => !$error ? "success" : "error",
            "message" => !$error ? "Cadastrado com sucesso!" : $error,
            "data" =>  $errorData
        ]);
    }

    public function destroy(Order $order)
    {
        try {
            $error = "";
            $order->delete();
        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }

        return json_encode([
            "status" => !$error ? "success" : "error",
            "message" => !$error ? "Removido com sucesso!" : $error
        ]);
    }*/
}
