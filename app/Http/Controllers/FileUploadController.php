<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Events\FileUploaded;
use Illuminate\Support\Facades\Storage;



class FileUploadController extends Controller
{
    public function index()
    {
        $files = Storage::files('uploads');
        return view('fileUpload', ['files' => $files]);
    }
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $file = $request->file('file');
        $fileName = time() . '-' . $file->getClientOriginalName();
        $file->storeAs('uploads', $fileName);

        // Broadcast the event
        event(new FileUploaded($fileName));

        return back()->with('success', 'File uploaded successfully');
    }

    public function deleteFile($fileName)
    {
        $filePath = 'uploads/' . $fileName;

        if (Storage::disk('local')->exists($filePath)) {
            Storage::disk('local')->delete($filePath);
            return redirect()->route('fileUpload')->with('success', 'File deleted successfully.');
        }

        return redirect()->route('fileUpload')->with('error', 'File not found.');
    }

    public function downloadFile($file)
    {
        $filePath = 'uploads/' . $file;

        if (Storage::disk('local')->exists($filePath)) {
            return Storage::download($filePath);
        }

        return redirect()->back()->with('error', 'File not found.');
    }


}
