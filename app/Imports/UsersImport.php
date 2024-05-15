<?php

namespace App\Imports;

use App\Models\Materias;
use App\Models\Materias2;
use App\Models\User2;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow

{
    protected $id_rvoe;

    public function __construct($id_rvoe)
    {
        $this->id_rvoe = $id_rvoe;
    }


    public function collection(Collection $rows)
    {
        // dd($rows); //valida que los datos de la hoja de exel sean leidos
        // foreach($rows as $row){
        //     User2::create([
        //         'name'=>$row['name'],
        //         'email'=>$row['email']
        //     ]);
        // }

        foreach ($rows as $row) {
            Materias::create([
                'name' => $row['name'],
                'materia' => $row['materia'],
                'id_rvoe' => $this->id_rvoe
            ]);
        }
    }
}
