<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Asset Categories
    Route::post('asset-categories/media', 'AssetCategoryApiController@storeMedia')->name('asset-categories.storeMedia');
    Route::apiResource('asset-categories', 'AssetCategoryApiController');

    // Asset Locations
    Route::post('asset-locations/media', 'AssetLocationApiController@storeMedia')->name('asset-locations.storeMedia');
    Route::apiResource('asset-locations', 'AssetLocationApiController');

    // Asset Statuses
    Route::apiResource('asset-statuses', 'AssetStatusApiController');

    // Assets
    Route::post('assets/media', 'AssetApiController@storeMedia')->name('assets.storeMedia');
    Route::apiResource('assets', 'AssetApiController');

    // Equipment
    Route::post('equipment/media', 'EquipmentApiController@storeMedia')->name('equipment.storeMedia');
    Route::apiResource('equipment', 'EquipmentApiController');

    // Maintenances
    Route::post('maintenances/media', 'MaintenanceApiController@storeMedia')->name('maintenances.storeMedia');
    Route::apiResource('maintenances', 'MaintenanceApiController');

    // Purchase Orders
    Route::apiResource('purchase-orders', 'PurchaseOrderApiController');

    // Production Schedules
    Route::post('production-schedules/media', 'ProductionScheduleApiController@storeMedia')->name('production-schedules.storeMedia');
    Route::apiResource('production-schedules', 'ProductionScheduleApiController');

    // Teams Menus
    Route::apiResource('teams-menus', 'TeamsMenuApiController');

    // Task Statuses
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tags
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Tasks
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Tasks Calendars
    Route::apiResource('tasks-calendars', 'TasksCalendarApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Expense Categories
    Route::apiResource('expense-categories', 'ExpenseCategoryApiController');

    // Income Categories
    Route::apiResource('income-categories', 'IncomeCategoryApiController');

    // Expenses
    Route::apiResource('expenses', 'ExpenseApiController');

    // Incomes
    Route::apiResource('incomes', 'IncomeApiController');

    // Expense Reports
    Route::apiResource('expense-reports', 'ExpenseReportApiController');
});
