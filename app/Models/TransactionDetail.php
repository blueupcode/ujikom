<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_detail_transaksi';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    
    protected $guarded = [
        'id'
    ];

    public function package() {
        return $this->belongsTo(Package::class, 'id_paket');
    }

    public function transaction() {
        return $this->belongsToMany(Transaction::class, 'id_transaksi');
    }
}
