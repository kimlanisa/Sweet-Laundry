<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'karyawan_id','name', 'email', 'password','status','auth','alamat','no_telp','theme','foto','point'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function bank()
    {
      return $this->hasOne(DataBank::class);
    }

    public function transaksi()
    {
      return $this->belongsTo(transaksi::class,'id','user_id');
    }

    public function transaksiCustomer()
    {
      return $this->hasMany(transaksi::class,'customer_id','id');
    }
}
