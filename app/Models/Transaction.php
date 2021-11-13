<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_transaksi';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
        
    protected $guarded = [
        'id'
    ];

    public function transactionDetail(){
        return $this->hasMany(TransactionDetail::class, 'id_transaksi');
    }

    public function outlet() {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function member() {
        return $this->belongsTo(Member::class, 'id_member');
    }
}
