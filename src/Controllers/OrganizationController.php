<?php

namespace Karbonsoft\OrgChart\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Karbonsoft\OrgChart\Models\Organization;
use Karbonsoft\OrgChart\Models\OrganizationItem;
use Karbonsoft\OrgChart\Facades\OrgChart;

class OrganizationController extends Controller
{

    public function createneworganization()
    {

        $organization = new Organization();
        $organization->name = request()->input("organizationname");
        $organization->save();
        return json_encode(array("resp" => $organization->id));
    }

    public function deleteitemorganization()
    {
        $organizationitem = OrganizationItem::find(request()->input("id"));

        $organizationitem->delete();
    }

    public function deleteorganizationg()
    {
        $organizations = new OrganizationItem();
        $getall = $organizations->getall(request()->input("id"));
        if (count($getall) == 0) {
            $organizationdelete = Organization::find(request()->input("id"));
            $organizationdelete->delete();

            return json_encode(array("resp" => "you delete this item"));
        } else {
            return json_encode(array("resp" => "You have to delete all items first", "error" => 1));

        }
    }

    public function updateitem()
    {
        $arraydata = request()->input("arraydata");
        if (is_array($arraydata)) {
            foreach ($arraydata as $value) {
                $organizationitem = OrganizationItem::find($value['id']);
                $organizationitem->label = $value['label'];
                $organizationitem->link = $value['link'];
                $organizationitem->class = $value['class'];
                if (config('organization.use_roles')) {
                    $organizationitem->role_id = $value['role_id'] ? $value['role_id'] : 0 ;
                }
                $organizationitem->save();
            }
        } else {
            $organizationitem = OrganizationItem::find(request()->input("id"));
            $organizationitem->label = request()->input("label");
            $organizationitem->link = request()->input("url");
            $organizationitem->class = request()->input("clases");
            if (config('organization.use_roles')) {
                $organizationitem->role_id = request()->input("role_id") ? request()->input("role_id") : 0 ;
            }
            $organizationitem->save();
        }
    }

    public function addcustomorganization()
    {

        $organizationItem = new OrganizationItem();
        $organizationItem->label = request()->input("labelorganization");
        $organizationItem->link = request()->input("linkorganization");
        if (config('organization.use_roles')) {
            $organizationItem->role_id = request()->input("roleorganization") ? request()->input("roleorganization")  : 0 ;
        }
        $organizationItem->organization = request()->input("idorganization");
        $organizationItem->sort = OrganizationItem::getNextSortRoot(request()->input("idorganization"));
        $organizationItem->save();

    }

    public function generateorganizationcontrol()
    {
        $organization = Organization::find(request()->input("idorganization"));
        $organization->name = request()->input("organizationname");

        $organization->save();
        if (is_array(request()->input("arraydata"))) {
            foreach (request()->input("arraydata") as $value) {

                $organizationitem = OrganizationItem::find($value["id"]);
                $organizationitem->parent = $value["parent"];
                $organizationitem->sort = $value["sort"];
                $organizationitem->depth = $value["depth"];
                if (config('organization.use_roles')) {
                    $organizationitem->role_id = request()->input("role_id");
                }
                $organizationitem->save();
            }
        }
        echo json_encode(array("resp" => 1));

    }
}
