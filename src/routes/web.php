<?php

Route::get('autoform', function(){
    return 'AutoForm 0.0.1 is installed successfully!';
});

$middleware = ['web'];
if(is_array(@config('autoform.middleware'))) {
    $middleware = array_merge($middleware, config('autoform.middleware'));
}

Route::middleware($middleware)->group(function() {

    if(!config('autoform.models')) {
        return;
    }

    foreach(config('autoform.models') as $modelName)
    {
        $modelName = strtolower($modelName);

        Route::get("$modelName/list", 'Tecdrip\LaravelAutoForm\Http\Controllers\FormController@list')->name($modelName . '/list');
        Route::get("$modelName/create", 'Tecdrip\LaravelAutoForm\Http\Controllers\FormController@create')->name($modelName . '/create');
        Route::get("$modelName/update/{id}", 'Tecdrip\LaravelAutoForm\Http\Controllers\FormController@update')->name($modelName . '/update');
        Route::get("$modelName/delete/{id}", 'Tecdrip\LaravelAutoForm\Http\Controllers\FormController@delete')->name($modelName . '/delete');

        Route::post("$modelName/create", 'Tecdrip\LaravelAutoForm\Http\Controllers\FormController@postCreate');
        Route::post("$modelName/update/{id}", 'Tecdrip\LaravelAutoForm\Http\Controllers\FormController@postUpdate');

        if($modelName ) {
            //Register Breadcrumbs
            //route("$modelName/list");
            Breadcrumbs::for($modelName . "/list", function ($trail) use($modelName) {
                $trail->push(ucfirst($modelName), route("$modelName/list"));
            });

            Breadcrumbs::for("$modelName/create", function ($trail)  use($modelName) {
                $trail->parent("$modelName/list");
                $trail->push('Create', route("$modelName/create"));
            });

            Breadcrumbs::for("$modelName/update", function ($trail, $id)  use($modelName) {
                $trail->parent("$modelName/list");
                $trail->push('Update', route("$modelName/update", $id));
            });
        }

    }
});

?>
