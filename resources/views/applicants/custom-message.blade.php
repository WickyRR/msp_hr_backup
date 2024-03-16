@extends('layouts.app', ['page' => __('Apply'), 'pageSlug' => 'apply', 'title' => $page_title])

@section('content')
    <div class="header py-7 py-lg-8" style="margin-top: -6%;">
        <div class="container">
            <div class="header-body text-center mb-4">
                <div class="row justify-content-center" style="">
                    <div class="col-lg-8 col-md-8">
                        <img src="{{asset('black/img/msplogo1.jpg')}}" style="width: 24%;" class="mb-3">
                        <h1 class="text-white">{{ $recruit_process->process_name }}</h1>
                        <p class="text-lead text-light" style="font-size: 1 rem; line-height: 1.6;">
                            MoraSpirit, the leading light of university sports, is on its way to create a highly vibrant university sports culture in Sri Lanka. It's your time to be part of this family in the journey of empowering Sri Lankan University Sports.
                        </p>
                    </div>
                </div>
                <div class="card mt-5" style="border-radius: 10px;">
                    <div class="card-body">
                        <div class="row text-center justify-content-center" style="font-size: 20px;">
                            <p>{{$custom_message}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
