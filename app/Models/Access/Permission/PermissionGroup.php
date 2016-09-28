<?php

namespace App\Models\Access\Permission;

use App\Models\Access\Permission\Traits\Relationship\PermissionCroup;
use App\Models\Access\Permission\Traits\Relationship\PermissionCroupRelationship;
use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    use PermissionCroupRelationship;
}
