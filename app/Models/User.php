<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users'; 
    protected $primaryKey = 'id_users'; 

    protected $fillable = [
        'name_users',
        'email_users',
        'pass_users',
        'id_level',
        'as_users',
        'pic_users',
        'role',
    ];

    protected $hidden = [
        'pass_users',
    ];
 
    public function getAuthPassword()
    {
        return $this->pass_users;
    }
}
