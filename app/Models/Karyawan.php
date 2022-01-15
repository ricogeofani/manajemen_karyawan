<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function delete_foto()
    {
        if ($this->foto && file_exists(public_path('images/' . $this->foto)))
            return unlink(public_path('images/' . $this->foto));
    }
}
