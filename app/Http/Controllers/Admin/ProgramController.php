<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProgramController extends Controller
{

    public function index(Request $request)
    {
        $programs = Program::search($request->input('search'))
            ->paginate(10)->withQueryString();

        return view('admin.programs', ['programs' => $programs]);
    }

    public function store(StoreProgramRequest $request)
    {

        $validatedData = $request->validated();

        try {

            Program::create($validatedData);

            return redirect()->route('admin.programs.index')->with('success', 'Program created successfully.');

        } catch (\Exception $e) {
            Log::error('Program creation failed: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create program. Please try again.']);
        }
    }

    public function update(UpdateProgramRequest $request, Program $program)
    {
        $validatedData = $request->validated();

        try {
            $program->fill([
                'program_Title' => $validatedData['edit_program_Title'],
                'program_Code' => $validatedData['edit_program_Code'],
            ]);

            // Check if fields are dirty / Fields that were changed
            if ($program->isDirty()) {
                $program->save();
                return redirect()
                    ->route('admin.programs.edit', $program->program_id)
                    ->with('success', 'Program updated successfully.');
            }

            //  If nothing changed, just redirect back with an info message
            return back()->with('info', 'No changes detected.');

        } catch (\Exception $e) {{

            Log::error('Program update failed: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update program. Please try again.']);
        }}

    }
}
