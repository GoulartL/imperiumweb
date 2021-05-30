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
            ->select('orders.*', 'customers.name as customer_name', DB::raw('orders.qty*orders.price as total'), 'orders.id');

        return DataTables::of($query)->make(true);
    }

    public function show(Order $order)
    {
        return response(
            array(
                "data" => array(
                    $order->toArray()
                )
            )
        );
    }

    public function store(Request $request)
    {
        $order = new Order();
        try {
            $error = "";
            $errorData = [];
            $validatedData = $request->validate(Order::$fieldsRules);
            $order->company = 1;
            $order->code = $request->code;
            $order->customer = $request->customer;
            $order->incoming_invoice = $request->incoming_invoice;
            $order->ref = $request->ref;
            $order->model = $request->model;
            $order->collection = $request->collection;
            $order->qty = $request->qty;
            $order->price = $request->price;
            $order->observation = $request->observation;
            $order->sector = 1;
            $order->entry_date = is_null($request->entry_date) ? null : \DateTime::createFromFormat('d/m/Y', $request->entry_date)->format('Y-m-d');
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

            if (!isset($request->formorder)) {
                $validatedData = $request->validate(Order::$fieldsRules);
                $order->code = $request->code;
                $order->customer = $request->customer;
                $order->incoming_invoice = $request->incoming_invoice;
                $order->ref = $request->ref;
                $order->model = $request->model;
                $order->collection = $request->collection;
                $order->qty = $request->qty;
                $order->price = $request->price;
                $order->observation = $request->observation;
                $order->entry_date = is_null($request->entry_date) ? null : \DateTime::createFromFormat('d/m/Y', $request->entry_date)->format('Y-m-d');
            } else {
                $order->cancellation_date = is_null($request->cancellation_date) ? null : \DateTime::createFromFormat('d/m/Y', $request->cancellation_date)->format('Y-m-d');
                $order->delivery_date_sewing = is_null($request->delivery_date_sewing) ? null : \DateTime::createFromFormat('d/m/Y', $request->delivery_date_sewing)->format('Y-m-d');
                $order->expected_date_sewing = is_null($request->expected_date_sewing) ? null : \DateTime::createFromFormat('d/m/Y', $request->expected_date_sewing)->format('Y-m-d');
                $order->departure_date_sewing = is_null($request->departure_date_sewing) ? null : \DateTime::createFromFormat('d/m/Y', $request->departure_date_sewing)->format('Y-m-d');
                $order->delivery_date_finishing = is_null($request->delivery_date_finishing) ? null : \DateTime::createFromFormat('d/m/Y', $request->delivery_date_finishing)->format('Y-m-d');
                $order->expected_date_finishing = is_null($request->expected_date_finishing) ? null : \DateTime::createFromFormat('d/m/Y', $request->expected_date_finishing)->format('Y-m-d');
                $order->departure_date_finishing = is_null($request->departure_date_finishing) ? null : \DateTime::createFromFormat('d/m/Y', $request->departure_date_finishing)->format('Y-m-d');
                $order->entry_date_expedition = is_null($request->entry_date_expedition) ? null : \DateTime::createFromFormat('d/m/Y', $request->entry_date_expedition)->format('Y-m-d');
                $order->expected_date_expedition = is_null($request->expected_date_expedition) ? null : \DateTime::createFromFormat('d/m/Y', $request->expected_date_expedition)->format('Y-m-d');
                $order->departure_date_expedition = is_null($request->departure_date_expedition) ? null : \DateTime::createFromFormat('d/m/Y', $request->departure_date_expedition)->format('Y-m-d');
                $order->cancellation_reason = $request->cancellation_reason;
                $order->sector = $request->sector;
                $order->outgoing_invoice = $request->outgoing_invoice;
            }
            $order->save();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $error = "Há campos que não foram preenchidos corretamente!";
            $errorData = $e->errors();
        } catch (\Exception $th) {
            $error = $th->getMessage();
        }

        return json_encode([
            "status" => !$error ? "success" : "error",
            "message" => !$error ? "Atualizado com sucesso!" : $error,
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
    }
}
