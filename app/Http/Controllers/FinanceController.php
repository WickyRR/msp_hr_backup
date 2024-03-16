<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinanceRequests;
use App\Models\FinanceRequestStatus;
use App\Models\FinanceRequestCategories;
use DB;
class FinanceController extends Controller
{
    public function add()
    {
        $status=FinanceRequestStatus::all();
        $category=FinanceRequestCategories::all();
        return view('finance/financeAdd',['status'=>$status,'categories'=>$category]);
    }

    public function view()
    {
        //$data=FinanceRequests::all();
        
       /* $data = DB::table('finance_requests')
                ->join('finance_request_status','finance_requests.status_id','=','finance_request_status.id')
                 ->get();*/

        $data=FinanceRequests::with(['status','category'])->latest()->get();

        return view('finance.financeView')->with('datas',$data);
    }
    public function store(Request $request){
        $task=new FinanceRequests;

        $this -> validate($request,[
            'employement_id'=>['int','required'],
            'category_id'=>['int','required'],
            'total_amount'=>['int','required'],
            'process_status'=>['in:1,2,3','required'],
            'request_date'=>['date','required'],
            'inspected_by'=>['int','required'],
            'payee_name' => ['string','required'],
            'payee_bank_details' => ['string','required'],
            'acc_number' => ['string','required'],
        ]);

        $task->employment_id=$request->employement_id;
        $task->category_id=$request->category_id;
        $task->description=$request->description;
        $task->total_amount=$request->total_amount;
        $task->status_id=$request->process_status;
        $task->request_date=$request->request_date;
        $task->inspected_by=$request->inspected_by;
        $task->payee_name=$request->payee_name;
        $task->payee_bank_details=$request->payee_bank_details;
        $task->account_number=$request->acc_number;


        $task->save();
       return redirect()->route( 'finance.add');
    }

    public function approved($id)
    {
        $task=FinanceRequests::find($id);
        $task->status_id=1;
        $task->save();
        return redirect()->route( 'finance.view');
    }
    public function reject($id)
    {
        $task=FinanceRequests::find($id);
        $task->status_id=2;
        $task->save();
        return redirect()->route( 'finance.view');
    }
    public function reimburse($id)
    {
        $task=FinanceRequests::find($id);
        $task->status_id=3;
        $task->save();
        return redirect()->route( 'finance.view');
    }
}

