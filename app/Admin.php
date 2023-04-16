<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    protected $guard_name = 'web';
    protected $guard = 'admin';
    protected $fillable = [ 'name', 'mobile', 'email','type','password', 'image', 'status', 'created_at', 'updated_at',];
    protected $hidden = [ 'password', 'remember_token',];

    public function product(){
        return $this->hasMany('App\Product', 'admin_id');
    }
}
