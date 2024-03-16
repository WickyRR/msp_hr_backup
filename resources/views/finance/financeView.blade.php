@extends('layouts.app', ['page' => __('View Process'), 'pageSlug' => 'finance.view'])
@section('content')
    <div>

        @push('pageSpecificCSS')
           <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
           <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
           <style>
              .modal-dialog {
                margin: -25vh auto 0px auto;
                }
                /*css of text editor*/
                    .card-footer
                    {
                        background-color: rgb(18, 30, 61);
                    }
                    .modal-content .modal-body p
                    {
                        color: white;
                    }
                    label
                    {
                        color: grey;
                    }
                   
                    td {
                    text-align: center;
                    vertical-align: middle;
                    }

       
        
             </style>
        @endpush
        <div id="viewBody">
            <div style="background-color: rgb(18, 30, 61)">
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
        
                <table data-toggle="table" id="table" class="table table-striped table-dark" data-height="555">
                   <thead>
                    <th style="color: white;" data-field="employment_id">Employement ID</th>
                    <th style="color: white;" data-field="category_id">Category Name</th>
                    <th style="color: white;" data-field="description">Description</th>
                    <th style="color: white;" data-field="total_amount">Total Amount</th>
                    <th style="color: white;" data-field="status_id">Process Status</th>
                    <th style="color: white;" data-field="request_date">Request Date</th>
                    <th style="color: white;" data-field="inspected_by">Inspected By</th>
                    <th style="color: white;" data-field="payee_name">Payee Name</th>
                    <th style="color: white;" data-field="payee_bank_details">Payee Bank Details</th>
                    <th style="color: white;" data-field="account_number">Account Number</th>
                    <th style="color: white;" data-field="action">Action</th>
                   </thead>
                   <tbody>
                    @foreach ($datas as $data)
                                <tr>
        
                                    <td>{{ $data->employment_id }}</td>
                                    <td>{{ $data->category->category_name }}</td>
                                    <td>{{ $data->description }}</td>
                                    <td>{{ $data->total_amount }}</td>
                                    <td>{{ $data->status->status_name }}</td> 
                                    <td>{{ $data->request_date }}</td>
                                    <td>{{ $data->inspected_by }}</td>
                                    <td>{{ $data->payee_name }}</td>
                                    <td>{{ $data->payee_bank_details }}</td>
                                    <td>{{ $data->account_number }}</td>
                                    <td>
                                        <a href="/approved/{{ $data->id }}" class="btn btn-primary btn-sm">Approve</a><br/><br/>
                                        <a href="/reject/{{ $data->id }}" class="btn btn-primary btn-sm">Reject</a><br/><br/>
                                        <a href="/reimburse/{{ $data->id }}" class="btn btn-primary btn-sm">Reimburse</a>
                                    </td>
                                   
                                    
                                </tr>
                    @endforeach
                   </tbody>
        
        
                  </table>
            </div>
        </div>
        
        
            @push('pageSpecificJS')
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
                <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                <script src="{{asset('js/alert-box.js')}}"></script>
                
            @endpush
           
    </div>
@endsection