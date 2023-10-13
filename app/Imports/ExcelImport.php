<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ExcelImport implements ToCollection
{
    protected $data = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $this->data[] = [
                'part_no'   => $row[0],
                'dbp'       => $row[1],
            ];
        }
    }

    public function getData()
    {
        return $this->data;
    }
}
