<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidDate implements Rule
{
    public function passes($attribute, $value)
    {
        $date = intval($value);
        // Validasi apakah value adalah tanggal yang benar
        return is_int($value) && ($value > 44000) && (bool) \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)->format('Y-m-d');
    }

    public function message()
    {
        return ':attribute harus dengan format date.';
    }
}
