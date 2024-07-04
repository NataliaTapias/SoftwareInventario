<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends Controller
{
    public function exportMovimientos(Request $request)
    {
        // Aplicar filtros si se proporcionan en la solicitud
        $query = Movimiento::query();

        if ($request->has('search')) {
            $query->where('firma', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('proveedor', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('observacion', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->has('item_name')) {
            $query->whereHas('item', function ($itemQuery) use ($request) {
                $itemQuery->where('nombre', 'like', '%' . $request->input('item_name') . '%');
            });
        }

        if ($request->has('tipoMovimientos_id')) {
            $query->where('tipo_movimiento_id', $request->input('tipoMovimientos_id'));
        }

        $movimientos = $query->get();

        // Crear el archivo Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Encabezados de columna
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Fecha');
        $sheet->setCellValue('C1', 'Cantidad');
        $sheet->setCellValue('D1', 'Item');
        $sheet->setCellValue('E1', 'Total');
        $sheet->setCellValue('F1', 'Solicitud');
        $sheet->setCellValue('G1', 'Observación');
        $sheet->setCellValue('H1', 'Tipo de Movimiento');
        $sheet->setCellValue('I1', 'Remisión Proveedor');
        $sheet->setCellValue('J1', 'Firma');
        $sheet->setCellValue('K1', 'Proveedor');
        $sheet->setCellValue('L1', 'Colaborador');
        $sheet->setCellValue('M1', 'Autor del Movimiento');

        
        // Datos de la tabla
        $row = 2;
        foreach ($movimientos as $movimiento) {
            $sheet->setCellValue('A' . $row, $movimiento->idMovimiento);
            $sheet->setCellValue('B' . $row, $movimiento->fecha);
            $sheet->setCellValue('C' . $row, $movimiento->cantidad);
            $sheet->setCellValue('D' . $row, $movimiento->item->nombre ?? 'N/A'); // Asumiendo que tienes una relación con la tabla de ítems
            $sheet->setCellValue('E' . $row, $movimiento->total);
            $sheet->setCellValue('F' . $row, $movimiento->solicitud->descripcionFalla ?? 'N/A'); // Asumiendo la relación con solicitud
            $sheet->setCellValue('G' . $row, $movimiento->observacion ?? 'N/A');
            $sheet->setCellValue('H' . $row, $movimiento->tipoMovimiento->nombre  ?? 'N/A');
            $sheet->setCellValue('I' . $row, $movimiento->numRemisionProveedor ?? 'N/A');
            $sheet->setCellValue('J' . $row, $movimiento->firma ?? 'N/A');
            $sheet->setCellValue('K' . $row, $movimiento->proveedor ?? 'N/A');
            $sheet->setCellValue('L' . $row, $movimiento->colaborador ?? 'N/A');
            $sheet->setCellValue('M' . $row, $movimiento->usuario->nombre ?? 'N/A'); 
            $row++;
        }

        // Guardar y descargar el archivo
        $writer = new Xlsx($spreadsheet);
        $fileName = 'movimientos.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName);
    }
}