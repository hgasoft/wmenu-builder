<?php

Route::group(['middleware' => config('organization.middleware')], function () {
    //Route::get('orgchartindex', array('uses'=>'\Karbonsoft\OrgChart\Controllers\OrganizationController@orgchartindex')); HAKYUREK
    $path = rtrim(config('organization.route_path'));
    Route::post($path . '/addcustomorganization', array('as' => 'haddcustomorganization', 'uses' => '\Karbonsoft\OrgChart\Controllers\OrganizationController@addcustomorganization'));
    Route::post($path . '/deleteitemorganization', array('as' => 'hdeleteitemorganization', 'uses' => '\Karbonsoft\OrgChart\Controllers\OrganizationController@deleteitemorganization'));
    Route::post($path . '/deleteorganizationg', array('as' => 'hdeleteorganizationg', 'uses' => '\Karbonsoft\OrgChart\Controllers\OrganizationController@deleteorganizationg'));
    Route::post($path . '/createneworganization', array('as' => 'hcreateneworganization', 'uses' => '\Karbonsoft\OrgChart\Controllers\OrganizationController@createneworganization'));
    Route::post($path . '/generateorganizationcontrol', array('as' => 'hgenerateorganizationcontrol', 'uses' => '\Karbonsoft\OrgChart\Controllers\OrganizationController@generateorganizationcontrol'));
    Route::post($path . '/updateitem', array('as' => 'hupdateitem', 'uses' => '\Karbonsoft\OrgChart\Controllers\OrganizationController@updateitem'));
});
