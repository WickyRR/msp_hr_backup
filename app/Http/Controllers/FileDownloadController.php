<?php

namespace App\Http\Controllers;

use App\Models\Applicants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;

class FileDownloadController extends Controller
{
    public function downloadCV($id){
        $applicant=Applicants::find($id);
        if($applicant==null){
            return abort(404);
        }else{
            $ext=new Filesystem;
            $ext=$ext->extension($applicant->cv);
            $fileName='CV-ApplicantID-'.$applicant->recruit_id.'-Process-'.$applicant->process_id.'.'.$ext;
            $headers = [
                'Content-Type' => Storage::disk('s3')->getMimeType($applicant->cv)
            ];
            //return Storage::disk('privateFiles')->download($applicant->cv,$fileName,$headers);
            return Storage::disk('s3')->download($applicant->cv,$fileName,$headers);
        }
    }
}
