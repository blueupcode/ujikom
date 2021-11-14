<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'tb_user';

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'password'
    ];
    
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'id_user');
    }
}
