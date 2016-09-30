<?php

namespace App\Models\Access\Permission;

use App\Models\Access\Permission\Traits\Attribute\PermissionAttribute;
use App\Models\Access\Permission\Traits\Relationship\PermissionRelationship;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use PermissionRelationship, PermissionAttribute;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.permissions_table');
    }
}
