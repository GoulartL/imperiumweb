<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return datatables()
            ->eloquent(Employee::query())
            ->escapeColumns([])
            ->toJson();
    }

    public function show(Employee $employee)
    {
        return $employee->toJson();
    }

    public function store(Request $request)
    {
        $employee = new Employee();
        try {
            $error = "";
            $errorData = [];

            $validatedData = $request->validate(Employee::$fieldsRules);

            $employee->company = 1;
            $employee->name = $request->name;
            $employee->civil_state = $request->civilstate;
            $employee->position = $request->position;
            $employee->sex = $request->sex;
            $employee->sector = $request->sector;
            $employee->vat = $request->vat;
            $employee->personal_id = $request->personalid;
            $employee->phone_number_1 = $request->tel1;
            $employee->phone_number_2 = $request->tel2;
            $employee->admission_date = $request->admissiondate;
            $employee->removal_date = $request->removaldate;
            $employee->resignation_date = $request->resignationdate;
            $employee->observation = $request->observations;
            $employee->save();
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

    public function update(Employee $employee, Request $request)
    {
        try {
            $error = "";
            $errorData = [];

            $validatedData = $request->validate(Employee::$fieldsRules);

            $employee->company = 1;
            $employee->name = $request->name;
            $employee->civil_state = $request->civilstate;
            $employee->position = $request->position;
            $employee->sex = $request->sex;
            $employee->sector = $request->sector;
            $employee->vat = $request->vat;
            $employee->personal_id = $request->personalid;
            $employee->phone_number_1 = $request->tel1;
            $employee->phone_number_2 = $request->tel2;
            $employee->admission_date = $request->admissiondate;
            $employee->removal_date = $request->removaldate;
            $employee->resignation_date = $request->resignationdate;
            $employee->observation = $request->observations;

            $employee->save();
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

    public function destroy(Employee $employee)
    {
        try {
            $error = "";
            $employee->delete();
        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }

        return json_encode([
            "status" => !$error ? "success" : "error",
            "message" => !$error ? "Removido com sucesso!" : $error
        ]);
    }
}
