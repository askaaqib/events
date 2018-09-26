@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.bookings.header'))

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
                    {{ __('labels.backend.bookings.header') }} 
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
               <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('admin.bookings.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create New"><i class="fas fa-plus-circle"></i></a>
                </div><!--btn-toolbar-->
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            {{-- <th>{{ __('labels.backend.bookings.customer_name') }}</th> --}}
                            <th>{{ __('labels.backend.bookings.venue_name') }}</th>
                            <th>{{ __('labels.backend.bookings.event_name') }}</th>
                            <th>{{ __('labels.backend.bookings.book_date') }}</th>
                            <th>{{ __('labels.backend.bookings.studens_count') }}</th>
                            <th>{{ __('labels.backend.bookings.gender') }}</th>
                            <th>{{ __('labels.backend.bookings.special_needs') }}</th>
                            <th>{{ __('labels.backend.bookings.need_food_meal') }}</th>
                            <th>{{ __('labels.backend.bookings.students_grade') }}</th>
                            <th>{{ __('labels.backend.bookings.file_upload') }}</th>
                            <th>{{ __('labels.backend.bookings.status') }}</th>
                            <th>{{ __('labels.general.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($bookings as $booking)
                        <?php //dd($booking->venues); ?>
                        <?php //dd($booking->users); ?>
                            <tr>
                                {{-- <td>{!! $booking->users->name !!}</td> --}}
                                <td>{!! $booking->venues->venue_name !!}</td>
                                <td>{!! $booking->events->event_name !!}</td>
                                <td>{!! $booking->book_date !!}</td>
                                <td>{!! $booking->students_count !!}</td>
                                <td>{!! $booking->gender !!}</td>
                                <td>{!! $booking->special_needs !!}</td>
                                <td>{!! $booking->need_food_meal !!}</td>
                                <td>{!! $booking->students_grade !!}</td>
                                <td><a href="/uploads/{!! $booking->file_uploads !!}">{!! $booking->file_uploads !!}</a></td>
                                <td>
                                    <?php if($booking->status == 1){ echo 'Approved';} else {?>
                                    <a href="{{url('admin/bookings/updatestatus', $booking->id)}}" onclick="return confirm('Are you sure you want to Approve Status?');" data-placement="top" title="" class="btn btn-info" data-original-title="edit">Approve</a>
                                    <?php }?>
                                </td>
                                <td>
                                <div class="btn-group" role="group" aria-label="User Actions">
                                    <a href="{{url('admin/bookings/edit', $booking->id)}}" data-toggle="tooltip" data-placement="top" title="" class="btn btn-info" data-original-title="edit"><i class="far fa-edit"></i> </a>
                                    <a href="{{url('admin/bookings/destroy', $booking->id)}}"  onclick="return confirm('Are you sure you want to delete?');" data-toggle="tooltip" data-placement="top" title="" class="btn btn-danger" data-original-title="delete"><i class="far fa-trash-alt"></i> </a>
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
                    {!! $bookings->total() !!} {{ trans_choice('labels.backend.bookings.counts', $bookings->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $bookings->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
