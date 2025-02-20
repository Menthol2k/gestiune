<?php

namespace App\Http\Controllers\Commissionings;

use Carbon\Carbon;
use App\Models\Commission;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Http\Controllers\Controller;
use App\Models\CommissionItems;

class Download extends Controller
{
    public function __invoke(Commission $commission)
    {
        $commission->load('client');
        $client = $commission->client;
        $items = CommissionItems::where('commission_id', $commission->id)->get();

        function removeDiacritics($string)
        {
            $diacritics = ['ă', 'â', 'î', 'ș', 'ț', 'Ă', 'Â', 'Î', 'Ș', 'Ț'];
            $replacements = ['a', 'a', 'i', 's', 't', 'A', 'A', 'I', 'S', 'T'];
            return str_replace($diacritics, $replacements, $string);
        }

        $pdf = new Fpdf();
        $pdf->AddPage();
        $pdf->SetFont('Times', 'BU', 14);
        $pdf->Cell(0, 10, 'PROCES-VERBAL DE PUNERE IN FUNCTIUNE', 0, 1, 'C');
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 10, "NR. {$commission->number} / {$commission->year}", 0, 1, 'C');

        $completedDate = Carbon::parse($commission->completed)->format('d/m/Y');
        $pdf->SetFont('Times', '', 10);
        $pdf->MultiCell(0, 6, "Incheiat astazi, {$completedDate}, cu ocazia punerii in functiune a sistemelor de ecoinsule, in baza contractului incheiat intre " .
            removeDiacritics($client->name) . ", cu sediul in " . removeDiacritics($client->office_address) .
            ", inregistrata la Registrul Comertului sub nr. " . removeDiacritics($client->reg_com) .
            ", avand CUI " . removeDiacritics($client->cui) .
            ", reprezentata legal de " . removeDiacritics($client->contact_person) . " si LODGRIN NETWORK SRL.");

        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 10, "1. LOCUL INSTALARII", 0, 1);
        $pdf->SetFont('Times', '', 10);

        foreach ($items as $index => $item) {
            $pdf->Cell(0, 6, "- " . removeDiacritics($item->name), 0, 1);
        }

        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 10, "2. CONSTATARI SI RECEPTIE", 0, 1);
        $pdf->SetFont('Times', '', 10);
        $pdf->MultiCell(0, 6, "Sistemele sunt instalate si functionale, fara deficiente. Receptia este acceptata fara obiectiuni.");

        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 15, "3. SEMNATURI", 0, 1);

        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(90, 6, "Beneficiar", 0, 0, 'L');
        $pdf->Cell(90, 6, "Prestator", 0, 1, 'R');

        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(90, 6, removeDiacritics($client->name), 0, 0, 'L');
        $pdf->Cell(90, 6, "LODGRIN NETWORK S.R.L.", 0, 1, 'R');

        $pdf->SetFont('Times', '', 9);
        $pdf->Cell(90, 6, "Reprezentant: " . removeDiacritics($client->contact_person), 0, 0, 'L');
        $pdf->Cell(90, 6, "Reprezentant: Lamba Gabriel-Octavian", 0, 1, 'R');

        $pdf->Cell(90, 6, "Data: ___________________", 0, 0, 'L');
        $pdf->Cell(90, 6, "Data: ______________", 0, 1, 'R');

        $pdf->Cell(90, 6, "Semnatura: ______________", 0, 0, 'L');
        $pdf->Cell(90, 6, "Semnatura: ______________", 0, 1, 'R');

        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="proces-verbal.pdf"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        $pdf->Output('D', "PF_{$commission->number}_{$commission->year}.pdf");
        exit;
    }
}
