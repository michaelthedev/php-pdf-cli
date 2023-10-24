<?php

namespace App\Libraries\DomPdf;

use App\Interfaces\Pdf\PdfGeneratorInterface;
use Dompdf\Dompdf;

class DomPdfGenerator implements PdfGeneratorInterface
{
    public function __construct()
    {
        $this->dompdf = new Dompdf();
    }

    /**
     * @inheritDoc
     */
    public function generate(string $content): string
    {
        $this->dompdf->loadHtml($content);
        $this->dompdf->render();

        $output = $this->dompdf->output();
        $filePath = tempnam(sys_get_temp_dir(), 'pdf');
        file_put_contents($filePath, $output);

        return $filePath;
    }
}