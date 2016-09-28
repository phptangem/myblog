<?php

namespace App\Models\Access\User;

use App\Models\Access\User\Traits\Attribute\UserAttribute;
use App\Models\Access\User\Traits\Relationship\UserRelationship;
use App\Models\Access\User\Traits\UserAccess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as  Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes, UserAttribute,UserRelationship,UserAccess;

    protected $guarded = ['id'];

    protected $hidden  = ['password', 'remember_token'];
    protected $dates = ['deleted_at'];
}
