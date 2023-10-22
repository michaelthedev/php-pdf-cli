<?php

declare(strict_types=1);

namespace App\Interfaces;

interface PdfServiceInterface
{
    public function generatePdf();

    /**
     * Get current path to the generated pdf
     * @return string
     */
    public function getPath(): string;

    /**
     * @param string $path Path to save the generated pdf path
     * @return mixed
     */
    public function save(string $path): bool;
}