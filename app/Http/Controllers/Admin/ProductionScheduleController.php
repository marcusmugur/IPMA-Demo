<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductionScheduleRequest;
use App\Http\Requests\StoreProductionScheduleRequest;
use App\Http\Requests\UpdateProductionScheduleRequest;
use App\ProductionSchedule;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductionScheduleController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('production_schedule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productionSchedules = ProductionSchedule::all();

        return view('admin.productionSchedules.index', compact('productionSchedules'));
    }

    public function create()
    {
        abort_if(Gate::denies('production_schedule_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productionSchedules.create');
    }

    public function store(StoreProductionScheduleRequest $request)
    {
        $productionSchedule = ProductionSchedule::create($request->all());

        foreach ($request->input('attachment', []) as $file) {
            $productionSchedule->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('attachment');
        }

        if ($request->input('add_file', false)) {
            $productionSchedule->addMedia(storage_path('tmp/uploads/' . $request->input('add_file')))->toMediaCollection('add_file');
        }

        return redirect()->route('admin.systemCalendar');
    }

    public function edit(ProductionSchedule $productionSchedule)
    {
        abort_if(Gate::denies('production_schedule_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productionSchedules.edit', compact('productionSchedule'));
    }

    public function update(UpdateProductionScheduleRequest $request, ProductionSchedule $productionSchedule)
    {
        $productionSchedule->update($request->all());

        if (count($productionSchedule->attachment) > 0) {
            foreach ($productionSchedule->attachment as $media) {
                if (!in_array($media->file_name, $request->input('attachment', []))) {
                    $media->delete();
                }
            }
        }

        $media = $productionSchedule->attachment->pluck('file_name')->toArray();

        foreach ($request->input('attachment', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $productionSchedule->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('attachment');
            }
        }

        if ($request->input('add_file', false)) {
            if (!$productionSchedule->add_file || $request->input('add_file') !== $productionSchedule->add_file->file_name) {
                $productionSchedule->addMedia(storage_path('tmp/uploads/' . $request->input('add_file')))->toMediaCollection('add_file');
            }
        } elseif ($productionSchedule->add_file) {
            $productionSchedule->add_file->delete();
        }

        return redirect()->route('admin.systemCalendar');
    }

    public function show(ProductionSchedule $productionSchedule)
    {
        abort_if(Gate::denies('production_schedule_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productionSchedules.show', compact('productionSchedule'));
    }

    public function destroy(ProductionSchedule $productionSchedule)
    {
        abort_if(Gate::denies('production_schedule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productionSchedule->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductionScheduleRequest $request)
    {
        ProductionSchedule::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
