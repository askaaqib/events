@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.events.header'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@if (session('data.success'))
    <div class="alert alert-success">
        {{ session('data.message') }}
    </div>
@endif

@section('content')

@if (session('data.success'))
    <div class="alert alert-success">
        {{ session('data.message') }}
    </div>
@endif
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.events.header') }} 
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
               <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('admin.events.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create New"><i class="fas fa-plus-circle"></i></a>
                </div><!--btn-toolbar-->
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('labels.backend.events.name') }}</th>
                            <th>{{ __('labels.backend.events.venue_name') }}</th>
                            <th>{{ __('labels.backend.events.start_date') }}</th>
                            <th>{{ __('labels.backend.events.active') }}</th>
                            <th>{{ __('labels.general.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->event_name }}</td>
                                <td>{{ $event->venues->venue_name }}</td>
                                <td>{{ $event->start_date }}</td>
                                <td>{!! $event->active !!}</td>
                                <td>
                                <div class="btn-group" role="group" aria-label="User Actions">
                                    <a href="{{url('admin/events/edit', $event->id)}}" data-toggle="tooltip" data-placement="top" title="" class="btn btn-info" data-original-title="edit"><i class="far fa-edit"></i> </a>
                                    <a href="{{url('admin/events/destroy', $event->id)}}" onclick="return confirm('Are you sure you want to delete?');" data-toggle="tooltip" data-placement="top" title="" class="btn btn-danger" data-original-title="delete"><i class="far fa-trash-alt"></i> </a>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $events->total() !!} {{ trans_choice('labels.backend.events.counts', $events->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $events->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
