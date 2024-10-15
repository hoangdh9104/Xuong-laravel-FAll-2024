<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Classroom;
use App\Models\Passport;
use App\Models\Subject;

class StudentController extends Controller
{
    const PATH_VIEW = 'students.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Student::with('classroom')->latest('id')->paginate();
        // dd($data);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::all();
        $subjects = Subject::all();

        // Trả về view với các biến đã lấy
        return view('students.create', compact('classrooms', 'subjects'));

        // Truyền dữ liệu student và danh sách classroom vào view
        // return view(self::PATH_VIEW . __FUNCTION__, compact('classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();

        try {

            $student = Student::query()->create($data);


            Passport::create([
                'student_id' => $student->id,
                'passport_number' => $request->passport_number,
                'issued_date' => $request->issued_date, 
                'expiry_date' => $request->expiry_date, 
            ]);

           
            $student->subjects()->attach($request->subjects);

            return redirect()->route('students.index')->with('success', true);
        } catch (\Throwable $th) {

            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {

        $student = Student::with('passport', 'subjects')->findOrFail($student->id);
        $passportNumber = $student->passport ? $student->passport->passport_number : 'No Passport';
        $subjects = $student->subject ? $student->subject->name : 'No Subject';
        
        return view('students.show', compact('student', 'passportNumber', 'subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classrooms = Classroom::all();
        $passport = Passport::all();
        $subjects = Subject::all();

        // dd($passport->toArray());
       
        return view(self::PATH_VIEW . __FUNCTION__, compact('student', 'classrooms', 'subjects', 'passport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->validated();

        try {
            
            $student->update($data);

            
            $passportData = [
                'student_id' => $student->id,
                'passport_number' => $request->passport_number,
                'issued_date' => $request->issued_date,
                'expiry_date' => $request->expiry_date,
            ];

            if ($student->passport) {
               
                $student->passport->update($passportData);
            } else {
                
                Passport::create($passportData);
            }

            $student->subjects()->sync($request->subjects);

            return back()->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            $student->subjects()->detach();
            if ($student->passport) {
                $student->passport->delete();
            }
            
            $student->delete();

            return back()->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }
}
