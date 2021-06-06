<?php

namespace App\Http\Controllers\Payment;

use App\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->header('company');
        $query = DB::table('payments')
            ->where('payments.company', '=', $company)
            ->join('suppliers', 'suppliers.id', '=', 'payments.supplier')
            ->join('species', 'species.id', '=', 'payments.species')
            ->select('payments.*', 'suppliers.name as supplier_name', 'species.name as specie_name', 'payments.id');

        return DataTables::of($query)->make(true);
    }

    public function show(Payment $payment, Request $request)
    {
        $company = $request->header('company');

        $query = DB::table('payments')
            ->where('payments.id', '=', $payment->id)
            ->where('payments.company', '=', $company)
            ->join('suppliers', 'suppliers.id', '=', 'payments.supplier')
            ->select('payments.*', 'suppliers.name as supplier_name', 'species.name as specie_name', 'payments.id')->get();

        return response(
            array(
                "data" => $query->toArray()
            )
        );
    }

    public function store(Request $request)
    {
        $data = $request->json()->all();

        $tempPayment = [];
        try {
            $error = "";
            $errorData = [];

            $company = $request->header('company');

            // $request->validate(Payment::$fieldsRulesNew);

            foreach ($data['header'] as $key => $header) {
                try {
                    switch ($header['name']) {
                        case 'emission':
                            $tempPayment['emission'] = $header['value'];
                            break;
                        case 'description':
                            $tempPayment['description'] = $header['value'];
                            break;
                        case 'supplier':
                            $tempPayment['supplier'] = $header['value'];
                            break;
                        case 'species':
                            $tempPayment['species'] = $header['value'];
                            break;
                    }
                } catch (\Throwable $th) {
                    throw new \Exception($th->getMessage());
                }
            }

            foreach ($data['payments'] as $key => $value) {
                try {
                    $valuePay = floatval(str_replace(',', '.', str_replace('.', '', $value[1])));
                    $payment = new Payment();
                    $payment->company = $company;
                    $payment->emission = \DateTime::createFromFormat('d/m/Y', $tempPayment['emission'])->format('Y-m-d');
                    $payment->description = $tempPayment['description'];
                    $payment->supplier = $tempPayment['supplier'];
                    $payment->species = $tempPayment['species'];
                    $payment->portion = $value[0];
                    $payment->value = $valuePay;
                    $payment->due_date = \DateTime::createFromFormat('d/m/Y', $value[2])->format('Y-m-d');
                    $payment->save();
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

    public function update(Payment $payment, Request $request)
    {
        try {
            $error = "";
            $errorData = [];

            if (!isset($request->paymentid)) {
                $validatedData = $request->validate(Payment::$fieldsRules);
                $payment->description = $request->description;
                $payment->emission = \DateTime::createFromFormat('d/m/Y', $request->emission)->format('Y-m-d');
                $payment->due_date = \DateTime::createFromFormat('d/m/Y', $request->due_date)->format('Y-m-d');
                $payment->value = $request->value;
                $payment->species = $request->species;
            }else {
                $payment->payment_date = \DateTime::createFromFormat('d/m/Y', $request->payment_date)->format('Y-m-d');
                $payment->payment_value = $request->payment_value;
            }

            $payment->save();
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

    public function destroy(Payment $payment)
    {
        try {
            $error = "";
            $payment->delete();
        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }

        return json_encode([
            "status" => !$error ? "success" : "error",
            "message" => !$error ? "Removido com sucesso!" : $error
        ]);
    }
}
