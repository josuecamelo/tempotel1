<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'data_nascimento', 'telefone', 'ativo'
    ];

    public function getDataNascimentoAttribute($value){
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }
    public function setDataNascimentoAttribute($value){
        $this->attributes['data_nascimento'] = \DateTime::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
}
