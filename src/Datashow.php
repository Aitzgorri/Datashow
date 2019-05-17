<?php

namespace Aitzgorri\Datashow;

use Aitzgorri\Datashow\Searches\SearchFilter;
use Aitzgorri\Datashow\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;

class Datashow extends Model
{
    use Filterable;

    /* return the prefix for Datashow routes from the config file */
    public function prefixPath() {
        return config('datashow.prefixPath', 'datashow');
    }

    /* return the path where the specific model is stored . Get the general path where models are stored
    from the config file */
    public static function modelPath($modelName) {
        return config('datashow.modelPath', '\\App\\') . $modelName;
    }

    /* return builder instance of model */
    public static function getModel($modelName) {
        $modelPath = self::modelPath($modelName);

        return App::make($modelPath);
    }

    /** GET ATTRIBUTES */

    public static function getModelColumns(Model $model) {
        $table = $model->getTable();

        return array_diff(Schema::getColumnListing($table), $model->getHidden());
    }

    /** GET DATA */

    public static function getModelData(Model $model, SearchFilter $filters){
        return $model->modelFilter($filters)->get();
    }

    /** VIEWS */

    /**
     * @param $modelName
     * @param SearchFilter $filters
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function showModelData($modelName, SearchFilter $filters) {
        $modeInstance = Datashow::getModel($modelName);

        return view('Datashow::ds_table')
            ->with('columns', self::getModelColumns($modeInstance))
            ->with('model', self::getModelData($modeInstance, $filters))
            ;
    }

}