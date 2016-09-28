<?php
namespace App\Models\Access\Role\Traits\Attribute;

trait RoleAttribute
{
    /**
     * @return string
     */
    public function getEditRoleButtonAttribute()
    {
        if(access()->allow('edit-roles')){
            return '<a href="' . route('backend.access.roles.edit', $this->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a> ';
        }
    }

    /**
     * @return string
     */
    public function getDeleteRoleButtonAttribute()
    {
        if($this->id != 1){
            if(access()->allow('delete-roles')){
                return '<a href="' . route('backend.access.roles.destroy', $this->id) . '" class="btn btn-xs btn-danger" data-method="delete"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
            }
        }
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getEditRoleButtonAttribute().' '.
            $this->getDeleteRoleButtonAttribute();
    }
}