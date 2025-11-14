<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentAvatarRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Program;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\RedirectResponse;

class StudentController extends Controller
{
    public function index(Request $request)
    {

        $students = Student::with('programs')
            ->search($request->input('search'))
            ->programs($request->input('programs'))
            ->years($request->input('years'))
            ->statuses($request->input('statuses'))
            ->paginate(10)
            ->withQueryString();

        $programs = Program::all();
        return view('dashboard', [
            'students' => $students,
            'programs' => $programs,

        ]);
    }
    public function create()
    {

        $programs = Program::all();

        return view('admin.create-student', [
            'programs' => $programs,
        ]);
    }

    public function show(Student $student)
    {

        return view('admin.show-student', [
            'student' => $student,
        ]);
    }

    public function edit(Student $student)
    {
        $programs = Program::all();

        return view('admin.edit-student', [
            'student' => $student,
            'programs' => $programs,
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $imagePath = null;

            if ($request->hasFile('student_image')) {
                // store in storage/app/public/students
                $imagePath = $request->file('student_image')->store('students', 'public');
            }

            Student::create([
                'student_Fname' => $validatedData['first_name'],
                'student_Mname' => $validatedData['middle_name'],
                'student_Lname' => $validatedData['last_name'],
                'student_Email' => $validatedData['email'],
                'student_Number' => $validatedData['student_number'],
                'student_Birthdate' => $validatedData['birthdate'],
                'student_Gender' => $validatedData['gender'],
                'student_YearLevel' => $validatedData['year_level'],
                'student_Status' => $validatedData['student_status'],
                'student_Notes' => $validatedData['notes'],
                'program_id' => $validatedData['program'],

                'student_Image' => $imagePath,

            ]);

            return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');

        } catch (\Exception $e) {
            Log::error('Student creation failed: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create student. Please try again.']);
        }

    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $validatedData = $request->validated();

        try {
            $student->fill([
                'student_Fname' => $validatedData['first_name'],
                'student_Mname' => $validatedData['middle_name'],
                'student_Lname' => $validatedData['last_name'],
                'student_Email' => $validatedData['email'],
                'student_Number' => $validatedData['student_number'],
                'student_Birthdate' => $validatedData['birthdate'],
                'student_Gender' => $validatedData['gender'],
                'student_YearLevel' => $validatedData['year_level'],
                'student_Status' => $validatedData['student_status'],
                'student_Notes' => $validatedData['notes'],
                'program_id' => $validatedData['program'],
            ]);

            // Check if fields are dirty / Fields that were changed
            if ($student->isDirty()) {
                $student->save();
                return redirect()
                    ->route('admin.students.edit', $student->student_id)
                    ->with('success', 'Student information updated successfully.');
            }

            // If nothing changed, just redirect back with an info message
            return back()->with('info', 'No changes detected.');

        } catch (\Exception $e) {{

            Log::error('Student update failed: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update student. Please try again.']);
        }}

    }

    public function updateImage(UpdateStudentAvatarRequest $request, Student $student)
    {
        try {
            $imagePath = null;

            if ($request->hasFile('student_image')) {
                // store in storage/app/public/students
                $imagePath = $request->file('student_image')->store('students', 'public');
            }

            if ($student->student_Image) {
                //Delete file from the public disk
                Storage::disk('public')->delete($student->student_Image);
            }

            $student->student_Image = $imagePath;
            $student->save();

            return redirect()->route('admin.students.edit', $student->student_id)->with('success', 'Student image updated successfully.');

        } catch (\Exception $e) {

            Log::error('Student update failed: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update student image. Please try again.']);
        }
    }

    public function deleteImage(Student $student)
    {
        try {
            // Check if an image path exists
            if ($student->student_Image) {
                // Delete file from the public disk
                Storage::disk('public')->delete($student->student_Image);
            }

            $student->student_Image = null;
            $student->save();

            return redirect()->route('admin.students.edit', $student->student_id)
                ->with('success', 'Student profile image was successfully removed.');

        } catch (\Exception $e) {
            Log::error('Student image deletion failed: ' . $e->getMessage());
            return back()
                ->withErrors(['error' => 'Failed to remove student image. Please try again.']);
        }
    }

    public function destroy(Student $student): RedirectResponse
    {

        try {

            $student->delete();
            return redirect()->route('admin.students.index')
                ->with('success', 'Student deleted successfully!');

        } catch (\Exception $e) {
            Log::error('Student deletion failed: ' . $e->getMessage());
            return back()
                ->withErrors(['error' => 'Failed to delete student. Please try again.']);
        }
    }
}
