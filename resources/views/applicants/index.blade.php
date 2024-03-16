@extends('layouts.app', ['page' => __('Apply'), 'pageSlug' => 'apply', 'title' => $recruit_process->process_name])

@section('content')
    @push('pageSpecificCSS')
        <link href="{{ asset('black') }}/css/custom/recruit-form.css" rel="stylesheet" />
    @endpush
    <div class="header py-7 py-lg-8" style="margin-top: -8%;">
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
            </div>
			<div class="row justify-content-center">
                <div class="card mt-5 justify-content-start pl-4" style="border-radius: 10px;">
                    <div class="card-header"><h4 class="title">Instructions</h4></div>
                    <div class="card-body">
                        <div class="row text-left justify-content-start" style="font-size: 14px;">
                          <p>{!! $recruit_process->instructions !!}
                          </p>
                        </div>
                    </div>
                </div>
				<div class="card p-3 d-flex" style="border-radius: 10px;">
					<div id="recruit-form-css" class="mx-auto">
						<div class="card-header"><h4 class="title">Apply Form</h4></div>
                            <div class="text-danger text-center">{{$errors->has('db_ins_fail') ? 'Invalid input. Please contact us if the error continues.' : ''}}</div>
							<form method="post" action="{{ route('apply.store')}}" autocomplete="off" id="recruit_form" enctype="multipart/form-data">
								<div class="card-body">
									@csrf
									@include('alerts.success')

                                    <div class="form-group{{ $errors->has('full_name') ? ' has-danger' : '' }}">
                                        <label class="recruit-form-field">{{ __('Full Name') }}<span class="text-danger"> *</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-single-02"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="full_name" class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Full Name') }}" value="{{ old('full_name') }}" required>
                                        </div>
                                        @include('alerts.feedback', ['field' => 'full_name'])
                                    </div>

									<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('Preferred Name') }}<span class="text-danger"> *</span></label>
										<div class="input-group">
										  <div class="input-group-prepend">
											<div class="input-group-text">
											  <i class="tim-icons icon-single-02"></i>
										   </div>
										 </div>
										<input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required>
										</div>
										@include('alerts.feedback', ['field' => 'name'])
									</div>

									<div class="form-group{{ $errors->has('index_no') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('Index Number') }}</label>
										<div class="input-group">
										  <div class="input-group-prepend">
											<div class="input-group-text">
											  <i class="tim-icons icon-badge"></i>
										   </div>
										 </div>
										<input type="text" name="index_no" class="form-control{{ $errors->has('index_no') ? ' is-invalid' : '' }}" placeholder="{{ __('Index Number') }}" value="{{ old('index_no') }}">
										</div>
										@include('alerts.feedback', ['field' => 'index_no'])
									</div>

									<div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('Email address') }}<span class="text-danger"> *</span></label>
										<div class="input-group">
										  <div class="input-group-prepend">
											<div class="input-group-text">
											  <i class="tim-icons icon-email-85"></i>
										   </div>
										 </div>
										<input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email') }}" required>
										</div>
										@include('alerts.feedback', ['field' => 'email'])
									</div>

									<div class="form-group{{ $errors->has('contact_no') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('Contact Number (Whatsapp)') }}<span class="text-danger"> *</span></label>
										<div class="input-group">
										  <div class="input-group-prepend">
											<div class="input-group-text">
											  <i class="tim-icons icon-mobile"></i>
										   </div>
										 </div>
										<input type="text" name="contact_no" class="form-control{{ $errors->has('contact_no') ? ' is-invalid' : '' }}" placeholder="{{ __('Contact Number') }}" value="{{ old('contact_no') }}" required>
										</div>
										@include('alerts.feedback', ['field' => 'contact_no'])
									</div>

									<div class="form-group{{ $errors->has('faculty') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('Faculty') }}<span class="text-danger"> *</span></label>
										<select name="faculty" class="form-control{{ $errors->has('faculty') ? ' is-invalid' : '' }}" id="faculty" required>
											<option @if (old('faculty')==null) selected="selected" @endif disabled="true">Please select</option>
											@foreach ($faculty as $fac)
												<option value="{{$fac->fac_id}}" @if (old('faculty')==$fac->fac_id) selected="selected" @endif>{{$fac->fac_name}}</option>
											@endforeach
										</select>
										@include('alerts.feedback', ['field' => 'faculty'])
									</div>

                                    <div class="form-group{{ $errors->has('department') ? ' has-danger' : '' }}">
                                        <label class="recruit-form-field">{{ __('Department') }}<span class="text-danger"> *</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-bank"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="department" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" placeholder="{{ __('Department') }}" value="{{ old('department') }}" required>
                                        </div>
                                        @include('alerts.feedback', ['field' => 'department'])
                                    </div>

									<div class="form-group{{ $errors->has('batch') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('Batch') }}<span class="text-danger"> *</span></label>
										<select name="batch" class="form-control{{ $errors->has('batch') ? ' is-invalid' : '' }}" required>
											<option @if (old('batch')==null) selected="selected" @endif disabled="true">Please select</option>
											@for ($i = 18; $i < 23; $i++)
												<option value="{{$i}}" @if (old('batch')==$i) selected="selected" @endif>Batch {{$i}}</option>
											@endfor
										</select>
										@include('alerts.feedback', ['field' => 'batch'])
									</div>

									<div class="form-group {{ $errors->has('prev_member') ? ' has-danger' : '' }}">
										<label class="recruit-form-field" style="display: block;">{{ __('Are you a MoraSpiriter or not?') }}<span class="text-danger"> *</span></label>
										<div class="form-check form-check-radio form-check-inline">
											<label class="form-check-label">
											<input type="radio" name="prev_member" class="form-check-input {{ $errors->has('prev_member') ? ' is-invalid' : '' }}"  value="1"
                                            @if(old('prev_member')==1) checked="checked" @endif required> Yes
											<span class="form-check-sign"></span>
										  </label>
										</div>
										<div class="form-check form-check-radio form-check-inline">
											<label class="form-check-label">
											<input type="radio" name="prev_member" class="form-check-input {{ $errors->has('prev_member') ? ' is-invalid' : '' }}"  value="0"
                                                   @if(old('prev_member')==0) checked="checked" @endif required> No
											<span class="form-check-sign"></span>
										  </label>
										</div>
										@include('alerts.feedback', ['field' => 'prev_member'])
									</div>

									<div class="form-group{{ $errors->has('projects') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('If you\'re a MoraSpiriter, what are the projects that you have involved in before?') }}</label>
										<textarea style="max-height: 120px;" name="projects" class="form-control{{ $errors->has('projects') ? ' is-invalid' : '' }}" placeholder="{{ __('Your previous projects') }}" rows="10">{{ old('projects') }}</textarea>
										@include('alerts.feedback', ['field' => 'projects'])
									</div>

									<div class="form-group {{ $errors->has('pillars') ? ' has-danger' : '' }}">
										<label class="recruit-form-field" style="display: block;">{{ __('Pillars that you would like to apply') }}<span class="text-danger"> *</span></label>
                                        <label><small class="text-info">You can apply to any number of pillars. But you will be selected through an interview process for each pillar seperately.</small></label>
										@foreach($pillars as $pillar)
                                        <div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input {{ $errors->has('pillars') ? ' is-invalid' : '' }}" type="checkbox" value="{{$pillar->pillar_id}}" name="pillars[]"
                                                @if(old('pillars')!=null) @if(in_array($pillar->pillar_id,old('pillars'))) checked="checked" @endif @endif>
                                                {{$pillar->pillar_name}}
												<span class="form-check-sign">
													<span class="check"></span>
												</span>
											</label>
										</div>
                                        @endforeach
										@include('alerts.feedback', ['field' => 'pillars'])
									</div>

									<div class="form-group {{ $errors->has('skills') ? ' has-danger' : '' }}">
										<label class="recruit-form-field" style="display: block;">{{ __('Skills that you have') }}<span class="text-danger"> *</span></label>
                                        @foreach($skills as $skill)
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input {{ $errors->has('skills') ? ' is-invalid' : '' }}" type="checkbox" value="{{$skill->skill_id}}" name="skills[]"
                                                           @if(old('skills')!=null) @if(in_array($skill->skill_id,old('skills'))) checked="checked" @endif @endif>
                                                    {{$skill->skill_name}}
                                                    <span class="form-check-sign">
													<span class="check"></span>
												</span>
                                                </label>
                                            </div>
                                        @endforeach
										@include('alerts.feedback', ['field' => 'skills'])
									</div>

									<div class="form-group{{ $errors->has('driveLink') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('If you have any experience related to above mentioned pillars please upload it here.') }}</label>
										<label><small class="text-info">Upload it to your own drive folder and then put(paste) the link here</small></label>

										<div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-link-72"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="driveLink" class="form-control{{ $errors->has('driveLink') ? ' is-invalid' : '' }}" placeholder="{{ __('Drive Link') }}" value="{{ old('driveLink') }}">
                                        </div>

										@include('alerts.feedback', ['field' => 'driveLink'])
									</div>

									<div class="form-group{{ $errors->has('clubs') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('Clubs and Societies that you are involved in university') }}</label>
										<textarea style="max-height: 90px;" name="clubs" class="form-control{{ $errors->has('clubs') ? ' is-invalid' : '' }}" placeholder="{{ __('Clubs and societies') }}" rows="10">{{ old('clubs') }}</textarea>
										@include('alerts.feedback', ['field' => 'clubs'])
									</div>

									<div class="form-group{{ $errors->has('sports_do') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('Sports that you are involved in university') }}</label>
										<textarea style="max-height: 90px;" name="sports_do" class="form-control{{ $errors->has('sports_do') ? ' is-invalid' : '' }}" placeholder="{{ __('Sports you are involved') }}" rows="10">{{ old('sports_do') }}</textarea>
										@include('alerts.feedback', ['field' => 'sports_do'])
									</div>

									<div class="form-group{{ $errors->has('achievements') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('Achievements') }}</label>
										<textarea style="max-height: 90px;" name="achievements" class="form-control{{ $errors->has('achievements') ? ' is-invalid' : '' }}" placeholder="{{ __('Achievements') }}" rows="10">{{ old('achievements') }}</textarea>
										@include('alerts.feedback', ['field' => 'achievements'])
									</div>
                                    <div class="form-group{{ $errors->has('cv') ? ' has-danger' : '' }}">
                                        <label class="recruit-form-field" style="display: block;">{{ __('Upload CV and/or Portfolio') }}<span class="text-danger"> *</span></label>
                                        <label><small class="text-info"><a href="https://www.canva.com/t/EAD7WSwGy20-blue-and-black-modern-resume/" target="_blank">CV Template 1</a> | <a href="https://www.cv-template.com/en" target="_blank">CV Template 2</a></small></label><br/>
										<label><small class="text-danger">Required file type - pdf or zip, Max file size - 10MB</small></label>
                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput" style="display: block;">
                                            <div class="fileinput-new thumbnail img-circle" style="max-width: 40px; border-radius: 0px;">
                                                <img src="{{asset('black/img/cv-icon.png')}}" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                                            <div class="ml-3" style="display: inline;">
                                                <span class="btn btn-round btn-rose btn-file">
                                                  <span class="fileinput-new">Add CV</span>
                                                  <span class="fileinput-exists">Change</span>
                                                  <input type="file" name="cv" id="cv" required>
                                                </span>
                                                <a href="#pablo" class=" ml-4 btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                <hr style="background-color: #2a324e;">
                                                @include('alerts.feedback', ['field' => 'cv'])
                                            </div>
                                        </div>
                                    </div>
								</div>
								<div class="card-footer">
									<div class="form-group mb-4">
									<p>Thank you for your valuable time!</p>
									<p>{!! $recruit_process->contact_details !!}</p>
									</div>
									<button type="submit" class="btn btn-fill btn-primary">Save</button>
								</div>
						</form>
					</div>
				</div>
			</div>
        </div>
    </div>
    @push('pageSpecificJS')
        <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
        <script src="{{asset('black/js/custom/recruit-form.js')}}"></script>
    @endpush
@endsection
