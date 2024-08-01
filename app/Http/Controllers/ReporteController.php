<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use PDF;
use App\Exports\PrisioneroExport;
use Maatwebsite\Excel\Facades\Excel;

class ReporteController extends Controller
{
    public function generarPDF(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Aquí iría el código para generar el PDF
        $pdf = PDF::loadView('reportes.prisionero', compact('startDate', 'endDate'));

        return $pdf->download('reporte_prisionero.pdf');
    }

    public function generarExcel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Aquí iría el código para generar el archivo Excel
        return Excel::download(new PrisioneroExport($startDate, $endDate), 'reporte_prisionero.xlsx');
    }
}
