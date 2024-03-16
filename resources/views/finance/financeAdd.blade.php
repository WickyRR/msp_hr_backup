@extends('layouts.app', ['page' => __('Add Finance'), 'pageSlug' => 'finance.add'])
@section('content')
        @push('pageSpecificCSS')

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        
        @endpush
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('Finance Process') }}</h5>
                    </div>

                    @foreach ($errors->all() as $error )
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>

                    @endforeach

                    <form method="POST" action="{{ route('finance.save') }}">
                        {{ csrf_field() }}
                    <div class="card-body">
                        <div >
                            <label>Employement ID</label>
                            <input type="number" class="form-control" name="employement_id" >
                        </div>
                        <div >
                            <label style="">Category Name</label>
                            <select name="category_id" class="form-control" >
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" style="color: black">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div >
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="5" style="border: 1px solid rgb(61, 61, 61);border-radius: 9px;"></textarea><br/>
                        </div>
                        <div >
                            <label>Total Amount</label>
                            <input type="number" class="form-control" name="total_amount" id="total_amount">
                        </div>
                        <div >
                            <label>Process Status</label>
                            <select name="process_status" class="form-control" >
                                @foreach ($status as $status)
                                <option value="{{$status->id}}" style="color: black">{{$status->status_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div >
                            <label>Request Date</label>
                            <input type="text" class="form-control" name="request_date" id="request_date">
                        </div>
                        <div>
                            <label>Inspected By</label>
                            <input type="number" class="form-control" name="inspected_by" id="inspected_by">
                        </div>
                        <div>
                            <label>Payee Name</label>
                            <input type="text" class="form-control" name="payee_name" id="payee_name">
                        </div>
                        <div>
                            <label>Payee Bank Details</label>
                            <input type="text" class="form-control" name="payee_bank_details" id="payee_bank_details">
                        </div>
                        <div>
                            <label>Account Number</label>
                            <input type="text" class="form-control" name="acc_number" id="acc_number">
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-fill btn-primary" value="Add Finance">
                    </div>
                    </form>
                    <br/>
                    <br/>
            </div>


        </div>
    </div>
        @push('pageSpecificJS')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            
            flatpickr("#request_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
           

          </script>
        @endpush
    @endsection