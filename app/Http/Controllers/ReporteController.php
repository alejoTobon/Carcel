<?php
namespace App\Http\Controllers;

use App\Models\Prisionero;
use App\Models\Visita;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PrisioneroVisitanteExport;

class ReporteController extends Controller
{
    // Método para generar PDF
    public function generarPDF(Request $request)
    {
    
        
     $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $prisioneros = Prisionero::with(['visitas.visitante'])
            ->whereHas('visitas', function($query) use ($startDate, $endDate) {
                $query->whereBetween('fecha_hora_inicio', [$startDate, $endDate]);
            })->get();

        $pdf = Pdf::loadView('reportes.prisionero_pdf', compact('prisioneros', 'startDate', 'endDate'));

        return $pdf->download('reporte_prisioneros.pdf');
    }

    // Método para generar Excel
    public function generarExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $exporter = new PrisioneroVisitanteExport($startDate, $endDate);
        $filePath = $exporter->export();

        // Descarga el archivo generado
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
