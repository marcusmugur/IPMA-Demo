<?php

namespace App\Http\Requests;

use App\TeamsMenu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTeamsMenuRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('teams_menu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:teams_menus,id',
        ];
    }
}
