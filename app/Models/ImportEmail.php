<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportEmail implements ToModel
{
    use HasFactory;

    public function model(array $row)
    {
        return new Email([
            'email' => $row[0],
            'id_user'=>$row[1]
        ]);
    }
}
