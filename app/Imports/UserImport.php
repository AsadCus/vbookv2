<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UserImport implements ToCollection, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function startRow(): int
    {
        return 3;
    }

    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            $division = Division::where('name', $row[2])->first();
            $company = Company::where('name', $row[7])->first();
            User::create([
                'name' => $row[1],
                // 'division_id' => $row[2],
                'division_id' => $division->id,
                'email' => $row[3],
                'username' => $row[4],
                'password' => Hash::make($row[5]),
                'no_telp' => $row[6],
                // 'company_id' => $row[7],
                'company_id' => $company->id,
                'role_id' => 3,
            ]);
        }
    }
}
