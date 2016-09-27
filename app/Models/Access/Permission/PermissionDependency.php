<?php

namespace App\Models\Access\Permission;

use App\Models\Access\Permission\Traits\Relationship\PermissionDependencyRelationship;
use Illuminate\Database\Eloquent\Model;

class PermissionDependency extends Model
{
    use PermissionDependencyRelationship;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.permission_dependencies_table');
    }
}
