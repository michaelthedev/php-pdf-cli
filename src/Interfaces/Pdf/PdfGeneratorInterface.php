<?php

declare(strict_types=1);

namespace App\Interfaces\Pdf;

use App\Exceptions\PdfServiceException;

interface PdfGeneratorInterface
{
    /**
     * @param string $content The content source for the pdf
     * @return string
     * @throws PdfServiceException
     */
    public function generate(string $content): string;
}