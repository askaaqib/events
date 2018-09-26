<div class="row justify-content-center align-items-center">
        <div class="col col-sm-8 align-self-center">
            <div class="card register-card">
                <div class="card-header">
                    <strong>
                        {{ __('labels.frontend.auth.register_box_title') }}
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    {{ html()->form()->id('form_register')->class('form_register')->open() }}
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.name'))->for('name') }}

                                    {{ html()->text('name')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.name'))
                                        ->required()
                                        ->attribute('maxlength', 191) }}
                                </div><!--col-->
                            </div>

                        </div><!--row-->

                        <div class="row">
                            <div class="col col-md-6">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                                    {{ html()->password('password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->

                            <div class="col col-md-6">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}

                                    {{ html()->password('password_confirmation')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col col-md-6">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                    {{ html()->email('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                            <div class="col col-md-6">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.mobileNumber'))->for('mobileNumber') }}

                                    {{ html()->text('mobileNumber')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.mobileNumber'))
                                        ->required()
                                        ->attribute('maxlength', 191) }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.job_title'))->for('job') }}

                                {{ html()->text('job')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.job_title'))
                                    ->required()
                                    ->attribute('maxlength', 191) }}
                                </div><!--form-group-->
                            </div><!--col-->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.schoolName'))->for('schoolName') }}

                                {{ html()->text('schoolName')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.schoolName'))
                                    ->required()
                                    ->attribute('maxlength', 191) }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        <div class="row">
                            {{-- <div class="col-12 col-md-6">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.title'))->for('title') }}

                                    {{ html()->text('title')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.title'))
                                        ->attribute('maxlength', 191) }}
                                </div><!--form-group-->
                            </div><!--col--> --}}
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.schoolPhone'))->for('schoolPhone') }}

                                {{ html()->text('schoolPhone')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.schoolPhone'))
                                    ->required()
                                    ->attribute('maxlength', 191) }}
                                </div><!--form-group-->
                            </div><!--col-->
                            <div class="col col-md-6">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.city'))->for('address') }}

                                    {{ html()->text('address')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.city'))
                                        ->required()
                                        ->attribute('maxlength', 191) }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>
                        


                        
                        @if (config('access.captcha.registration'))
                            <div class="row">
                                <div class="col">
                                    {!! Captcha::display() !!}
                                    {{ html()->hidden('captcha_status', 'true') }}
                                </div><!--col-->
                            </div><!--row-->
                        @endif

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    {{ form_submit(__('labels.frontend.auth.register_button')) }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                    {{ html()->form()->close() }}                    
                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col-md-8 -->
    </div><!-- row -->