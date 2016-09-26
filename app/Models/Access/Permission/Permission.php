<?php

namespace App\Models\Access\Permission;

use App\Models\Access\Permission\Traits\Relationship\PermissionRelationship;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use PermissionRelationship;
}
