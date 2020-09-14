<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AssetLocation;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAssetLocationRequest;
use App\Http\Requests\UpdateAssetLocationRequest;
use App\Http\Resources\Admin\AssetLocationResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetLocationApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('asset_location_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetLocationResource(AssetLocation::all());
    }

    public function store(StoreAssetLocationRequest $request)
    {
        $assetLocation = AssetLocation::create($request->all());

        if ($request->input('photo', false)) {
            $assetLocation->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new AssetLocationResource($assetLocation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AssetLocation $assetLocation)
    {
        abort_if(Gate::denies('asset_location_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetLocationResource($assetLocation);
    }

    public function update(UpdateAssetLocationRequest $request, AssetLocation $assetLocation)
    {
        $assetLocation->update($request->all());

        if ($request->input('photo', false)) {
            if (!$assetLocation->photo || $request->input('photo') !== $assetLocation->photo->file_name) {
                $assetLocation->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($assetLocation->photo) {
            $assetLocation->photo->delete();
        }

        return (new AssetLocationResource($assetLocation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AssetLocation $assetLocation)
    {
        abort_if(Gate::denies('asset_location_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetLocation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
