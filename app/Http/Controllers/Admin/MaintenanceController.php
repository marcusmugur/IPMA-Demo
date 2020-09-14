<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMaintenanceRequest;
use App\Http\Requests\StoreMaintenanceRequest;
use App\Http\Requests\UpdateMaintenanceRequest;
use App\Maintenance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('maintenance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenances = Maintenance::all();

        return view('admin.maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        abort_if(Gate::denies('maintenance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.maintenances.create');
    }

    public function store(StoreMaintenanceRequest $request)
    {
        $maintenance = Maintenance::create($request->all());

        foreach ($request->input('file_attachment', []) as $file) {
            $maintenance->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('file_attachment');
        }

        foreach ($request->input('attachment', []) as $file) {
            $maintenance->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('attachment');
        }

        return redirect()->route('admin.maintenances.index');
    }

    public function edit(Maintenance $maintenance)
    {
        abort_if(Gate::denies('maintenance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.maintenances.edit', compact('maintenance'));
    }

    public function update(UpdateMaintenanceRequest $request, Maintenance $maintenance)
    {
        $maintenance->update($request->all());

        if (count($maintenance->file_attachment) > 0) {
            foreach ($maintenance->file_attachment as $media) {
                if (!in_array($media->file_name, $request->input('file_attachment', []))) {
                    $media->delete();
                }
            }
        }

        $media = $maintenance->file_attachment->pluck('file_name')->toArray();

        foreach ($request->input('file_attachment', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $maintenance->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('file_attachment');
            }
        }

        if (count($maintenance->attachment) > 0) {
            foreach ($maintenance->attachment as $media) {
                if (!in_array($media->file_name, $request->input('attachment', []))) {
                    $media->delete();
                }
            }
        }

        $media = $maintenance->attachment->pluck('file_name')->toArray();

        foreach ($request->input('attachment', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $maintenance->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('attachment');
            }
        }

        return redirect()->route('admin.maintenances.index');
    }

    public function show(Maintenance $maintenance)
    {
        abort_if(Gate::denies('maintenance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.maintenances.show', compact('maintenance'));
    }

    public function destroy(Maintenance $maintenance)
    {
        abort_if(Gate::denies('maintenance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenance->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaintenanceRequest $request)
    {
        Maintenance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
