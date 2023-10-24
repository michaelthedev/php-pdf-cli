<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Exceptions\PdfServiceException;

interface PdfServiceInterface
{

    /**
     * @param string $arg The content source for the pdf
     * @throws PdfServiceException
     * @return void
     */
    public function generate(string $arg): void;

    /**
     * Get current path to the generated pdf
     * @return string
     */
    public function getPath(): string;
}