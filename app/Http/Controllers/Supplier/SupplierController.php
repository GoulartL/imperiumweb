<?php

namespace App\Http\Controllers\Supplier;

use App\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->header('company');
        $query = DB::table('suppliers')
            ->where('suppliers.company', '=', $company)
            ->select('suppliers.*', DB::raw("CASE WHEN type = 1 THEN  'CNPJ' ELSE 'CPF' END AS type_supplier"));

        return DataTables::of($query)->make(true);
    }

    public function selectComponent(Request $request)
    {
        $search = $request->search;
        $company = $request->header('company');

        if ($search == '') {
            $suppliers = Supplier::orderby('name', 'asc')->where('suppliers.company', '=', $company)->select('id', 'name')->paginate(25);
        } else {
            $suppliers = Supplier::orderby('name', 'asc')->where('suppliers.company', '=', $company)->select('id', 'name')->where('name', 'like', '%' . $search . '%')->paginate(25);
        }

        $response = [];
        foreach ($suppliers as $customer) {
            $response[] = array(
                "id" => $customer->id,
                "text" => $customer->name
            );
        }

        return json_encode(
            [
                "results" => $response,
                "pagination" => [
                    "more" => $suppliers->hasMorePages()
                ]
            ]
        );
    }

    public function show(Supplier $supplier, Request $request)
    {
        $company = $request->header('company');

        $query = DB::table('suppliers')
            ->where('suppliers.id', '=', $supplier->id)
            ->where('suppliers.company', '=', $company)
            ->select('suppliers.*', DB::raw("CASE WHEN type = 1 THEN  'CNPJ' ELSE 'CPF' END AS type_supplier"))->get();

        return response(
            array(
                "data" => $query->toArray()
            )
        );
    }

    public function store(Request $request)
    {
        $supplier = new Supplier();
        try {
            $error = "";
            $errorData = [];

            $validatedData = $request->validate(Supplier::$fieldsRules);
            $company = $request->header('company');

            $supplier->company = $company;
            $supplier->type = strtoupper($request->type) == "CNPJ" ? 1 : 2;
            $supplier->taxvat = $request->taxvat;
            $supplier->state_register_id = $request->idregister;
            $supplier->name = $request->name;
            $supplier->fantasy_name = $request->shortname;
            $supplier->address = $request->address;
            $supplier->number = $request->number;
            $supplier->district = $request->district;
            $supplier->city = $request->city;
            $supplier->state = $request->state;
            $supplier->complement = $request->complement;
            $supplier->zip_code = $request->zipcode;
            $supplier->contact_name = $request->contactname;
            $supplier->phone_number_1 = $request->tel1;
            $supplier->phone_number_2 = $request->tel2;
            $supplier->email_1 = $request->email1;
            $supplier->email_2 = $request->email2;
            $supplier->bank = $request->bank;
            $supplier->agency = $request->agency;
            $supplier->account = $request->accountnumber;
            $supplier->account_name = $request->accountname;
            $supplier->observation = $request->observations;
            $supplier->save();
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

    public function update(Supplier $supplier, Request $request)
    {
        try {
            $error = "";
            $errorData = [];

            $validatedData = $request->validate(Supplier::$fieldsRules);

            $supplier->type = strtoupper($request->type) == "CNPJ" ? 1 : 0;
            $supplier->taxvat = $request->taxvat;
            $supplier->state_register_id = $request->idregister;
            $supplier->name = $request->name;
            $supplier->fantasy_name = $request->shortname;
            $supplier->address = $request->address;
            $supplier->number = $request->number;
            $supplier->district = $request->district;
            $supplier->city = $request->city;
            $supplier->state = $request->state;
            $supplier->complement = $request->complement;
            $supplier->zip_code = $request->zipcode;
            $supplier->contact_name = $request->contactname;
            $supplier->phone_number_1 = $request->tel1;
            $supplier->phone_number_2 = $request->tel2;
            $supplier->email_1 = $request->email1;
            $supplier->email_2 = $request->email2;
            $supplier->bank = $request->bank;
            $supplier->agency = $request->agency;
            $supplier->account = $request->accountnumber;
            $supplier->account_name = $request->accountname;
            $supplier->observation = $request->observations;
            $supplier->save();
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

    public function destroy(Supplier $supplier)
    {
        try {
            $error = "";
            $supplier->delete();
        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }

        return json_encode([
            "status" => !$error ? "success" : "error",
            "message" => !$error ? "Removido com sucesso!" : $error
        ]);
    }
}
