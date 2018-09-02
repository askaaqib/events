@extends('frontend.layouts.app')

@section('title', app_name() . ' | '.__('navs.general.home'))

@section('content')
   
    
    <div class="row mb-12 reservation">
        <div class="col">
            <div class="card">
                    <div class="card-body">
                    <div class="title" id="terms_conditions_reservation">
                    Your Reservation Added Successfully And Waiting for Approval!                    
                    </div>
                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
    
@endsection
