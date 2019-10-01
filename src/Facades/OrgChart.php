<?php 
namespace Karbonsoft\OrgChart\Facades;
use Illuminate\Support\Facades\Facade;

class OrgChart extends Facade {
    /**
     * Return facade accessor
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'karbonsoftorgchart';
    }
}