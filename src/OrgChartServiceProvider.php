<?php

namespace Karbonsoft\OrgChart;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class OrgChartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            require  __DIR__ . '/routes.php';
        }

        $this->loadViewsFrom(__DIR__ . '/Views', 'orgchart');

        $this->publishes([
            __DIR__ . '/../config/organization.php' => config_path('organization.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/Views'   => resource_path('views/vendor/orgchart'),
        ], 'view');

        $this->publishes([
            __DIR__ . '/../assets' => public_path('vendor/karbonsoft-orgchart'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/../migrations/2017_08_11_073824_create_organizations_table.php' => database_path('migrations/2017_08_11_073824_create_organizations_table.php'),
            __DIR__ . '/../migrations/2017_08_11_074006_create_organization_items__table.php' => database_path('migrations/2017_08_11_074006_create_organization_items__table.php'),
            __DIR__ . '/../migrations/2019_01_05_293551_add-role-id-to-organization-items-table.php' => database_path('2019_01_05_293551_add-role-id-to-organization-items-table.php'),
        ], 'migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('karbonsoft-orgchart', function () {
            return new OrgChart();
        });

        $this->app->make('Karbonsoft\OrgChart\Controllers\OrganizationController');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/organization.php',
            'organization'
        );
    }
}
