<?php

namespace App\Http\Controllers;

use App\Specie;
use Illuminate\Http\Request;

class SpecieController extends Controller
{
    public function selectComponent(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $species = Specie::orderby('name', 'asc')->select('id', 'name')->paginate(25);
        } else {
            $species = Specie::orderby('name', 'asc')->select('id', 'name')->where('name', 'like', '%' . $search . '%')->paginate(25);
        }

        $response = [];
        foreach ($species as $customer) {
            $response[] = array(
                "id" => $customer->id,
                "text" => $customer->name
            );
        }

        return json_encode(
            [
                "results" => $response,
                "pagination" => [
                    "more" => $species->hasMorePages()
                ]
            ]
        );
    }
}
