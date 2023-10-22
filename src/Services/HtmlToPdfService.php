<?php

namespace App\Services;

use App\Services\Abstract\PdfService;

final class HtmlToPdfService extends PdfService
{
    private string $htmlPath;

    public function setHtmlPath(string $htmlPath): self
    {
        $this->htmlPath = $htmlPath;
        return $this;
    }

    private function getHtmlContent(): string
    {
        return file_get_contents($this->htmlPath);
    }

    public function fileExists(): bool
    {
        return file_exists($this->htmlPath);
    }

    public function generatePdf()
    {
        // TODO: Implement generatePdf() method.
    }
}