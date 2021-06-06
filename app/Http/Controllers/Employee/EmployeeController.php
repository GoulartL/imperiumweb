<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->header('company');

        return datatables()
            ->query(
                DB::table('employees')
                    ->where('employees.company', '=', $company)
                    ->select(
                        'employees.*',
                        DB::raw("CASE sex WHEN 1 THEN 'MASC' WHEN 2 THEN 'FEM' END AS sex_name"),
                        DB::raw("CASE civil_state WHEN 1 THEN 'Casado(a)' WHEN 2 THEN 'Solteiro(a)' END AS civil_state_name")
                    )
                    ->orderBy('name')
            )
            ->escapeColumns([])
            ->toJson();
    }

    public function show(Employee $employee, Request $request)
    {
        $company = $request->header('company');

        $query = DB::table('employees')
            ->where('employees.id', '=', $employee->id)
            ->where('employees.company', '=', $company)
            ->select(
                'employees.*',
                DB::raw("CASE sex WHEN 1 THEN 'MASC' WHEN 2 THEN 'FEM' END AS sex_name"),
                DB::raw("CASE civil_state WHEN 1 THEN 'Casado(a)' WHEN 2 THEN 'Solteiro(a)' END AS civil_state_name")
            )->get();

        return response(
            array(
                "data" => $query->toArray()
            )
        );
    }

    public function store(Request $request)
    {
        $employee = new Employee();
        try {
            $error = "";
            $errorData = [];

            $validatedData = $request->validate(Employee::$fieldsRules);
            $company = $request->header('company');

            $employee->company = $company;
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
