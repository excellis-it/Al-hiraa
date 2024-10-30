<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class PDFController extends Controller
{
    public function downloadPdf($id)
    {
        $data = Job::findOrFail($id);


        $filePath = public_path('storage/' . $data->document);

        if (file_exists($filePath)) {
            return response()->download($filePath, basename($data->document), [
                'Content-Type' => 'application/pdf',
            ]);
        }
    }
}
