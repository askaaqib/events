@extends ('backend.layouts.app')

@section ('title', __('labels.backend.venues.header') . ' | ' . __('labels.backend.venues.create'))


@section('content')
@if (session('data.success'))
    <div class="alert alert-success">
        {{ session('data.message') }}
    </div>
@endif
    {{ html()->form('POST', route('admin.venues.store'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            {{ __('labels.backend.venues.create') }}
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <br>
                <p>Here you can add new venue</p>
                <hr>
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            

                            <div class="col-md-12">
                                {{ html()->label(__('validation.attributes.backend.venues.venue_name'))->class('form-control-label')->for('venue_name') }}
                                {{ html()->text('venue_name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.venues.venue_name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">                   

                            <div class="col-md-12">
                                {{ html()->label(__('validation.attributes.backend.venues.capacity'))->class('form-control-label')->for('capacity') }}
                                {{ html()->text('capacity')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.venues.capacity'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.venues.days_of_work'))->class('col-md-12 blockquote form-control-label')->for('days_of_work') }}
                            
                            <div class="col-md-1">
                                Saturday
                                <label class="switch switch-3d switch-primary">
                                    {{ html()->checkbox('days_of_work[]', true, 'saturday')->class('switch-input') }}
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div><!--col-->
                            <div class="col-md-1">
                                Sunday
                                <label class="switch switch-3d switch-primary">
                                    {{ html()->checkbox('days_of_work[]', true, 'sunday')->class('switch-input') }}
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div><!--col-->
                            <div class="col-md-1">
                                Monday
                                <label class="switch switch-3d switch-primary">
                                    {{ html()->checkbox('days_of_work[]', true, 'monday')->class('switch-input') }}
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div><!--col-->
                            <div class="col-md-1">
                                Tuesday
                                <label class="switch switch-3d switch-primary">
                                    {{ html()->checkbox('days_of_work[]', true, 'tuesday')->class('switch-input') }}
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div><!--col-->
                            <div class="col-md-1">
                                Wednessday
                                <label class="switch switch-3d switch-primary">
                                    {{ html()->checkbox('days_of_work[]', true, 'wednessday')->class('switch-input') }}
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div><!--col-->
                            <div class="col-md-1">
                                Thursday
                                <label class="switch switch-3d switch-primary">
                                    {{ html()->checkbox('days_of_work[]', true, 'thursday')->class('switch-input') }}
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div><!--col-->
                            <div class="col-md-1">
                                Friday
                                <label class="switch switch-3d switch-primary">
                                    {{ html()->checkbox('days_of_work[]', true, 'friday')->class('switch-input') }}
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            

                            <div class="col-md-12">
                                {{ html()->label(__('validation.attributes.backend.venues.address'))->class('form-control-label')->for('address') }}
                                {{ html()->text('address')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.venues.address'))
                                    }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <input type="hidden" name="days_of_work[]" id="days_of_work">

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
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection