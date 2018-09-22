@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.excludeDates.header'))

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
                    {{ __('labels.backend.excludeDates.header') }} 
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
               <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('admin.excludeDates.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create New"><i class="fas fa-plus-circle"></i></a>
                </div><!--btn-toolbar-->
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('labels.backend.excludeDates.venue_name') }}</th>
                            <th>{{ __('labels.backend.excludeDates.from_date') }}</th>
                            <th>{{ __('labels.backend.excludeDates.to_date') }}</th>
                            <th>{{ __('labels.backend.excludeDates.active') }}</th>
                            <th>{{ __('labels.general.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($excludeDates as $excludeDate)
                            <tr>
                                <td>{{ $excludeDate->venues->venue_name }}</td>
                                <td>{{ $excludeDate->from_date }}</td>
                                <td>{{ $excludeDate->to_date }}</td>
                                <td>{!! $excludeDate->active !!}</td>
                                <td>
                                <div class="btn-group" role="group" aria-label="User Actions">
                                    <a href="{{route('admin.excludeDates.edit', $excludeDate->id)}}" data-toggle="tooltip" data-placement="top" title="" class="btn btn-info" data-original-title="edit"><i class="far fa-edit"></i> </a>
                                    <a href="{{route('admin.exccc.destroy', $excludeDate->id)}}"  onclick="return confirm('Are you sure you want to delete?');" data-toggle="tooltip" data-placement="top" title="" class="btn btn-danger" data-original-title="delete"><i class="far fa-trash-alt"></i> </a>
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
                    {!! $excludeDates->total() !!} {{ trans_choice('labels.backend.excludeDates.counts', $excludeDates->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $excludeDates->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
