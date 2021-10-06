<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cliente_id', 'valor_total'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function pedidoItems(){
        return $this->hasMany(PedidoItem::class, 'pedido_id', 'id');
    }
}
