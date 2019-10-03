<?php

namespace Karbonsoft\OrgChart\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationItem extends Model
{
    const PERSON = 'person';
    const ORGANIZATION = 'organization';


    protected $table = null;

    protected $fillable = ['label', 'link', 'parent', 'sort', 'class', 'organization', 'depth', 'type', 'photo', 'persondetails', 'organizationdetails'];

    public function __construct(array $attributes = [])
    {
        //parent::construct( $attributes );
        $this->table = config('organization.table_prefix') . config('organization.table_name_organization_items');
    }

    public static function getNextSortRoot($organization)
    {
        return self::where('organization', $organization)->max('sort') + 1;
    }

    public function getsons($id)
    {
        return $this->where("parent", $id)->get();
    }

    public function getall($id)
    {
        return $this->where("organization", $id)->orderBy("sort", "asc")->get();
    }

    public function organization()
    {
        return $this->belongsTo("Organization" ,"organization","id");
    }
}
