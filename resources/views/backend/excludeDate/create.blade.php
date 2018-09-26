@extends ('backend.layouts.app')

@section ('title', __('labels.backend.excludeDates.header') . ' | ' . __('labels.backend.excludeDates.create'))


@section('content')
@if (session('data.success'))
    <div class="alert alert-success">
        {{ session('data.message') }}
    </div>
@endif
    {{ html()->form('POST', route('admin.excludeDates.store'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            {{ __('labels.backend.excludeDates.create') }}
                            
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <br>
                <p>To exclude dates from been reserved, chose the venue and dates you want to exclude from being reserved</p>
                <hr />

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">                        
                            <div class="col-md-10">
                                {{ html()->label(__('validation.attributes.backend.excludeDates.venue_name'))->class('form-control-label')->for('venue_name') }}
                                {{ html()->select('venues_id', $venues, null)
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.excludeDates.venue_name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            

                            <div class="col-md-5">
                                {{ html()->label(__('labels.backend.excludeDates.from_date'))->class('form-control-label')->for('from_date') }}
                                {{ html()->date('from_date')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.excludeDates.from_date'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                            <div class="col-md-5">
                                {{ html()->label(__('labels.backend.excludeDates.to_date'))->class('form-control-label')->for('to_date') }}
                                {{ html()->date('to_date')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.excludeDates.to_date'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        

                            <div class="col-md-10">
                                {{ html()->label(__('validation.attributes.backend.excludeDates.reason'))->class('form-control-label')->for('reason') }}
                                {{ html()->text('reason')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.excludeDates.reason'))
                                    ->attribute('maxlength', 191)
                                    }}
                            </div><!--col-->
                        </div><!--form-group-->

                       <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.excludeDates.active'))->class('col-md-2 form-control-label')->for('active') }}

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
                        {{ form_cancel(route('admin.excludeDates.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}

@endsection
