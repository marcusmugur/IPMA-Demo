<?php

namespace App\Http\Controllers\Admin;

use App\Equipment;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEquipmentRequest;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EquipmentController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('equipment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipment = Equipment::all();

        return view('admin.equipment.index', compact('equipment'));
    }

    public function create()
    {
        abort_if(Gate::denies('equipment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.equipment.create');
    }

    public function store(StoreEquipmentRequest $request)
    {
        $equipment = Equipment::create($request->all());

        foreach ($request->input('attachment', []) as $file) {
            $equipment->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('attachment');
        }

        foreach ($request->input('photo', []) as $file) {
            $equipment->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photo');
        }

        return redirect()->route('admin.equipment.index');
    }

    public function edit(Equipment $equipment)
    {
        abort_if(Gate::denies('equipment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.equipment.edit', compact('equipment'));
    }

    public function update(UpdateEquipmentRequest $request, Equipment $equipment)
    {
        $equipment->update($request->all());

        if (count($equipment->attachment) > 0) {
            foreach ($equipment->attachment as $media) {
                if (!in_array($media->file_name, $request->input('attachment', []))) {
                    $media->delete();
                }
            }
        }

        $media = $equipment->attachment->pluck('file_name')->toArray();

        foreach ($request->input('attachment', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $equipment->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('attachment');
            }
        }

        if (count($equipment->photo) > 0) {
            foreach ($equipment->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $equipment->photo->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $equipment->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photo');
            }
        }

        return redirect()->route('admin.equipment.index');
    }

    public function show(Equipment $equipment)
    {
        abort_if(Gate::denies('equipment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.equipment.show', compact('equipment'));
    }

    public function destroy(Equipment $equipment)
    {
        abort_if(Gate::denies('equipment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipment->delete();

        return back();
    }

    public function massDestroy(MassDestroyEquipmentRequest $request)
    {
        Equipment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
