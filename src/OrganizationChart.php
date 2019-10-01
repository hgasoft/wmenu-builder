<?php

namespace Karbonsoft\OrgChart;

use App\Http\Requests;
use DB;
use Karbonsoft\OrgChart\Models\Organization;
use Karbonsoft\OrgChart\Models\OrganizationItem;

class OrganizationChart
{

    public function render()
    {
        $organization = new Organization();
        $organizationitems = new OrganizationItem();
        $organizationlist = $organization->select(['id', 'name'])->get();
        $organizationlist = $organizationlist->pluck('name', 'id')->prepend('Select organization', 0)->all();

        //$roles = Role::all();

        if ((request()->has("action") && empty(request()->input("organization"))) || request()->input("organization") == '0') {
            return view('orgchart::organization-html')->with("organizationlist" , $organizationlist);
        } else {

            $organization = Organization::find(request()->input("organization"));
            $organizations = $organizationitems->getall(request()->input("organization"));

            $data = ['organizations' => $organizations, 'indorganization' => $organization, 'organizationlist' => $organizationlist];
            if( config('organization.use_roles')) {
                $data['roles'] = DB::table(config('organization.roles_table'))->select([config('organization.roles_pk'),config('organization.roles_title_field')])->get();
                $data['role_pk'] = config('organization.roles_pk');
                $data['role_title_field'] = config('organization.roles_title_field');
            }
            return view('orgchart::organization-html', $data);
        }

    }

    public function scripts()
    {
        return view('orgchart::scripts');
    }

    public function select($name = "organization", $organizationlist = array())
    {
        $html = '<select name="' . $name . '">';

        foreach ($organizationlist as $key => $val) {
            $active = '';
            if (request()->input('organization') == $key) {
                $active = 'selected="selected"';
            }
            $html .= '<option ' . $active . ' value="' . $key . '">' . $val . '</option>';
        }
        $html .= '</select>';
        return $html;
    }


    /**
     * Returns empty array if organization not found now.
     * Thanks @sovichet
     *
     * @param $name
     * @return array
     */
    public static function getByName($name)
    {
        $organization = Organization::byName($name);
        return is_null($organization) ? [] : self::get($organization->id);
    }

    public static function get($organization_id)
    {
        $organizationItem = new OrganizationItem;
        $organization_list = $organizationItem->getall($organization_id);

        $roots = $organization_list->where('organization', (integer) $organization_id)->where('parent', 0);

        $items = self::tree($roots, $organization_list);
        return $items;
    }

    private static function tree($items, $all_items)
    {
        $data_arr = array();
        $i = 0;
        foreach ($items as $item) {
            $data_arr[$i] = $item->toArray();
            $find = $all_items->where('parent', $item->id);

            $data_arr[$i]['child'] = array();

            if ($find->count()) {
                $data_arr[$i]['child'] = self::tree($find, $all_items);
            }

            $i++;
        }

        return $data_arr;
    }

}
