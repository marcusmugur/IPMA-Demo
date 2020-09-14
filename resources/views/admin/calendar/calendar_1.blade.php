@extends('layouts.admin')
@section('content')
<div class="content">
    @can('maintenance_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-danger" href="{{ route("admin.maintenances.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.maintenance.title_singular') }}
                </a>
                <a class="btn btn-success" href="{{ route("admin.purchase-orders.create") }}">
                        {{ trans('global.add') }} {{ trans('cruds.purchaseOrder.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-md-8">

            <div class="panel panel-default">                
                <div class="panel-body">                    
                    <link rel='stylesheet' href='../css/fullcalendar.min.css' />
                    <div id='calendar'></div>
                </div>                
            </div>

        </div>
        <div class="col-md-4 no-float">            
            <div class="panel panel-default">               
                <div class="panel-body">
                        <link rel='stylesheet' href='../css/fullcalendar.min.css' />
                        <div id='calendar1'></div>                        
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script src='../js/moment.min.js'></script>
<script src='../js/fullcalendar.min.js'></script>
<script>
    $(document).ready(function () {
            // page is now ready, initialize the calendar...
            events={!! json_encode($events) !!};
            $('#calendar').fullCalendar({

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek'
                    // ,agendaDay,listMonth
                },
                selectable: true,
                selectHelper: true,
                editable: true,
                //eventLimit: true, // allow "more" link when too many events

                // put your options and callbacks here
                events: events,
                eventRender: function(event, element){ 
                    element.find('.fc-event-title').append("<br/>" + event.description); 
                }


            })
        });


        $(document).ready(function () {
            // page is now ready, initialize the calendar...
            events={!! json_encode($events) !!};
            $('#calendar1').fullCalendar({     
                header: {                    
                    right: 'listDay,listWeek,listMonth',
                    center: '',
                    left: '',
                }, 
                defaultView: 'listDay',              
                selectable: true,
                editable: true,
                eventLimit: true, // allow "more" link when too many events

                // put your options and callbacks here
                events: events,
                //eventRender: function(event, element){ 
                //    element.find('.fc-event-title').append("<br/>" + event.description); 
                //}
                
               

            })
        });
        // Setup the timezone
                /* var calendar = new Calendar(calendarEl, {
                timeZone: 'America/Tijuana',
                events: [
                    { start: '2019-09-01T12:30:00Z' }, // will be parsed in UTC, as-is
                    { start: '2019-09-01T12:30:00+XX:XX' }, // will be parsed in UTC as '2018-09-01T12:30:00Z'
                    { start: '2019-09-01T12:30:00' } // will be parsed in UTC as '2018-09-01T12:30:00Z'
                ],
                dateClick: function(arg) {
                    console.log(arg.date.toUTCString()); // use *UTC* methods on the native Date Object
                    // will output something like 'Sat, 01 Sep 2018 00:00:00 GMT'
                }
                }); */
</script>

@stop