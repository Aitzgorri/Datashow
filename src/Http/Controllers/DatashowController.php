<?php

namespace Aitzgorri\Datashow\Http\Controllers;

use Aitzgorri\Datashow\Datashow;
use Aitzgorri\Datashow\Searches\SearchFilter;
use Illuminate\Routing\Controller;

class DatashowController extends Controller
{
    /** API */
    public function getModelData($modelName, SearchFilter $filters) {
        return Datashow::getModelData(Datashow::getModel($modelName), $filters);
    }

    /** VIEWS */
    public function showModelData($modelName, SearchFilter $filters) {
        return Datashow::showModelData($modelName, $filters);
    }
}
