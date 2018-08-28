@extends('frontend.layouts.app')

@section('title', app_name() . ' | '.__('navs.general.home'))

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                    <div class="card-header">
                        <i class="fas fa-home"></i> {{ __('navs.general.home') }}
                    </div>
                    <div class="card-body">
                    <div style="margin: 0 auto; ">
                        @foreach($venues as $venue)
                            <button class="btn btn-primary btn-custs venues" id="{{$venue->id}}">{{$venue->venue_name}}</button>
                        @endforeach
                    </div>
                </div>
            </div><!--card-->
            <div class="card" id="parent_calendar">
               <div id="calendar">
                   
               </div>
            </div>
        </div><!--col-->
    </div><!--row-->
    <div class="row mb-4 d-none log_reg">
        <div class="col">
            <div class="card">
                    <div class="card-body">
                    <div id="tab1">
                       
                    </div>
                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
    <div class="row mb-4 d-none forms_click">
        <div class="col">
            <div class="alert d-none login-succes register-success"></div>
            <div class="card">
                    <div class="card-body">
                    <div id="logged-in">
                       
                    </div>
                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
    <div class="row mb-4 d-none forms_click">
        <div class="col">
            <div class="card">
                    <div class="card-body">
                    <div id="get-reservation">
                       
                    </div>
                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
    
    <div id="terms_overlay" class="d-none"></div>
    <div class="row mb-4 terms_conditions d-none">
        <div class="col">
            <div class="card">
                    <div class="card-body">
                    <div id="terms_conditions_reservation">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam qui repellat sint perspiciatis repudiandae possimus, tempore praesentium iure illo commodi aut est rerum odit impedit officia beatae ullam quo cum.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. In libero corrupti animi tempore, blanditiis similique repellendus vel. Iure earum alias ab, obcaecati culpa quisquam eveniet tempore eum enim, saepe deleniti.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga aperiam culpa eius exercitationem, ex corporis facilis provident consequuntur laboriosam, deserunt illum iure in consequatur ipsa fugiat voluptas placeat et repellat?
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, laborum ipsa deleniti quia, ex excepturi impedit, beatae similique facilis quaerat architecto ratione esse tenetur adipisci vel dolor doloremque cum labore.
                    <br><br>
                    <button class="btn btn-success btn-sm pull-right" id="submit_reservation">Agree & Submit</button>
                    <button class="btn btn-danger btn-sm pull-right" id="cancel_reservation">Cancel</button>
                    </div>
                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
    

    <input type="hidden" id="current_venue" value="">
    <input type="hidden" id="students_count" value="">
    <input type="hidden" id="selected_date" value="">
@endsection
