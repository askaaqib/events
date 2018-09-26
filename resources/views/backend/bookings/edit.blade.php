@extends ('backend.layouts.app')

@section ('title', __('labels.backend.bookings.header') . ' | ' . __('labels.backend.bookings.update'))


@section('content')
@if (session('data.success'))
    <div class="alert alert-success">
        {{ session('data.message') }}
    </div>
@endif
    {{-- @dd($bookings); --}}
    {{ html()->modelForm($bookings, 'PATCH', route('admin.bookings.update', $bookings->id))->attribute('enctype','multipart/form-data')->id('backend-bookings')->class('form-horizontal')->open() }}
        <input type="hidden" name="id" value="{{$bookings->id}}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            {{ __('labels.backend.bookings.header') }}
                            <small class="text-muted">{{ __('labels.backend.bookings.update') }}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr />
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.bookings.venue_name'))->class('col-md-2 form-control-label')->for('venue_name') }}
                            <div class="col-md-10">
                                {{ html()->select('venue_id', $venues, null)
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.bookings.venue_name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.bookings.students_count'))->class('col-md-2 form-control-label')->for('students_count') }}

                            <div class="col-md-10">
                                {{ html()->text('students_count')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.bookings.students_count'))
                                    ->attribute('maxlength', 191)->value($bookings->students_count)
                                    }}
                                <span id="label-capacity" style="display:none;">Total Capacity:</span> <span id="venue-capacity"></span>
                                <br><small>Note: Students Count should be less than Total Capacity</small>    
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.bookings.customer_name'))->class('col-md-2 form-control-label')->for('customer_id') }}
                            <div class="col-md-10">
                                {{ html()->select('customer_id', $users, null)
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.bookings.customer_name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label(__('labels.backend.bookings.book_date'))->class('col-md-2 form-control-label')->for('book_date') }}

                            <div class="col-md-10">
                                {{ html()->date('book_date')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.bookings.book_date'))
                                    ->attribute('maxlength', 191)
                                    ->required()->value($bookings->book_date) }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.bookings.students_grade'))->for('grades')->class('col-md-2 form-control-label') }}

                            <div class="col-md-10">
                                 
                                <?php $data = []; $length = 6; $grades = json_decode($bookings->students_grade);?>
                                @for($i=1; $i<=$length; $i++)
                                    @if(in_array($i,$grades))
                                        {{ html()->checkbox('grades', true, $i)->name('grades[]')   }}
                                        {{ html()->label(__('validation.attributes.frontend.'.$i)) }}
                                    @else
                                        {{ html()->checkbox('grades', false, $i)->name('grades[]')  }}
                                        {{ html()->label(__('validation.attributes.frontend.'.$i)) }}
                                    @endif
                                @endfor                             
                                
                            </div>
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.bookings.gender'))->for('gender')->class('col-md-2 form-control-label') }}

                            <div class="col-md-10">                                
                                 {{ html()->radio('gender', false, 'males')->name('gender')->required('required')   }}
                                        {{ html()->label(__('validation.attributes.frontend.males')) }}
                                        {{ html()->radio('gender', false, 'females')->name('gender') }}
                                        {{ html()->label(__('validation.attributes.frontend.females')) }}
                                        {{ html()->radio('gender', false, 'mix')->name('gender')     }}
                                        {{ html()->label(__('validation.attributes.frontend.mix')) }}                                  
                                
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.bookings.food_meal'))->class('col-md-2 form-control-label')->for('need_food_meal') }}

                            <div class="col-md-10">
                                <label class="switch switch-3d switch-primary">
                                    {{ html()->checkbox('need_food_meal', $bookings->need_food_meal == 1 ? true : false, '1')->class('switch-input') }}
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                            </label>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.bookings.special_needs'))->class('col-md-2 form-control-label')->for('special_needs') }}

                            <div class="col-md-10">
                                <label class="switch switch-3d switch-primary">
                                    {{ html()->checkbox('special_needs', $bookings->special_needs == 1 ? true : false, '1')->class('switch-input') }}
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div><!--col-->
                        </div><!--form-group-->
                        
                                <div class="form-group row">                                    
                                    {{ html()->label(__('validation.attributes.frontend.students_name_list'))->for('students_name_list')->class('col-md-2 form-control-label') }}
                                    <div class="col col-md-10">
                                    
                                    {{ html()->file('students_name_list')
                                        ->class('form-control filestyle') }}
                                    @if($bookings->file_uploads)
                                        <b>Download Previous File: </b> <a href="/uploads/{{$bookings->file_uploads}}" ><b>{{$bookings->file_uploads}}</b></a>
                                    @endif
                                    <br>    
                                    {{ html()->label('--OR--')->for('get-doc')->class('col-md-2 form-control-label') }}

                                    <div class="form-group ">
                                     <a href="/get-doc" >Download FORM</a>   
                                    </div>                                   
                                    </div>    
                                </div>

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.bookings.active'))->class('col-md-2 form-control-label')->for('status') }}

                            <div class="col-md-10">
                                <label class="switch switch-3d switch-primary">
                                    {{ html()->checkbox('status', $bookings->status == 1 ? true : false, '1')->class('switch-input') }}
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
                        {{ form_cancel(route('admin.bookings.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update'))->id('submit-bookings') }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
        <input type="hidden" name="students_name_list_old" value="{{$bookings->file_uploads}}">
    {{ html()->form()->close() }}
@endsection