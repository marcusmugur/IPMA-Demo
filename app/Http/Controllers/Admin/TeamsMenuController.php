<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTeamsMenuRequest;
use App\Http\Requests\StoreTeamsMenuRequest;
use App\Http\Requests\UpdateTeamsMenuRequest;
use App\TeamsMenu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamsMenuController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('teams_menu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teamsMenus = TeamsMenu::all();

        return view('admin.teamsMenus.index', compact('teamsMenus'));
    }

    public function create()
    {
        abort_if(Gate::denies('teams_menu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.teamsMenus.create');
    }

    public function store(StoreTeamsMenuRequest $request)
    {
        $teamsMenu = TeamsMenu::create($request->all());

        return redirect()->route('admin.teams-menus.index');
    }

    public function edit(TeamsMenu $teamsMenu)
    {
        abort_if(Gate::denies('teams_menu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.teamsMenus.edit', compact('teamsMenu'));
    }

    public function update(UpdateTeamsMenuRequest $request, TeamsMenu $teamsMenu)
    {
        $teamsMenu->update($request->all());

        return redirect()->route('admin.teams-menus.index');
    }

    public function show(TeamsMenu $teamsMenu)
    {
        abort_if(Gate::denies('teams_menu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.teamsMenus.show', compact('teamsMenu'));
    }

    public function destroy(TeamsMenu $teamsMenu)
    {
        abort_if(Gate::denies('teams_menu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teamsMenu->delete();

        return back();
    }

    public function massDestroy(MassDestroyTeamsMenuRequest $request)
    {
        TeamsMenu::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
