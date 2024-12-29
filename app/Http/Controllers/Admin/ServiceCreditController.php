<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Faculty;


class ServiceCreditController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/ServiceCredit/Index');
    }
    public function report()
    {
        return Inertia::render('Admin/ServiceCredit/IndexReport');
    }

    public function storeCalc(Request $request)
    {
        // Validate the request
        $request->validate([
            'selected_faculties' => 'required|array',
            'date' => 'required|date',
            'hours_worked' => 'required|integer|min:1'
        ], [
            'selected_faculties.required' => 'At least select a faculty!',
            'date.required' => 'A date is required!',
            'hours_worked.required' => 'An hour is required!'
        ]);


        // Calculate service credit
        $hours_worked = $request->hours_worked;
        $service_credits = intval($hours_worked / 8); // 1 credit for every 8 hours

        if ($service_credits > 0) {
            // Update service credits for each faculty
            foreach ($request->selected_faculties as $facultyId) {
                $faculty = Faculty::find($facultyId['id']);

                if ($faculty) {
                    // Increment the service_credit column
                    $faculty->increment('service_credit', $service_credits);
                }
            }
        }

        return redirect()->route('admin.service-credits.index')->with([
            'success' => 'Service credits successfully updated.',
        ]);
    }

    public function mnlAdjust(Request $request)
{
    // Validate the request
    $request->validate([
        'selected_faculties' => 'required|array',
        'adjustment_reason' => 'required', // Ignoring for now
        'service_credits' => 'required|integer|min:1',
        'credit_action' => 'required|in:add,remove'
    ], [
        'selected_faculties.required' => 'Select at least a single faculty!',
        'adjustment_reason.required' => 'A reason is required for the adjustment.',
        'service_credits.required' => 'A service credit value is needed for adjustment.',
        'credit_action.required' => 'An action is required [Add or Remove]',
        'credit_action.in' => 'Invalid credit action. Only "add" or "remove" is allowed.'
    ]);

    // Get the inputs
    $faculties = $request->selected_faculties; // Array of faculty IDs
    $serviceCredits = intval($request->service_credits);
    $creditAction = $request->credit_action; // "add" or "remove"

    // Iterate through each selected faculty
    foreach ($request->selected_faculties as $facultyId) {
        $facultyRecord = Faculty::find($facultyId['id']);

        if (!$facultyRecord) {
            // If faculty not found, skip or handle error
            continue;
        }

        // Current service credits for the faculty
        $currentCredits = $facultyRecord->service_credit;

        if ($creditAction === 'add') {
            // Add the service credits
            $facultyRecord->service_credit = $currentCredits + $serviceCredits;
        } elseif ($creditAction === 'remove') {
            // Remove the service credits, ensuring it doesn't go negative
            $facultyRecord->service_credit = max(0, $currentCredits - $serviceCredits);
        }

        // Save the updated faculty record
        $facultyRecord->save();
    }

    // Return a response (success message, etc.)
    return redirect()->route('admin.service-credits.index')->with([
        'success' => 'Service credits updated successfully.',
        'affected_faculties' => count($faculties)
    ]);
}
}
