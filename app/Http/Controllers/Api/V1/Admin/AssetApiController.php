<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Asset;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Http\Resources\Admin\AssetResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('asset_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetResource(Asset::with(['location'])->get());
    }

    public function store(StoreAssetRequest $request)
    {
        $asset = Asset::create($request->all());

        if ($request->input('manuals', false)) {
            $asset->addMedia(storage_path('tmp/uploads/' . $request->input('manuals')))->toMediaCollection('manuals');
        }

        if ($request->input('photos', false)) {
            $asset->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
        }

        return (new AssetResource($asset))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Asset $asset)
    {
        abort_if(Gate::denies('asset_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetResource($asset->load(['location']));
    }

    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $asset->update($request->all());

        if ($request->input('manuals', false)) {
            if (!$asset->manuals || $request->input('manuals') !== $asset->manuals->file_name) {
                $asset->addMedia(storage_path('tmp/uploads/' . $request->input('manuals')))->toMediaCollection('manuals');
            }
        } elseif ($asset->manuals) {
            $asset->manuals->delete();
        }

        if ($request->input('photos', false)) {
            if (!$asset->photos || $request->input('photos') !== $asset->photos->file_name) {
                $asset->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
            }
        } elseif ($asset->photos) {
            $asset->photos->delete();
        }

        return (new AssetResource($asset))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Asset $asset)
    {
        abort_if(Gate::denies('asset_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asset->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
