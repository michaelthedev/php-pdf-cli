<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\PdfServiceException;
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
        // check if is a file and html
        return is_file($this->htmlPath) && pathinfo($this->htmlPath)['extension'] === 'html';
    }

    /**
     * @throws PdfServiceException
     */
    public function generate(string $arg): void
    {
        $this->setHtmlPath($arg);

        if (!$this->fileExists()) {
            throw new PdfServiceException('File does not exist');
        }

        $htmlContent = $this->getHtmlContent();

        $savePath = $this->generator->generate($htmlContent);

        if (!$this->save($savePath)) {
            throw new PdfServiceException('Could not save the pdf');
        }
    }
}