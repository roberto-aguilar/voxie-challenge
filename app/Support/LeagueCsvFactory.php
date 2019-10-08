<?php

namespace App\Support;

use League\Csv\Reader;

class LeagueCsvFactory implements CsvFactory
{
    /**
     * @param  string  $path
     * @return \App\Support\Csv
     */
    public function createFromPath($path): Csv
    {
        $reader = Reader::createFromPath($path);
        $reader->setHeaderOffset(0);

        return tap(new Csv, function ($csv) use ($reader) {
            $csv->headers = $reader->getHeader();
            $csv->records = iterator_to_array($reader->getRecords());
        });
    }
}
