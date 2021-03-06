 <div class="row justify-content-center align-items-center">
        <div class="col col-sm-8 align-self-center">
            <div class="card">
                <div class="card-header">
                    <strong>
                        {{ __('labels.frontend.auth.login_box_title') }}
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    {{ html()->form()->class('form_id')->id('form_id')->open() }}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.mobileNumber'))->for('mobileNumber') }}

                                    {{ html()->text('mobileNumber')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.mobileNumber'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                                    {{ html()->password('password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="checkbox">
                                        {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group clearfix">
                                	{{-- {{html()->button(__('labels.frontend.auth.login_button'), 'button')->class('btn btn-success btn-sm pull-right')->id('event-login')}}
                                </div><!--form-group--> --}}
                                {{ form_submit(__('labels.frontend.auth.login_button')) }}
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group text-right">
                                    <a href="{{ route('frontend.auth.password.reset') }}">{{ __('labels.frontend.passwords.forgot_password') }}</a>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        
                    {{ html()->form()->close() }}

                </div><!--card body-->
            </div><!--card-->
        </div><!-- col-md-8 -->
    </div><!-- row -->