<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoleIdToOrganizationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('organization.table_prefix') . config('organization.table_name_organization_items'), function ($table) {
            $table->integer('role_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('organization.table_prefix') . config('organization.table_name_organization_items'), function ($table) {
            $table->dropColumn('role_id');
        });
    }
}
