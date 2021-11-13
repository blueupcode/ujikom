<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_member';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
        
    protected $guarded = [
        'id'
    ];

    public function transaction() {
        return $this->hasMany(Transaction::class, 'id_member');
    }

    public function outlet() {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }
}
