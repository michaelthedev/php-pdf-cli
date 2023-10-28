<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\PdfServiceException;
use App\Services\Abstract\PdfService;

final class WebpageToPdfService extends PdfService
{
    private string $pageUrl;

    public function setPageUrl(string $pageUrl): self
    {
        $this->pageUrl = $pageUrl;
        return $this;
    }

    private function getHtmlContent(): string
    {
        return file_get_contents($this->pageUrl);
    }

    public function isValidUrl(): bool
    {
        // check the url is valid
        return filter_var($this->pageUrl, FILTER_VALIDATE_URL);
    }

    /**
     * @throws PdfServiceException
     */
    public function generate(string $arg): void
    {
        $this->setPageUrl($arg);

        if (!$this->isValidUrl()) {
            throw new PdfServiceException('Argument is not a valid web url');
        }

        $htmlContent = $this->getHtmlContent();

        $savePath = $this->generator->generate($htmlContent);

        if (!$this->save($savePath)) {
            throw new PdfServiceException('Could not save the pdf');
        }
    }
}