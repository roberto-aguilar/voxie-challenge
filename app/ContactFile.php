<?php

namespace App;

use App\Support\Csv;
use Exception;
use Facades\App\Support\CsvFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ContactFile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'path',
        'field_mappings'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'field_mappings' => 'json',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'csv_fields',
        'csv_records',
    ];

    /**
     * @return \App\Support\Csv
     */
    public function getCsvAttribute(): Csv
    {
        try {
            return CsvFactory::createFromPath(
                Storage::cloud()->path($this->path)
            );
        } catch (Exception $exception) {
            return tap(new Csv, function ($csv) {
                $csv->headers = [];
                $csv->records = [];
            });
        }
    }

    /**
     * @return array
     */
    public function getCsvFieldsAttribute()
    {
        return $this->csv->headers;
    }

    /**
     * @return array
     */
    public function getCsvRecordsAttribute()
    {
        return $this->csv->records;
    }
}
