<?php

namespace App\Http\Controllers;

use App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    public function studentsList () {
        $students = DB::table('students AS s')
            ->leftJoin('teachers AS t', 't.id', '=', 's.teacherId')
            ->where('s.is_deleted', 0)
            ->select(
                's.id AS id',
                's.name AS name',
                's.age AS age',
                's.gender AS gender',
                't.name AS teacher',
                't.id AS teacherID'
            );

        $students = $students->get();

        return response()->json([
            "status" => 200,
            "data" => $students,
        ]);
    }

    public function storeStudent(Request $request) {
        $validationArray = [
            'name' => 'required|max:255',
            'age' => 'required',
            'gender' => 'required',
            'teacher_id' => 'required',
        ];

        $validator = Validator::make(
            $request->all(),
            $validationArray
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 422,
                    'messages' => $validator->errors(),
                ],
                422
            );
        }
        // echo $request->get('name');
        DB::beginTransaction();
        $student = new Students();

        $student->name = $request->get('name');
        $student->age = $request->get('age');
        $student->gender = $request->get('gender');
        $student->teacherId = $request->get('teacher_id');
        $student->is_deleted = 0;
        
        if ($student->save()) {
            DB::commit();
            return response()->json(
                [
                    'status' => 201,
                    'message' => 'Student created',
                ],
                201
            );
        } else{
            return response()->json(
                [
                    'status' => 500,
                    'message' => 'Something went wrong',
                ],
                500
            );
        }
    }

    public function updateStudent($id, Request $request) {

        $student = Students::find($id);

        $validationArray = [
            'name' => 'required|max:255',
            'age' => 'required',
            'gender' => 'required',
            'teacher_id' => 'required',
        ];

        $validator = Validator::make(
            $request->all(),
            $validationArray
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 422,
                    'messages' => $validator->errors(),
                ],
                422
            );
        }

        DB::beginTransaction();

        $student->name = $request->get('name');
        $student->age = $request->get('age');
        $student->gender = $request->get('gender');
        $student->teacherId = $request->get('teacher_id');
        $student->is_deleted = 0;
        
        if($student->save()) {
            DB::commit();
            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Student Updated',
                ],
                200
            );
        }
    }

    public function delete($id) {

        DB::beginTransaction();
        
        $student = Students::find($id);
        $student->is_deleted = 1;
        $student->save();

        DB::commit();

        return response()->json(
            [
                'status' => 200,
                'message' => 'Student Deleted',
            ]
        );

    }

    public function getGender () {
        $gender = DB::table('gender AS g')
            ->select(
                'g.id AS id',
                'g.gender AS gender'
            );

        $gender = $gender->get();

        return response()->json([
            "status" => 200,
            "data" => $gender,
        ]);
    }
}
