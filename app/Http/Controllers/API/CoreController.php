<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoreController extends Controller
{
    /**
     * @param Request $request
     * @param String $modelName
     * @return array|mixed
     */
    public function getSidebar(Request $request, String $modelName = ''): mixed
    {
        $model = $this->getModel($modelName);
        $resource = $this->getResource($modelName . 'SidebarResource');

        if (!class_exists($model) || !class_exists($resource)) {
            return null;
        }

        // TODO: apply filters

        $list = $model::query()
            ->orderBy('id', 'DESC')
            ->paginate();

        return $resource::collection($list)
            ->additional($model::$sidebarAdditionalData ?? []);
    }

    public function getInterface(Request $request, String $modelName = '') {
        // TODO
    }

    public function getData(Request $request, String $modelName = '', Int $recordId = 0) {
        $model = $this->getModel($modelName);
        $resource = $this->getResource($modelName);

        if (!class_exists($model) || !class_exists($resource)) {
            return null;
        }

        $data = $model::query()->find($recordId)->first();

        return $resource::collection($data);
    }

    public function save(Request $request, String $modelName = '', Int $recordId = 0) {
        // TODO: create/update
    }

    private function getModel($name): string
    {
        return 'App\\Models\\' . ucfirst($name);
    }

    private function getResource($name): string
    {
        return 'App\\Http\\Resources\\' . ucfirst($name);
    }
}
