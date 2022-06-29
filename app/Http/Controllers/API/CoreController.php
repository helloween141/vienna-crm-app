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
    public function getSidebar(Request $request, string $modelName = ''): mixed
    {
        $model = $this->getModelClass($modelName);
        $resource = $this->getResourceClass($modelName . 'SidebarResource');

        if (!class_exists($model) || !class_exists($resource)) {
            return [
                'success' => 'false'
            ];
        }

        // TODO: apply filters

        $list = $model::query()
            ->orderBy('id', 'DESC')
            ->paginate();

        return $resource::collection($list)
            ->additional($model::getSidebarAdditionalData() ?? []);
    }

    public function getInterface(Request $request, string $modelName = ''): ?array
    {
        $model = $this->getModelClass($modelName);

        if (!class_exists($model)) {
            return [
                'success' => 'false'
            ];
        }

        return [
            'fields' => $model::getFields(),
            'detail_title' => $model::$detailTitle ?? '',
            'accusative_detail_title' => $model::$accusativeDetailTitle ?? ''
        ];
    }

    public function getData(Request $request, string $modelName = '', int $recordId = 0)
    {
        $model = $this->getModelClass($modelName);
        $resource = $this->getResourceClass($modelName . 'Resource');

        if (!class_exists($model) || !class_exists($resource)) {
            return [
                'success' => 'false'
            ];
        }

        $data = $model::query()
            ->where('id', $recordId)
            ->get();

        return $resource::collection($data);
    }

    public function saveData(Request $request, string $modelName = ''): ?array
    {
        $Model = $this->getModelClass($modelName);

        if (!class_exists($Model)) {
            return [
                'success' => 'false'
            ];
        }

        $requiredFields = $this->getRequiredFields($Model::getFields());
        $validatedData = $request->validate($requiredFields);

        $saveResult = $Model::query()->updateOrCreate(
            ['id' => $validatedData['id'] ?? 0],
            $validatedData
        );

        return [
            'success' => $saveResult
        ];
    }

    // TODO: return type ?array. Fix after debounce
    public function getSearchResult(Request $request, string $modelName = ''): mixed
    {
        $model = $this->getModelClass($modelName);
        $resource = $this->getResourceClass($modelName . 'Resource');

        if (!class_exists($model) || !class_exists($resource)) {
            return [
                'success' => 'false'
            ];
        }

        $searchString = trim($request->get('search_string', ''));
        if ($searchString) {
            $resultSearch = $model::query()
                ->where('name', 'LIKE', "%{$searchString}%")
                ->get();

            return $resource::collection($resultSearch);
        }

        return [];
    }

    private function getRequiredFields($fields): array
    {
        $result = [];
        foreach ($fields as $field) {
            if (isset($field['required'])) {
                $result = [...$result, $field['name'] => 'required'];
            }
        }
        return $result;
    }

    private function getModelClass($name): string
    {
        return 'App\\Models\\' . ucfirst($name);
    }

    private function getResourceClass($name): string
    {
        return 'App\\Http\\Resources\\' . ucfirst($name);
    }
}
