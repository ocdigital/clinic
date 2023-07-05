<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Plano;

class Convenio extends Model
{
    use HasFactory;

    public function planos()
    {
        return $this->hasMany(Plano::class);
    }
}
