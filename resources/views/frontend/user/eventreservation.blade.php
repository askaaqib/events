<div class="row justify-content-center align-items-center">
        <div class="col col-sm-8 align-self-center">
            <div class="card">
                <div class="card-header">
                    <strong>
                        {{ __('labels.frontend.reservation.box_title') }}
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    {{ html()->form()->id('form_reservation')->class('form_reservation')->open() }}
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.students_count'))->for('students_count') }}

                                    {{ html()->text('students_count_reservation')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.students_count'))
                                        ->attribute('maxlength', 191) }}
                                </div><!--col-->
                            </div>
                            <div class="col col-md-12">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.gender'))->for('gender') }}
                                
                                    <div class="form-control">
                                        {{ html()->checkbox('gender', false, 'males')->name('gender[]')   }}
                                        {{ html()->label(__('validation.attributes.frontend.males')) }}
                                        {{ html()->checkbox('gender', false, 'females')->name('gender[]') }}
                                        {{ html()->label(__('validation.attributes.frontend.females')) }}
                                        {{ html()->checkbox('gender', false, 'mix')->name('gender[]')     }}
                                        {{ html()->label(__('validation.attributes.frontend.mix')) }}                                   
                                    </div>     
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col col-md-12">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.special_needs'))->for('special_needs') }}

                                    <div class="form-control">
                                        {{ html()->radio('special_needs', false, 'yes')   }}
                                        {{ html()->label(__('validation.attributes.frontend.yes')) }}
                                        {{ html()->radio('special_needs', false, 'no') }}
                                        {{ html()->label(__('validation.attributes.frontend.no')) }}                                  
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->

                            <div class="col col-md-12">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.need_food'))->for('need_food') }}

                                    <div class="form-control">
                                        {{ html()->radio('need_food', false, 'yes')   }}
                                        {{ html()->label(__('validation.attributes.frontend.yes')) }}
                                        {{ html()->radio('need_food', false, 'no') }}
                                        {{ html()->label(__('validation.attributes.frontend.no')) }}                                  
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col col-md-12">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.students_grade'))->for('students_grade') }}

                                    <div class="form-control">
                                        {{ html()->checkbox('students_grade', false, '1')->name('students_grade[]')   }}
                                        {{ html()->label(__('validation.attributes.frontend.1')) }}
                                        {{ html()->checkbox('students_grade', false, '2')->name('students_grade[]') }}
                                        {{ html()->label(__('validation.attributes.frontend.2')) }}
                                        {{ html()->checkbox('students_grade', false, '3')->name('students_grade[]') }}
                                        {{ html()->label(__('validation.attributes.frontend.3')) }}
                                        {{ html()->checkbox('students_grade', false, '4')->name('students_grade[]') }}
                                        {{ html()->label(__('validation.attributes.frontend.4')) }}
                                        {{ html()->checkbox('students_grade', false, '5')->name('students_grade[]') }}
                                        {{ html()->label(__('validation.attributes.frontend.5')) }}
                                        {{ html()->checkbox('students_grade', false, '6')->name('students_grade[]') }}
                                        {{ html()->label(__('validation.attributes.frontend.6')) }}                                  
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->
                            <div class="col col-md-6">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.students_name_list'))->for('students_name_list') }}

                                    {{ html()->file('students_name_list')
                                        ->class('form-control') }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->                      
                        

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    {{ html()->button('Make Reservation', 'button')->class('btn btn-success btn-sm pull-right')->id('btn_make_reservation') }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                    {{ html()->form()->close() }}                    
                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col-md-8 -->
    </div><!-- row -->