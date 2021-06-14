<?php

namespace App\Http\Controllers\Receivement;

use App\Receivement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class ReceivementController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->header('company');
        $query = DB::table('receipts')
            ->where('receipts.company', '=', $company)
            ->join('customers', 'customers.id', '=', 'receipts.client')
            ->join('species', 'species.id', '=', 'receipts.species')
            ->select('receipts.*', 'customers.name as customer_name', 'species.name as specie_name', 'receipts.id');

        return DataTables::of($query)->make(true);
    }

    public function show(Receivement $receivement, Request $request)
    {
        $company = $request->header('company');

        $query = DB::table('receipts')
            ->where('receipts.id', '=', $receivement->id)
            ->where('receipts.company', '=', $company)
            ->select('receipts.*')->get();

        return response(
            array(
                "data" => $query->toArray()
            )
        );
    }

    public function store(Request $request)
    {
        $data = $request->json()->all();

        $tempReceivement = [];
        try {
            $error = "";
            $errorData = [];
            $company = $request->header('company');

            // $request->validate(Receivement::$fieldsRulesNew);

            foreach ($data['header'] as $key => $header) {
                try {
                    switch ($header['name']) {
                        case 'emission':
                            $tempReceivement['emission'] = $header['value'];
                            break;
                        case 'description':
                            $tempReceivement['description'] = $header['value'];
                            break;
                        case 'client':
                            $tempReceivement['client'] = $header['value'];
                            break;
                        case 'species':
                            $tempReceivement['species'] = $header['value'];
                            break;
                    }
                } catch (\Throwable $th) {
                    throw new \Exception($th->getMessage());
                }
            }

            foreach ($data['receipts'] as $key => $value) {
                try {
                    $valueRec = floatval(str_replace(',', '.', str_replace('.', '', $value[1])));
                    $receivement = new Receivement();
                    $receivement->company = $company;
                    $receivement->emission = \DateTime::createFromFormat('d/m/Y', $tempReceivement['emission'])->format('Y-m-d');
                    $receivement->description = $tempReceivement['description'];
                    $receivement->client = $tempReceivement['client'];
                    $receivement->species = $tempReceivement['species'];
                    $receivement->portion = $value[0];
                    $receivement->value = $valueRec;
                    $receivement->due_date = \DateTime::createFromFormat('d/m/Y', $value[2])->format('Y-m-d');
                    $receivement->save();
                } catch (\Throwable $th) {
                    throw new \Exception($th->getMessage());
                }
            }
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

    public function update(Receivement $receivement, Request $request)
    {
        try {
            $error = "";
            $errorData = [];

            if (!isset($request->receive)) {
                $validatedData = $request->validate(Receivement::$fieldsRules);
                $receivement->description = $request->description;
                $receivement->emission = \DateTime::createFromFormat('d/m/Y', $request->emission)->format('Y-m-d');
                $receivement->due_date = \DateTime::createFromFormat('d/m/Y', $request->due_date)->format('Y-m-d');
                $receivement->value = $request->value;
                $receivement->species = $request->species;
            }else {
                $receivement->receipt_date = is_null($request->receipt_date) ? null : \DateTime::createFromFormat('d/m/Y', $request->receipt_date)->format('Y-m-d');
                $receivement->receipt_value = $request->receipt_value;
            }

            $receivement->save();
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

    public function destroy(Receivement $receivement)
    {
        try {
            $error = "";
            $receivement->delete();
        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }

        return json_encode([
            "status" => !$error ? "success" : "error",
            "message" => !$error ? "Removido com sucesso!" : $error
        ]);
    }
}
