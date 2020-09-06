<?php

namespace App\Imports;

use App\Rdv;
use Maatwebsite\Excel\Concerns\ToModel;

class RdvsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Rdv([
            //
        ]);
    }
}
