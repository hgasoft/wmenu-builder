<?php

namespace Karbonsoft\OrgChart\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organizations';

    public function __construct(array $attributes = [])
    {
        //parent::construct( $attributes );
        $this->table = config('organization.table_prefix') . config('organization.table_name_organizations');
    }

    public static function byName($name)
    {
        return self::where('name', '=', $name)->first();
    }

}
