<?php

declare(strict_types=1);

namespace App\Services\Abstract;

use App\Interfaces\PdfServiceInterface;

abstract class PdfService implements PdfServiceInterface
{
    protected string $savePath;

    protected string $pageUrl;

    public function save(string $path): bool
    {
        // TODO: Implement save() method.
        return false;
    }

    public function getPath(): string
    {
        return $this->savePath;
    }
}