<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'asset_management_access',
            ],
            [
                'id'    => '18',
                'title' => 'asset_category_create',
            ],
            [
                'id'    => '19',
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => '20',
                'title' => 'asset_category_show',
            ],
            [
                'id'    => '21',
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => '22',
                'title' => 'asset_category_access',
            ],
            [
                'id'    => '23',
                'title' => 'asset_location_create',
            ],
            [
                'id'    => '24',
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => '25',
                'title' => 'asset_location_show',
            ],
            [
                'id'    => '26',
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => '27',
                'title' => 'asset_location_access',
            ],
            [
                'id'    => '28',
                'title' => 'asset_status_create',
            ],
            [
                'id'    => '29',
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => '30',
                'title' => 'asset_status_show',
            ],
            [
                'id'    => '31',
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => '32',
                'title' => 'asset_status_access',
            ],
            [
                'id'    => '33',
                'title' => 'asset_create',
            ],
            [
                'id'    => '34',
                'title' => 'asset_edit',
            ],
            [
                'id'    => '35',
                'title' => 'asset_show',
            ],
            [
                'id'    => '36',
                'title' => 'asset_delete',
            ],
            [
                'id'    => '37',
                'title' => 'asset_access',
            ],
            [
                'id'    => '38',
                'title' => 'assets_history_access',
            ],
            [
                'id'    => '39',
                'title' => 'equipment_create',
            ],
            [
                'id'    => '40',
                'title' => 'equipment_edit',
            ],
            [
                'id'    => '41',
                'title' => 'equipment_show',
            ],
            [
                'id'    => '42',
                'title' => 'equipment_delete',
            ],
            [
                'id'    => '43',
                'title' => 'equipment_access',
            ],
            [
                'id'    => '44',
                'title' => 'reporting_access',
            ],
            [
                'id'    => '45',
                'title' => 'maintenance_create',
            ],
            [
                'id'    => '46',
                'title' => 'maintenance_edit',
            ],
            [
                'id'    => '47',
                'title' => 'maintenance_show',
            ],
            [
                'id'    => '48',
                'title' => 'maintenance_delete',
            ],
            [
                'id'    => '49',
                'title' => 'maintenance_access',
            ],
            [
                'id'    => '50',
                'title' => 'purchase_order_create',
            ],
            [
                'id'    => '51',
                'title' => 'purchase_order_edit',
            ],
            [
                'id'    => '52',
                'title' => 'purchase_order_show',
            ],
            [
                'id'    => '53',
                'title' => 'purchase_order_delete',
            ],
            [
                'id'    => '54',
                'title' => 'purchase_order_access',
            ],
            [
                'id'    => '55',
                'title' => 'production_schedule_create',
            ],
            [
                'id'    => '56',
                'title' => 'production_schedule_edit',
            ],
            [
                'id'    => '57',
                'title' => 'production_schedule_show',
            ],
            [
                'id'    => '58',
                'title' => 'production_schedule_delete',
            ],
            [
                'id'    => '59',
                'title' => 'production_schedule_access',
            ],
            [
                'id'    => '60',
                'title' => 'chat_access',
            ],
            [
                'id'    => '61',
                'title' => 'teams_menu_create',
            ],
            [
                'id'    => '62',
                'title' => 'teams_menu_edit',
            ],
            [
                'id'    => '63',
                'title' => 'teams_menu_show',
            ],
            [
                'id'    => '64',
                'title' => 'teams_menu_delete',
            ],
            [
                'id'    => '65',
                'title' => 'teams_menu_access',
            ],
            [
                'id'    => '66',
                'title' => 'task_management_access',
            ],
            [
                'id'    => '67',
                'title' => 'task_status_create',
            ],
            [
                'id'    => '68',
                'title' => 'task_status_edit',
            ],
            [
                'id'    => '69',
                'title' => 'task_status_show',
            ],
            [
                'id'    => '70',
                'title' => 'task_status_delete',
            ],
            [
                'id'    => '71',
                'title' => 'task_status_access',
            ],
            [
                'id'    => '72',
                'title' => 'task_tag_create',
            ],
            [
                'id'    => '73',
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => '74',
                'title' => 'task_tag_show',
            ],
            [
                'id'    => '75',
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => '76',
                'title' => 'task_tag_access',
            ],
            [
                'id'    => '77',
                'title' => 'task_create',
            ],
            [
                'id'    => '78',
                'title' => 'task_edit',
            ],
            [
                'id'    => '79',
                'title' => 'task_show',
            ],
            [
                'id'    => '80',
                'title' => 'task_delete',
            ],
            [
                'id'    => '81',
                'title' => 'task_access',
            ],
            [
                'id'    => '82',
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => '83',
                'title' => 'expense_management_access',
            ],
            [
                'id'    => '84',
                'title' => 'expense_category_create',
            ],
            [
                'id'    => '85',
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => '86',
                'title' => 'expense_category_show',
            ],
            [
                'id'    => '87',
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => '88',
                'title' => 'expense_category_access',
            ],
            [
                'id'    => '89',
                'title' => 'income_category_create',
            ],
            [
                'id'    => '90',
                'title' => 'income_category_edit',
            ],
            [
                'id'    => '91',
                'title' => 'income_category_show',
            ],
            [
                'id'    => '92',
                'title' => 'income_category_delete',
            ],
            [
                'id'    => '93',
                'title' => 'income_category_access',
            ],
            [
                'id'    => '94',
                'title' => 'expense_create',
            ],
            [
                'id'    => '95',
                'title' => 'expense_edit',
            ],
            [
                'id'    => '96',
                'title' => 'expense_show',
            ],
            [
                'id'    => '97',
                'title' => 'expense_delete',
            ],
            [
                'id'    => '98',
                'title' => 'expense_access',
            ],
            [
                'id'    => '99',
                'title' => 'income_create',
            ],
            [
                'id'    => '100',
                'title' => 'income_edit',
            ],
            [
                'id'    => '101',
                'title' => 'income_show',
            ],
            [
                'id'    => '102',
                'title' => 'income_delete',
            ],
            [
                'id'    => '103',
                'title' => 'income_access',
            ],
            [
                'id'    => '104',
                'title' => 'expense_report_create',
            ],
            [
                'id'    => '105',
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => '106',
                'title' => 'expense_report_show',
            ],
            [
                'id'    => '107',
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => '108',
                'title' => 'expense_report_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
