<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamsMenuRequest;
use App\Http\Requests\UpdateTeamsMenuRequest;
use App\Http\Resources\Admin\TeamsMenuResource;
use App\TeamsMenu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamsMenuApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('teams_menu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeamsMenuResource(TeamsMenu::all());
    }

    public function store(StoreTeamsMenuRequest $request)
    {
        $teamsMenu = TeamsMenu::create($request->all());

        return (new TeamsMenuResource($teamsMenu))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TeamsMenu $teamsMenu)
    {
        abort_if(Gate::denies('teams_menu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeamsMenuResource($teamsMenu);
    }

    public function update(UpdateTeamsMenuRequest $request, TeamsMenu $teamsMenu)
    {
        $teamsMenu->update($request->all());

        return (new TeamsMenuResource($teamsMenu))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TeamsMenu $teamsMenu)
    {
        abort_if(Gate::denies('teams_menu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teamsMenu->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
