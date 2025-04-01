<?php

namespace App\Exceptions;

use Exception;

class ImportException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     */
    public function render()
    {
        return response()->json([
            'message' => 'Customer import failed',
            'error' => $this->getMessage()
        ], 500);
    }
}