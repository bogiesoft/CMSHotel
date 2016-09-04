<?php

namespace App\Http\Controllers;

use App\TableReservationType;
use Illuminate\Http\Request;

use App\Http\Requests;

class TableReservationTypeController extends Controller
{
    public function store(Request $request)
    {
        //
        $type = new TableReservationType();
        $type->name = $request->name;
        $type->duration = $request->duration;
        $type->save();

        return back();
    }
    public function update(Request $request, TableReservationType $type)
    {
        //
        $type->duration = $request->duration;
        $type->name = $request->name;
        $type->update();

        if($request->ajax())
            return response()->json($type);
        return back();
    }

    public function destroy(TableReservationType $type)
    {
        TableReservationType::destroy($type->id);
        return response()->json('delete');
    }
}
