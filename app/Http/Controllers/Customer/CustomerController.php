<?php

namespace App\Http\Controllers\Customer;


use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->header('company');

        return datatables()
            ->query(
                DB::table('customers')
                    ->where('customers.company', '=', $company)
                    ->select('customers.*', DB::raw("CASE WHEN type = 1 THEN  'CNPJ' ELSE 'CPF' END AS type_customer"))
                    ->orderBy('name')
            )
            ->escapeColumns([])
            ->toJson();
    }

    public function show(Customer $customer, Request $request)
    {
        $company = $request->header('company');

        $query = DB::table('customers')
            ->where('customers.id', '=', $customer->id)
            ->where('customers.company', '=', $company)
            ->select('customers.*', DB::raw("CASE WHEN type = 1 THEN  'CNPJ' ELSE 'CPF' END AS type_customer"))->get();

        return response(
            array(
                "data" => $query->toArray()
            )
        );
    }

    public function selectComponent(Request $request)
    {
        $search = $request->search;
        $company = $request->header('company');

        if ($search == '') {
            $customers = Customer::orderby('name', 'asc')->where('customers.company', '=', $company)->select('id', 'name')->paginate(25);
        } else {
            $customers = Customer::orderby('name', 'asc')->where('customers.company', '=', $company)->select('id', 'name')->where('name', 'like', '%' . $search . '%')->paginate(25);
        }

        $response = [];
        foreach ($customers as $customer) {
            $response[] = array(
                "id" => $customer->id,
                "text" => $customer->name
            );
        }

        return json_encode(
            [
                "results" => $response,
                "pagination" => [
                    "more" => $customers->hasMorePages()
                ]
            ]
        );
    }

    public function store(Request $request)
    {
        $customer = new Customer();
        try {
            $error = "";
            $errorData = [];

            $validatedData = $request->validate(Customer::$fieldsRules);
            $company = $request->header('company');

            $customer->company = $company;
            $customer->type = strtoupper($request->type) == "CNPJ" ? 1 : 2;
            $customer->taxvat = $request->taxvat;
            $customer->state_register_id = $request->idregister;
            $customer->name = $request->name;
            $customer->fantasy_name = $request->shortname;
            $customer->address = $request->address;
            $customer->number = $request->number;
            $customer->district = $request->district;
            $customer->city = $request->city;
            $customer->state = $request->state;
            $customer->complement = $request->complement;
            $customer->zip_code = $request->zipcode;
            $customer->contact_name = $request->contactname;
            $customer->phone_number_1 = $request->tel1;
            $customer->phone_number_2 = $request->tel2;
            $customer->email_1 = $request->email1;
            $customer->email_2 = $request->email2;
            $customer->bank = $request->bank;
            $customer->agency = $request->agency;
            $customer->account = $request->accountnumber;
            $customer->account_name = $request->accountname;
            $customer->observation = $request->observations;
            $customer->save();
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

    public function update(Customer $customer, Request $request)
    {
        try {
            $error = "";
            $errorData = [];

            $validatedData = $request->validate(Customer::$fieldsRules);

            $customer->type = strtoupper($request->type) == "CNPJ" ? 1 : 0;
            $customer->taxvat = $request->taxvat;
            $customer->state_register_id = $request->idregister;
            $customer->name = $request->name;
            $customer->fantasy_name = $request->shortname;
            $customer->address = $request->address;
            $customer->number = $request->number;
            $customer->district = $request->district;
            $customer->city = $request->city;
            $customer->state = $request->state;
            $customer->complement = $request->complement;
            $customer->zip_code = $request->zipcode;
            $customer->contact_name = $request->contactname;
            $customer->phone_number_1 = $request->tel1;
            $customer->phone_number_2 = $request->tel2;
            $customer->email_1 = $request->email1;
            $customer->email_2 = $request->email2;
            $customer->bank = $request->bank;
            $customer->agency = $request->agency;
            $customer->account = $request->accountnumber;
            $customer->account_name = $request->accountname;
            $customer->observation = $request->observations;
            $customer->save();
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

    public function destroy(Customer $customer)
    {
        try {
            $error = "";
            $customer->delete();
        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }

        return json_encode([
            "status" => !$error ? "success" : "error",
            "message" => !$error ? "Removido com sucesso!" : $error
        ]);
    }
}
