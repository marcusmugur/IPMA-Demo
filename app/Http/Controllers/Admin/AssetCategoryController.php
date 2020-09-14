<?php

namespace App\Http\Controllers\Admin;

use App\AssetCategory;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAssetCategoryRequest;
use App\Http\Requests\StoreAssetCategoryRequest;
use App\Http\Requests\UpdateAssetCategoryRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetCategoryController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('asset_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetCategories = AssetCategory::all();

        return view('admin.assetCategories.index', compact('assetCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('asset_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.assetCategories.create');
    }

    public function store(StoreAssetCategoryRequest $request)
    {
        $assetCategory = AssetCategory::create($request->all());

        if ($request->input('photo', false)) {
            $assetCategory->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return redirect()->route('admin.asset-categories.index');
    }

    public function edit(AssetCategory $assetCategory)
    {
        abort_if(Gate::denies('asset_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.assetCategories.edit', compact('assetCategory'));
    }

    public function update(UpdateAssetCategoryRequest $request, AssetCategory $assetCategory)
    {
        $assetCategory->update($request->all());

        if ($request->input('photo', false)) {
            if (!$assetCategory->photo || $request->input('photo') !== $assetCategory->photo->file_name) {
                $assetCategory->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($assetCategory->photo) {
            $assetCategory->photo->delete();
        }

        return redirect()->route('admin.asset-categories.index');
    }

    public function show(AssetCategory $assetCategory)
    {
        abort_if(Gate::denies('asset_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.assetCategories.show', compact('assetCategory'));
    }

    public function destroy(AssetCategory $assetCategory)
    {
        abort_if(Gate::denies('asset_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssetCategoryRequest $request)
    {
        AssetCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
