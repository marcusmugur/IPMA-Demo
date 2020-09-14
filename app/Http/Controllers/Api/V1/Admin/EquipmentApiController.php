<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Equipment;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Http\Resources\Admin\EquipmentResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EquipmentApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('equipment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EquipmentResource(Equipment::all());
    }

    public function store(StoreEquipmentRequest $request)
    {
        $equipment = Equipment::create($request->all());

        if ($request->input('attachment', false)) {
            $equipment->addMedia(storage_path('tmp/uploads/' . $request->input('attachment')))->toMediaCollection('attachment');
        }

        if ($request->input('photo', false)) {
            $equipment->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new EquipmentResource($equipment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Equipment $equipment)
    {
        abort_if(Gate::denies('equipment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EquipmentResource($equipment);
    }

    public function update(UpdateEquipmentRequest $request, Equipment $equipment)
    {
        $equipment->update($request->all());

        if ($request->input('attachment', false)) {
            if (!$equipment->attachment || $request->input('attachment') !== $equipment->attachment->file_name) {
                $equipment->addMedia(storage_path('tmp/uploads/' . $request->input('attachment')))->toMediaCollection('attachment');
            }
        } elseif ($equipment->attachment) {
            $equipment->attachment->delete();
        }

        if ($request->input('photo', false)) {
            if (!$equipment->photo || $request->input('photo') !== $equipment->photo->file_name) {
                $equipment->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($equipment->photo) {
            $equipment->photo->delete();
        }

        return (new EquipmentResource($equipment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Equipment $equipment)
    {
        abort_if(Gate::denies('equipment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
