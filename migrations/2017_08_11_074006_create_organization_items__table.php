<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( config('organization.table_prefix') . config('organization.table_name_organization_items') , function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->string('link');
            $table->integer('parent')->unsigned()->default(0);
            $table->integer('sort')->default(0);
            $table->string('class')->nullable();
            $table->integer('organization')->unsigned();
            $table->integer('depth')->default(0);
            $table->timestamps();

            $table->foreign('organization')->references('id')->on(config('organization.table_prefix') . config('organization.table_name_organizations'))
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( config('organization.table_prefix') . config('organization.table_name_organization_items'));
    }
}
