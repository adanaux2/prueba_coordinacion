<?php

namespace App\Http\Controllers;

use App\Models\Disponibilidad;
use App\Models\MapaCurricular;
use App\Models\Profesor;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class pdfMapaDisposicionController extends Controller
{
    //
    public function pdfMaestro($request)
    {
        // return $request;
        $maestros = Profesor::where('curp', $request)->get();
        // Check if a professor was found
        if ($maestros->isEmpty()) {
            return response()->json(['error' => 'Profesor no encontrado'], 404);
        }
        $id_profe = $maestros[0]->id_profe;
        $clave = $maestros[0]->c_licenciatura;
        $nombre = $maestros[0]->nombre_c;
        // return $id_profe;
        // return $maestros;

        $disposicion = Disponibilidad::where('id_profe', $id_profe)->get();
        // Check if a professor was found
        if ($disposicion->isEmpty()) {
            // return response()->json(['error' => 'Profesor not found'], 404);
        }
        // return $disposicion;
        $mapa = MapaCurricular::where('id_profe', $id_profe)->get();
        if ($mapa->isEmpty()) {
            // return response()->json(['error' => 'Profesor not found'], 404);
        }
        // return $mapa;
        // Initialize the PDF
        $fpdf = new Fpdf();
        $fpdf->AddPage();


        $imagePath = public_path('img/pdf/logo.jpeg'); // Ajusta la ruta según sea necesario
        $fpdf->Image($imagePath, 10, 15, 40); // (file, x position, y position, width)


        $imagePath2 = public_path('img/pdf/nas.jpg'); // Ajusta la ruta según sea necesario
        $fpdf->Image($imagePath2, 145, 15, 55);

        // Ajustar la posición Y para el texto (puede ajustar esta posición según sea necesario)
        $fpdf->SetY(10);
        // Establecer la fuente para texto en negritas
        $fpdf->SetFont('Courier', 'B', 18);

        // Añadir una celda con texto centrado
        $fpdf->Cell(0, 5, utf8_decode('UNIVERSIDAD AZTLÁN'), 0, 1, 'C');
        $fpdf->Cell(0, 10, utf8_decode('PLANTEL CANCÚN 2'), 0, 1, 'C');

        $fpdf->SetFont('Courier', '', 16);

        $fpdf->Cell(0, 5, utf8_decode('INFORMACIÓN DOCENTE'), 0, 1, 'C');
        $fpdf->Cell(0, 10, utf8_decode('NOMBRE: '), 0, 1, 'C');

        $fpdf->Cell(0, 5, utf8_decode($nombre), 0, 1, 'C');
        $fpdf->Cell(0, 10, utf8_decode('USUARIO: '), 0, 1, 'C');

        $fpdf->Cell(0, 5, utf8_decode($clave), 0, 1, 'C');


        $fpdf->SetFont('Courier', 'B', 14);

        $fpdf->Cell(0, 10, utf8_decode('DISPONIBILIDAD DE HORARIOS: '), 0, 1, 'L');

        $fpdf->SetFont('Courier', '', 14);
        foreach ($disposicion as $dispo) {
            $fpdf->Cell(0, 5, utf8_decode($dispo->horario[0]->dia . ' ' . $dispo->horario[0]->hora), 0, 1, 'L');
        }
        // $fpdf->Cell(0, 10, utf8_decode($disposicion), 0, 1, 'L');
        $fpdf->SetFont('Courier', 'B', 14);

        $fpdf->Cell(0, 10, utf8_decode('MATERIAS CARGADAS: '), 0, 1, 'L');

        $fpdf->SetFont('Courier', '', 14);
        foreach ($mapa as $m) {
            $fpdf->Cell(0, 5, utf8_decode($m->materias[0]->materia), 0, 1, 'L');
        }
        $fpdf->Output();

        exit;
    }
}
