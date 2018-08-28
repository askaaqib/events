@extends ('backend.layouts.app')

@section ('title', __('labels.backend.events.header') . ' | ' . __('labels.backend.events.create'))


@section('content')
@if (session('data.success'))
    <div class="alert alert-success">
        {{ session('data.message') }}
    </div>
@endif
{{ html()->modelForm($events, 'PATCH', route('admin.update'))->class('form-horizontal')->open() }}
        <input type="hidden" name="id" value="{{$events->id}}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            {{ __('labels.backend.events.header') }}
                            <small class="text-muted">{{ __('labels.backend.events.create') }}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr />

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.events.venue_name'))->class('col-md-2 form-control-label')->for('venue_name') }}

                            <div class="col-md-10">
                                {{ html()->select('venue_name', $venues )
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.events.venue_name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                   }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.events.capacity'))->class('col-md-2 form-control-label')->for('event_name') }}

                            <div class="col-md-10">
                                {{ html()->text('capacity')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.events.capacity'))
                                    ->attribute('maxlength', 191)
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.events.start_date'))->class('col-md-2 form-control-label')->for('start_date') }}

                            <div class="col-md-10">
                                {{ html()->date('start_date')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.events.start_date'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.events.active'))->class('col-md-2 form-control-label')->for('active') }}

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
                        {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection