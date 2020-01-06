<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name','display_name'];
    public function permission(){
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}
