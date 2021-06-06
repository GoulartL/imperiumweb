<?php

namespace App\Http\Controllers\ProductionDiary;

use App\ProductionDiary;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class ProductionDiaryController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->header('company');
        $query = DB::table('production_diary')
            ->where('production_diary.company', '=', $company)
            ->join('orders', 'orders.id', '=', 'production_diary.order')
            ->join('customers', 'customers.id', '=', 'orders.customer')
            ->select(
                'production_diary.*',
                'orders.code as order',
                'orders.id as order_id',
                'orders.ref as ref',
                'orders.model as model',
                'orders.collection as collection',
                'orders.qty as qty_order',
                'orders.price as price_order',
                'customers.name as customer_name',
                DB::raw('production_diary.qty*orders.price as total')
            );

        return DataTables::of($query)->make(true);
    }

    public function show(ProductionDiary $production_diary, Request $request)
    {
        $company = $request->header('company');

        $query = DB::table('production_diary')
            ->where('production_diary.id', '=', $production_diary->id)
            ->where('production_diary.company', '=', $company)
            ->select('production_diary.*')->get();

        return response(
            array(
                "data" => $query->toArray()
            )
        );
    }

    public function store(Request $request)
    {
        $production_diary = new ProductionDiary();
        $company = $request->header('company');
        try {
            $error = "";
            $errorData = [];
            $validatedData = $request->validate(ProductionDiary::$fieldsRules);
            $production_diary->company = $company;
            $production_diary->date = is_null($request->date) ? null : \DateTime::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
            $production_diary->employees = $request->employees;
            $production_diary->order = $request->order;
            $production_diary->qty = $request->qty;
            $production_diary->observation = $request->observation;
            $production_diary->save();
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

    public function update(ProductionDiary $production_diary, Request $request)
    {
        try {
            $error = "";
            $errorData = [];
            $validatedData = $request->validate(ProductionDiary::$fieldsRules);
            $production_diary->date = is_null($request->date) ? null : \DateTime::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
            $production_diary->employees = $request->employees;
            $production_diary->order = $request->order;
            $production_diary->qty = $request->qty;
            $production_diary->observation = $request->observation;
            $production_diary->save();
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

    public function destroy(ProductionDiary $production_diary)
    {
        try {
            $error = "";
            $production_diary->delete();
        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }

        return json_encode([
            "status" => !$error ? "success" : "error",
            "message" => !$error ? "Removido com sucesso!" : $error
        ]);
    }
}
