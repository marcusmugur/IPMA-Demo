<aside class="main-sidebar" style="position: fixed">    
    <section class="sidebar">
        <ul class="sidebar-menu">                
          <li class="user-menu open">            
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ Auth::user()->photo->getUrl('thumb') }}" class="img" alt="User Image">  
                                              
                    </div>
                    <div class="pull-left info">
                        <p>{{ Auth::user()->name }}</p>
                        <p style="font-size: 11px; font-style: italic"> Administrator </p>   
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <i class="fas fa-fw fa-sign-out-alt"></i>
                            <span>{{ trans('global.logout') }}</span>
                        </a>                     
                    </div>                                       
                </div>            
          </li>          
        </ul>  
    </section>
    <section class="sidebar">   
        <ul class="sidebar-menu tree" data-widget="tree">                        
            <li>
                <a href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    <span>{{ trans('global.dashboard') }}</span>
                </a>
            </li>
            @can('reporting_access')
                <li class="{{ request()->is('admin/reportings') || request()->is('admin/reportings/*') ? 'active' : '' }}">
                    <a href="{{ route("admin.reportings.index") }}">
                        <i class="fa-fw fas fa-flag-checkered">

                        </i>
                        <span>{{ trans('cruds.reporting.title') }}</span>
                    </a>
                </li>
            @endcan
            <li class="{{ request()->is('admin/system-calendar') || request()->is('admin/system-calendar/*') ? 'active' : '' }}">
                <a href="{{ route("admin.systemCalendar") }}">
                    <i class="fas fa-fw fa-calendar">

                    </i>
                    <span>{{ trans('global.systemCalendar') }}</span>
                </a>
            </li>
            @can('maintenance_access')
                <li class="{{ request()->is('admin/maintenances') || request()->is('admin/maintenances/*') ? 'active' : '' }}">
                    <a href="{{ route("admin.maintenances.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.maintenance.title') }}</span>
                    </a>
                </li>
            @endcan
            @can('purchase_order_access')
                <li class="{{ request()->is('admin/purchase-orders') || request()->is('admin/purchase-orders/*') ? 'active' : '' }}">
                    <a href="{{ route("admin.purchase-orders.index") }}">
                        <i class="fa-fw far fa-paper-plane">

                        </i>
                        <span>{{ trans('cruds.purchaseOrder.title') }}</span>
                    </a>
                </li>
            @endcan
            @can('production_schedule_access')
                <li class="{{ request()->is('admin/production-schedules') || request()->is('admin/production-schedules/*') ? 'active' : '' }}">
                    <a href="{{ route("admin.production-schedules.index") }}">
                        <i class="fa-fw far fa-address-book">

                        </i>
                        <span>{{ trans('cruds.productionSchedule.title') }}</span>
                    </a>
                </li>
            @endcan                                   
            @can('expense_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-money-bill">
                            
                        </i>                        
                            <span>{{ trans('cruds.expenseManagement.title') }}</span>                            
                            <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>                        
                    </a>
                    <ul class="treeview-menu">
                        @can('expense_category_access')
                            <li class="{{ request()->is('admin/expense-categories') || request()->is('admin/expense-categories/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.expense-categories.index") }}">
                                    <i class="fa-fw fas fa-list">

                                    </i>
                                    <span>{{ trans('cruds.expenseCategory.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('income_category_access')
                            <li class="{{ request()->is('admin/income-categories') || request()->is('admin/income-categories/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.income-categories.index") }}">
                                    <i class="fa-fw fas fa-list">

                                    </i>
                                    <span>{{ trans('cruds.incomeCategory.title') }}</span>
                                </a>
                            </li>                            
                        @endcan
                        @can('expense_access')
                            <li class="{{ request()->is('admin/expenses') || request()->is('admin/expenses/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.expenses.index") }}">
                                    <i class="fa-fw fas fa-list">

                                    </i>
                                    <span>{{ trans('cruds.expense.title') }}</span>
                                </a>
                            </li>                            
                        @endcan
                        @can('income_access')
                            <li class="{{ request()->is('admin/incomes') || request()->is('admin/incomes/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.incomes.index") }}">
                                    <i class="fa-fw fas fa-list">

                                    </i>
                                    <span>{{ trans('cruds.income.title') }}</span>
                                </a>
                            </li>                            
                        @endcan
                        @can('expense_report_access')
                            <li class="{{ request()->is('admin/expense-reports') || request()->is('admin/expense-reports/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.expense-reports.index") }}">
                                    <i class="fa-fw fas fa-chart-line">

                                    </i>
                                    <span>{{ trans('cruds.expenseReport.title') }}</span>
                                </a>
                            </li>                            
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('asset_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-book">

                        </i>
                        <span>{{ trans('cruds.assetManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('asset_category_access')
                            <li class="{{ request()->is('admin/asset-categories') || request()->is('admin/asset-categories/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.asset-categories.index") }}">
                                    <i class="fa-fw fas fa-tags">

                                    </i>
                                    <span>{{ trans('cruds.assetCategory.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('asset_location_access')
                            <li class="{{ request()->is('admin/asset-locations') || request()->is('admin/asset-locations/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.asset-locations.index") }}">
                                    <i class="fa-fw fas fa-map-marker">

                                    </i>
                                    <span>{{ trans('cruds.assetLocation.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('asset_status_access')
                            <li class="{{ request()->is('admin/asset-statuses') || request()->is('admin/asset-statuses/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.asset-statuses.index") }}">
                                    <i class="fa-fw fas fa-server">

                                    </i>
                                    <span>{{ trans('cruds.assetStatus.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('asset_access')
                            <li class="{{ request()->is('admin/assets') || request()->is('admin/assets/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.assets.index") }}">
                                    <i class="fa-fw fas fa-book">

                                    </i>
                                    <span>{{ trans('cruds.asset.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('equipment_access')
                            <li class="{{ request()->is('admin/equipment') || request()->is('admin/equipment/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.equipment.index") }}">
                                    <i class="fa-fw fas fa-flag">

                                    </i>
                                    <span>{{ trans('cruds.equipment.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('assets_history_access')
                            <li class="{{ request()->is('admin/assets-histories') || request()->is('admin/assets-histories/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.assets-histories.index") }}">
                                    <i class="fa-fw fas fa-th-list">

                                    </i>
                                    <span>{{ trans('cruds.assetsHistory.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('user_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permission_access')
                            <li class="{{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.permissions.index") }}">
                                    <i class="fa-fw fas fa-unlock-alt">

                                    </i>
                                    <span>{{ trans('cruds.permission.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="{{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.roles.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.role.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="{{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.users.index") }}">
                                    <i class="fa-fw fas fa-user">

                                    </i>
                                    <span>{{ trans('cruds.user.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('chat_access')
                <li class="{{ request()->is('admin/chats') || request()->is('admin/chats/*') ? 'active' : '' }}">
                    <a href="{{ route("admin.chats.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.chat.title') }}</span>
                    </a>
                </li>
            @endcan
            @php($unread = \App\QaTopic::unreadCount())
                <li class="nav-item">
                    <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is('admin/messenger') || request()->is('admin/messenger/*') ? 'active' : '' }} nav-link">
                        <i class="fa-fw fa fa-envelope">

                        </i>
                        <span>{{ trans('global.messages') }}</span>
                        @if($unread > 0)
                            <strong>( {{ $unread }} )</strong>
                        @endif
                    </a>
                </li>           
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <i class="fas fa-fw fa-sign-out-alt">

                        </i>
                        <span>{{ trans('global.logout') }}</span>
                    </a>
                </li>
                <li>
                    <footer class="footer text-center">
                        <span><strong>{{ trans('panel.site_title') }} &copy;</strong> {{ trans('global.allRightsReserved') }}</span>                   
                    </footer>
                </li>
        </ul>
    </section>
</aside>