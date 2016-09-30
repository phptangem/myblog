<?php

namespace App\Models\Access\Permission;

use App\Models\Access\Permission\Traits\Attribute\PermissionGroupAttribute;
use App\Models\Access\Permission\Traits\Relationship\PermissionGroupRelationship;
use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    use PermissionGroupRelationship,PermissionGroupAttribute;

    protected $guarded = ['id'];
}
