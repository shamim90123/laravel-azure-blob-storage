<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Response;

class FileUploadController extends Controller
{
    // Show the upload form
    public function showForm()
    {
        return view('upload');
    }

    // Handle the file upload
    public function uploadFile(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048', // Allow only PDFs up to 2MB
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Upload the file to Azure Blob Storage
        $path = Storage::disk('azure')->put('documents/' . $file->getClientOriginalName(), file_get_contents($file));

        // If uploaded successfully, pass the file name to the view
        if ($path) {
            return back()->with('success', 'File uploaded successfully!')->with('uploadedFile', $file->getClientOriginalName());
        } else {
            return back()->with('error', 'File upload failed.');
        }
    }


    // Download the file from Azure Blob Storage
    public function downloadFile($filename)
    {
        // Get the file from Azure Blob Storage
        if (Storage::disk('azure')->exists('documents/' . $filename)) {
            $fileContent = Storage::disk('azure')->get('documents/' . $filename);
            return Response::make($fileContent, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '"',
            ]);
        } else {
            return back()->with('error', 'File not found.');
        }
    }

    // Delete the file from Azure Blob Storage
    public function deleteFile($filename)
    {
        // Delete the file from Azure Blob Storage
        if (Storage::disk('azure')->exists('documents/' . $filename)) {
            Storage::disk('azure')->delete('documents/' . $filename);
            return back()->with('success', 'File deleted successfully!');
        } else {
            return back()->with('error', 'File not found.');
        }
    }
}
