<?php

namespace App\Imports;

use App\Models\Materias;
use App\Models\User2;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow

{

    public function collection(Collection $rows)
    {
        // dd($rows);valida que los datos de la hoja de exel sean leidos
        // foreach($rows as $row){
        //     User2::create([
        //         'name'=>$row['name'],
        //         'email'=>$row['email']
        //     ]);
        // }

        foreach ($rows as $row) {
            Materias::create([
                'id_materia' => $row['id_materia'],
                'materia' => $row['materia'],
                'id_rvoe' => $row['id_rvoe']
            ]);
        }
    }
}
