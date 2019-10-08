<?php

namespace App\Support;

interface CsvFactory
{
    /**
     * @param  string  $path
     * @return \App\Support\Csv
     */
    public function createFromPath(string $path): Csv;
}
