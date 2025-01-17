<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Configuration\RPMSConfiguration;
use App\Models\RPMS;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class RPMSController extends Controller
{
    public function index()
    {
        $rpms = RPMS::paginate(5);

        $year_now = Carbon::now()->format('Y');
        $rpms_config = RPMSConfiguration::where('year', $year_now)->select('id', 'mid_year_date', 'end_year_date', 'year')->first();

        return Inertia::render('Faculty/RPMS/Index', [
            'rpms' => $rpms,
            'rpmsConfig' => $rpms_config,
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'nullable|string|max:255',
        ]);

        $query = $request->input('query', '');

        $rpms = RPMS::where('filename', 'LIKE', '%' . $query . '%')
            ->paginate(5); // Paginate the results

        $year_now = Carbon::now()->format('Y');
        $rpms_config = RPMSConfiguration::where('year', $year_now)->select('id', 'mid_year_date', 'end_year_date', 'year')->first();

        return Inertia::render('Faculty/RPMS/Index', [
            'rpms' => $rpms,
            'rpmsConfig' => $rpms_config,
            'searchQuery' => $query,
        ]);
    }


    public function store(Request $request)
    {
        // Validate the file inputs
        $request->validate([
            'mainFile' => 'required|file|mimes:pdf|max:5120', // 5MB limit
            'additionalFiles.*' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        // Get current date
        $currentDate = now();

        // Fetch the current RPMS configuration
        $config = RPMSConfiguration::where('year', $currentDate->year)->first();

        if (!$config) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'No RPMS configuration found for the current year.']);
        }

        // Determine the upload period based on the configuration
        $uploadPeriod = $currentDate->lessThan($config->mid_year_date)
            ? 'mid_year'
            : 'end_year';

        // Check if the current faculty member has already uploaded 5 files in this period
        $fileCount = RPMS::where('faculty_id', auth()->id())
            ->where('upload_period', $uploadPeriod)
            ->count();

        $newFilesCount = 1 + (is_array($request->file('additionalFiles')) ? count($request->file('additionalFiles')) : 0);

        if ($fileCount + $newFilesCount > 5) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Upload limit exceeded. You can only upload a maximum of 5 files per upload period.']);
        }

        // Store the main file
        $mainFile = $request->file('mainFile');
        $mainFilePath = $mainFile->store('uploads', 'public'); // Save the file in the "uploads" directory
        RPMS::create([
            'filename' => $mainFile->getClientOriginalName(),
            'file_path' => $mainFilePath,
            'upload_period' => $uploadPeriod,
            'faculty_id' => auth()->id(),
        ]);

        // Store additional files (if any)
        $additionalFiles = $request->file('additionalFiles') ?? [];
        foreach ($additionalFiles as $file) {
            $filePath = $file->store('uploads', 'public');
            RPMS::create([
                'filename' => $file->getClientOriginalName(),
                'file_path' => $filePath,
                'upload_period' => $uploadPeriod,
                'faculty_id' => auth()->id(),
            ]);
        }

        // Redirect with success message
        return redirect()
            ->route('faculty.rpms.store')
            ->with('success', 'RPMS uploaded successfully!');
    }

    public function viewFile($file)
    {
        $rpms_file = RPMS::find($file);

        if (!Storage::disk('public')->exists($rpms_file->file_path)) {
            abort(404, 'File not found.');
        }


        return response()->json(['pdfUrl' => Storage::disk('public')->url($rpms_file->file_path)]);
    }

    public function download($file)
    {
        // Validate the file ID
        $rpms_file = RPMS::find($file);

        if (!$rpms_file) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        // Check if the file exists in storage
        if (!Storage::disk('public')->exists($rpms_file->file_path)) {
            return response()->json(['error' => 'File not available in storage.'], 404);
        }

        try {
            // Return the file download response
            return Storage::disk('public')->download($rpms_file->file_path);
        } catch (\Exception $e) {
            // Handle unexpected errors gracefully
            return response()->json([
                'error' => 'An error occurred while trying to download the file.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function destroy(Request $request, $id)
    {
        // Find the RPMS record by ID
        $rpms = RPMS::find($id);

        if (!$rpms) {
            return response()->json([
                'message' => 'File not found.'
            ], 404);
        }

        // Delete the file from storage
        if (Storage::exists($rpms->file_path)) {
            Storage::delete($rpms->file_path);
        }

        // Delete the RPMS record from the database
        $rpms->delete();

        return redirect()->back()->with([
            'message' => 'File deleted successfully.'
        ], 200);
    }
}
