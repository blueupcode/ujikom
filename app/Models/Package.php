<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_paket';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
        
    protected $guarded = [
        'id'
    ];

    public function outlet() {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }

    public function transactionDetail() {
        return $this->hasMany(TransactionDetail::class, 'id_paket');
    }
}
