@extends ('backend.layouts.app')

@section ('title', __('labels.backend.venues.header') . ' | ' . __('labels.backend.venues.create'))


@section('content')
@if (session('data.success'))
    <div class="alert alert-success">
        {{ session('data.message') }}
    </div>
@endif
{{ html()->modelForm($venues, 'PATCH', route('admin.venues.update', $venues->id))->class('form-horizontal')->open() }}
        <input type="hidden" name="id" value="{{$venues->id}}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            {{ __('labels.backend.venues.header') }}
                            <small class="text-muted">{{ __('labels.backend.venues.create') }}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr />

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.venues.venue_name'))->class('col-md-2 form-control-label')->for('venue_name') }}

                            <div class="col-md-10">
                                {{ html()->text('venue_name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.venues.venue_name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.venues.capacity'))->class('col-md-2 form-control-label')->for('capacity') }}

                            <div class="col-md-10">
                                {{ html()->text('capacity')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.venues.capacity'))
                                    ->attribute('maxlength', 191)
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.venues.days_of_work'))->class('col-md-2 form-control-label')->for('days_of_work') }}
                            @php 
                                $const = ['saturday', 'sunday', 'monday', 'tuesday', 'wednessday', 'thursday', 'friday'];
                                $days_work = unserialize(base64_decode($venues->days_of_work));
                                $res = $venues->array_sub_sort($days_work, $const);
                                 // dd($res);
                                $i=0;
                            @endphp 
                            @foreach($res as $key => $work_days)           
                            <div class="col-md-1">
                                {{$key}}
                                @if($key == 'friday')                                    
                                @endif
                                <label class="switch switch-3d switch-primary">
                                    {{ html()->checkbox('days_of_work[]', $work_days == '' ? false : true, $key  )->class('switch-input') }}
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div><!--col-->
                            @endforeach
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.venues.address'))->class('col-md-2 form-control-label')->for('address') }}

                            <div class="col-md-10">
                                {{ html()->text('address')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.venues.address'))
                                    }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.venues.active'))->class('col-md-2 form-control-label')->for('active') }}

                            <div class="col-md-10">
                                <label class="switch switch-3d switch-primary">
                                    {{ html()->checkbox('active', true, '1')->class('switch-input') }}
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div><!--col-->
                        </div><!--form-group-->

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.venues.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection