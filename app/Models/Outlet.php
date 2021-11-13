<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_outlet';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */

    protected $guarded = [
        'id'
    ];

    public function user() {
        return $this->hasMany(User::class, 'id_outlet');
    }

    public function member() {
        return $this->hasMany(Member::class, 'id_outlet');
    }

    public function package() {
        return $this->hasMany(Package::class, 'id_outlet');
    }

    public function transaction() {
        return $this->hasMany(Transaction::class, 'id_outlet');
    }
}
