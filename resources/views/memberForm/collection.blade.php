@extends('layouts.app', ['page' => __('Apply'), 'pageSlug' => 'apply'])

@section('content')
    @push('pageSpecificCSS')
        <link href="{{ asset('black') }}/css/custom/recruit-form.css" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush
    <div class="header py-7 py-lg-8" style="margin-top: -8%;">
        <div class="container">
            <div class="header-body text-center mb-4">
                <div class="row justify-content-center" style="">
                    <div class="col-lg-8 col-md-8">
                        <img src="{{asset('black/img/msplogo1.jpg')}}" style="width: 24%;" class="mb-3">
                        <h1 class="text-white">Member Details Collection</h1>
                        <p class="text-lead text-light" style="font-size: 1 rem; line-height: 1.6;">
                            MoraSpirit, the leading light of university sports, is on its way to create a highly vibrant university sports culture in Sri Lanka. It's your time to be part of this family in the journey of empowering Sri Lankan University Sports.
                        </p>
                    </div>
                </div>
            </div>
			<div class="row justify-content-center">
                
				<div class="card p-3 d-flex" style="border-radius: 10px;">
					<div id="recruit-form-css" class="mx-auto">
						<div class="card-header"><h4 class="title">Collection Form</h4></div>
                            <div class="text-danger text-center">{{$errors->has('db_ins_fail') ? 'Invalid input. Please contact us if the error continues.' : ''}}</div>
							<form method="post" action="/saveMember" autocomplete="off" id="member_details_collection" enctype="multipart/form-data">
								<div class="card-body">
									@csrf
									@include('alerts.success')

									<table width="100%" >
										<tr>
											<th width="50%" style="margin-bottom: 0;">
												<div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
													<label class="recruit-form-field">{{ __('First Name') }}<span class="text-danger"> *</span></label>
												</div>
											</th>
											<th width="50%" style="margin-bottom: 0;">
												<div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
													<label class="recruit-form-field">{{ __('Last Name') }}<span class="text-danger"> *</span></label>
												</div>
											</th>
										</tr>
										<tr>
											<td>
												<div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="tim-icons icon-single-02"></i>
															</div>
														</div>
														<input type="text" name="first_name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="{{ __('First Name') }}" value="{{ old('first_name') }}" required>
													</div>
												</div>
												@include('alerts.feedback', ['field' => 'first_name'])
											</td>
											<td>
												<div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="tim-icons icon-single-02"></i>
															</div>
														</div>
														<input type="text" name="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Last Name') }}" value="{{ old('last_name') }}" required>
													</div>
												</div>
												@include('alerts.feedback', ['field' => 'last_name'])
											</td>
										</tr>
									</table>

									<div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('E-mail') }}<span class="text-danger"> *</span></label>
										<div class="input-group">
										  <div class="input-group-prepend">
											<div class="input-group-text">
											  <i class="tim-icons icon-email-85"></i>
										   </div>
										 </div>
										<input type="text" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email') }}" required>
										</div>
										@include('alerts.feedback', ['field' => 'email'])
									</div>

									<div class="form-group{{ $errors->has('district') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('District') }}<span class="text-danger"> *</span></label>
										<select name="district" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" id="district" required>
										<option @if (old('district')==null) selected="selected" @endif disabled="true">Please select</option>
											@foreach ($districts as $dist)
											<option value="{{$dist->id}}" @if (old('district')==$dist->id) selected="selected" @endif>{{$dist->district_name}}</option>
											@endforeach
										</select>
										@include('alerts.feedback', ['field' => 'district'])
									</div>

									<div class="form-group{{ $errors->has('town') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('Nearest Town') }}<span class="text-danger"> *</span></label>
										<div class="input-group">
										  <div class="input-group-prepend">
											<div class="input-group-text">
											  <i class="tim-icons icon-bank"></i>
										   </div>
										 </div>
										<input type="text" name="town" class="form-control{{ $errors->has('town') ? ' is-invalid' : '' }}" placeholder="{{ __('Nearest Town') }}" value="{{ old('town') }}" required>
										</div>
										@include('alerts.feedback', ['field' => 'town'])
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

									<div class="form-group{{ $errors->has('pillar') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('Pillar') }}<span class="text-danger"> *</span></label>
										<select name="pillar" class="form-control{{ $errors->has('pillar') ? ' is-invalid' : '' }}" id="pillar" required>
										<option @if (old('pillar')==null) selected="selected" @endif disabled="true">Please select</option>
											@foreach ($pillars as $pill)
											<option value="{{$pill->pillar_id}}" @if (old('pillar')==$pill->pillar_id) selected="selected" @endif>{{$pill->pillar_name}}</option>
											@endforeach
										</select>
										@include('alerts.feedback', ['field' => 'pillar'])
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


									<div class="form-group{{ $errors->has('batch') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('Batch') }}<span class="text-danger"> *</span></label>
										<select name="batch" class="form-control{{ $errors->has('batch') ? ' is-invalid' : '' }}" required>
										<option @if (old('level')==null) selected="selected" @endif disabled="true">Please select</option>
											@for ($i = 18; $i < 23; $i++)
												<option value="{{$i}}" @if (old('batch')==$i) selected="selected" @endif>Batch {{$i}}</option>
											@endfor
										</select>
										@include('alerts.feedback', ['field' => 'batch'])
									</div>

									<div class="form-group{{ $errors->has('fb_url') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('FaceBook Account URL') }}</label>
										<div class="input-group">
										  <div class="input-group-prepend">
											<div class="input-group-text">
											  <i class="tim-icons icon-link-72"></i>
										   </div>
										 </div>
										<input type="text" name="fb_url" class="form-control{{ $errors->has('fb_url') ? ' is-invalid' : '' }}" placeholder="{{ __('Face Book URL') }}" value="{{ old('fb_url') }}">
										</div>
										@include('alerts.feedback', ['field' => 'fb_url'])
									</div>

									<div class="form-group{{ $errors->has('insta_url') ? ' has-danger' : '' }}">
										<label class="recruit-form-field">{{ __('Instagram Account URL') }}</label>
										<div class="input-group">
										  <div class="input-group-prepend">
											<div class="input-group-text">
											  <i class="tim-icons icon-link-72"></i>
										   </div>
										 </div>
										<input type="text" name="insta_url" class="form-control{{ $errors->has('insta_url') ? ' is-invalid' : '' }}" placeholder="{{ __('Instagram URL') }}" value="{{ old('insta_url') }}">
										</div>
										@include('alerts.feedback', ['field' => 'insta_url'])
									</div>

									<div class="form-group{{ $errors->has('birthday') ? ' has-danger' : '' }}">
                                        <label class="recruit-form-field">{{ __('Birthday') }}<span class="text-danger"> *</span></label>
                                        <div class="input-group">
											<input type="text" class="form-control" name="birth_date" id="birthday">
                                        </div>
                                        @include('alerts.feedback', ['field' => 'birthday'])
                                    </div>

									<div class="form-group{{ $errors->has('photo') ? ' has-danger' : '' }}">
                                        <label class="recruit-form-field">{{ __('Add a single photo of yours (a single photo taken recently)') }}<span class="text-danger"> *</span></label>
										<br>
										<label><small class="text-danger">This photo should be input as a drive link .</small></label>
										<div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-image-02"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="photo" class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}" placeholder="{{ __('Single Photo of Yours') }}" value="{{ old('photo') }}" required>
                                        </div>
                                        @include('alerts.feedback', ['field' => 'photo'])
                                    </div>
									
									

									

                                    
								</div>
								<div class="card-footer">
									<div class="form-group mb-4">
									<p>Thank you for your valuable time!</p>
									
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
		<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
		<script >
           
            flatpickr("#birthday", {
                enableTime: false,
                dateFormat: "Y-m-d",
            });
           
          </script>

    @endpush
@endsection
