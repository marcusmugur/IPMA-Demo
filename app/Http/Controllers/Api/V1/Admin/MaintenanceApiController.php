<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMaintenanceRequest;
use App\Http\Requests\UpdateMaintenanceRequest;
use App\Http\Resources\Admin\MaintenanceResource;
use App\Maintenance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('maintenance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaintenanceResource(Maintenance::all());
    }

    public function store(StoreMaintenanceRequest $request)
    {
        $maintenance = Maintenance::create($request->all());

        if ($request->input('file_attachment', false)) {
            $maintenance->addMedia(storage_path('tmp/uploads/' . $request->input('file_attachment')))->toMediaCollection('file_attachment');
        }

        if ($request->input('attachment', false)) {
            $maintenance->addMedia(storage_path('tmp/uploads/' . $request->input('attachment')))->toMediaCollection('attachment');
        }

        return (new MaintenanceResource($maintenance))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Maintenance $maintenance)
    {
        abort_if(Gate::denies('maintenance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaintenanceResource($maintenance);
    }

    public function update(UpdateMaintenanceRequest $request, Maintenance $maintenance)
    {
        $maintenance->update($request->all());

        if ($request->input('file_attachment', false)) {
            if (!$maintenance->file_attachment || $request->input('file_attachment') !== $maintenance->file_attachment->file_name) {
                $maintenance->addMedia(storage_path('tmp/uploads/' . $request->input('file_attachment')))->toMediaCollection('file_attachment');
            }
        } elseif ($maintenance->file_attachment) {
            $maintenance->file_attachment->delete();
        }

        if ($request->input('attachment', false)) {
            if (!$maintenance->attachment || $request->input('attachment') !== $maintenance->attachment->file_name) {
                $maintenance->addMedia(storage_path('tmp/uploads/' . $request->input('attachment')))->toMediaCollection('attachment');
            }
        } elseif ($maintenance->attachment) {
            $maintenance->attachment->delete();
        }

        return (new MaintenanceResource($maintenance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Maintenance $maintenance)
    {
        abort_if(Gate::denies('maintenance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenance->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
