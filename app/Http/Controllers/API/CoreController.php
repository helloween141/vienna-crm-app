<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoreController extends Controller
{
    /**
     * @param Request $request
     * @param String $modelName
     * @return array|mixed
     */
    public function getSidebar(Request $request, string $modelName = ''): mixed
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
            ->additional($model::getSidebarAdditionalData() ?? []);
    }

    public function getInterface(Request $request, string $modelName = ''): ?array
    {
        $model = $this->getModel($modelName);

        if (!class_exists($model)) {
            return null;
        }

        return [
            'fields' => $model::getFields(),
            'single_title' => $model::$singleTitle ?? '',
            'accusative_title' => $model::$accusativeTitle ?? '',
            'sidebar_title' => $model::$sidebarTitle ?? ''
        ];
    }

    public function getData(Request $request, string $modelName = '', int $recordId = 0)
    {
        $model = $this->getModel($modelName);
        $resource = $this->getResource($modelName . 'Resource');

        if (!class_exists($model) || !class_exists($resource)) {
            return null;
        }

        $data = $model::query()
            ->where('id', $recordId)
            ->get();

        return $resource::collection($data);
    }

    public function onSave(Request $request, string $modelName = ''): ?array
    {
        $model = $this->getModel($modelName);

        if (!class_exists($model)) {
            return null;
        }

        $saveResult = false;
        $requestedData = $request->all(); // TODO: validated()

        if (isset($requestedData['id'])) {
            $record = $model::query()->findOrFail($requestedData['id']);
            if ($record) {
                $saveResult = $record->update($requestedData);
            }
        } else {
            $user = Auth::user();
            $saveResult = $model::create(
                array_merge($request->all(), ['user_id' => $user->id])
            );
        }

        return [
            'success' => $saveResult
        ];
    }

    // TODO: return type ?array. Fix after debounce
    public function getSearchResult(Request $request, string $modelName = ''): mixed
    {
        $model = $this->getModel($modelName);
        $resource = $this->getResource($modelName . 'Resource');

        if (!class_exists($model) || !class_exists($resource)) {
            return null;
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

    private function getModel($name): string
    {
        return 'App\\Models\\' . ucfirst($name);
    }

    private function getResource($name): string
    {
        return 'App\\Http\\Resources\\' . ucfirst($name);
    }
}
