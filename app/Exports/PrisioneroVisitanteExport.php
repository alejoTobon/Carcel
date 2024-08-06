<?php

namespace App\Exports;

use App\Models\Prisionero;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\Storage;

class PrisioneroVisitanteExport
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headings
        $headings = ['Prisionero ID', 'Nombre Completo', 'Visitante Nombre', 'Fecha/Hora Visita', 'Guardia'];
        $columnLetters = ['A', 'B', 'C', 'D', 'E'];

        foreach ($headings as $index => $heading) {
            $cell = $columnLetters[$index] . '1';
            $sheet->setCellValue($cell, $heading);
            $sheet->getStyle($cell)->getFont()->setBold(true);
            $sheet->getStyle($cell)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('74c6ff');
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cell)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        }

        // Fetch data
        $prisioneros = Prisionero::with(['visitas.visitante'])
            ->whereHas('visitas', function($query) {
                $query->whereBetween('fecha_hora_inicio', [$this->startDate, $this->endDate]);
            })->get();

        $row = 2;
        foreach ($prisioneros as $prisionero) {
            foreach ($prisionero->visitas as $visita) {
                $sheet->setCellValue('A' . $row, $prisionero->id);
                $sheet->setCellValue('B' . $row, $prisionero->nombre_completo);
                $sheet->setCellValue('C' . $row, $visita->visitante->nombre_completo);
                $sheet->setCellValue('D' . $row, $visita->fecha_hora_inicio);
                $sheet->setCellValue('E' . $row, $visita->guardia->nombre_completo);
                
                // Apply styles for the content
                $sheet->getStyle('A' . $row . ':E' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                $sheet->getStyle('A' . $row . ':E' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                $row++;
            }
        }

        // Auto resize columns
        foreach ($columnLetters as $letter) {
            $sheet->getColumnDimension($letter)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'reporte_prisioneros.xlsx';

        // Save the file to a temporary path
        $tempFilePath = Storage::disk('local')->path($filename);
        $writer->save($tempFilePath);

        return $tempFilePath;
    }
}
