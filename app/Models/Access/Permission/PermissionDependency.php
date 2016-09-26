<?php

namespace App\Models\Access\Permission;

use App\Models\Access\Permission\Traits\Relationship\PermissionDependencyRelationship;
use Illuminate\Database\Eloquent\Model;

class PermissionDependency extends Model
{
    use PermissionDependencyRelationship;
}
