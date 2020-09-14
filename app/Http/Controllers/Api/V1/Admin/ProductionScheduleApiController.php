<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductionScheduleRequest;
use App\Http\Requests\UpdateProductionScheduleRequest;
use App\Http\Resources\Admin\ProductionScheduleResource;
use App\ProductionSchedule;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductionScheduleApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('production_schedule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductionScheduleResource(ProductionSchedule::all());
    }

    public function store(StoreProductionScheduleRequest $request)
    {
        $productionSchedule = ProductionSchedule::create($request->all());

        if ($request->input('attachment', false)) {
            $productionSchedule->addMedia(storage_path('tmp/uploads/' . $request->input('attachment')))->toMediaCollection('attachment');
        }

        if ($request->input('add_file', false)) {
            $productionSchedule->addMedia(storage_path('tmp/uploads/' . $request->input('add_file')))->toMediaCollection('add_file');
        }

        return (new ProductionScheduleResource($productionSchedule))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductionSchedule $productionSchedule)
    {
        abort_if(Gate::denies('production_schedule_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductionScheduleResource($productionSchedule);
    }

    public function update(UpdateProductionScheduleRequest $request, ProductionSchedule $productionSchedule)
    {
        $productionSchedule->update($request->all());

        if ($request->input('attachment', false)) {
            if (!$productionSchedule->attachment || $request->input('attachment') !== $productionSchedule->attachment->file_name) {
                $productionSchedule->addMedia(storage_path('tmp/uploads/' . $request->input('attachment')))->toMediaCollection('attachment');
            }
        } elseif ($productionSchedule->attachment) {
            $productionSchedule->attachment->delete();
        }

        if ($request->input('add_file', false)) {
            if (!$productionSchedule->add_file || $request->input('add_file') !== $productionSchedule->add_file->file_name) {
                $productionSchedule->addMedia(storage_path('tmp/uploads/' . $request->input('add_file')))->toMediaCollection('add_file');
            }
        } elseif ($productionSchedule->add_file) {
            $productionSchedule->add_file->delete();
        }

        return (new ProductionScheduleResource($productionSchedule))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductionSchedule $productionSchedule)
    {
        abort_if(Gate::denies('production_schedule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productionSchedule->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
