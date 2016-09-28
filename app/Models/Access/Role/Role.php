<?php

namespace App\Models\Access\Role;

use App\Models\Access\Role\Traits\Attribute\RoleAttribute;
use App\Models\Access\Role\Traits\Relationship\RoleRelationship;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use RoleRelationship,RoleAttribute;
}
