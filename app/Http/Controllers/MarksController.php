<?php

namespace App\Http\Controllers;

use App\Models\Marks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarksController extends Controller
{
    public function marksList () {
        $marks = DB::table('marks AS m')
            ->leftJoin('students AS s', 's.id', '=', 'm.studentId')
            ->where('m.is_deleted', 0)
            ->select(
                'm.*',
                's.id AS studentId',
                's.name AS name'
            );

        $marks = $marks->get();

        return response()->json([
            "status" => 200,
            "data" => $marks,
        ]);
    }
    
    public function storeMarks(Request $request) {
        $validationArray = [
            'student' => 'required',
            'term' => 'required',
            'maths' => 'required',
            'science' => 'required',
            'history' => 'required'
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
        $mark = new Marks();

        $mark->studentId = $request->get('student');
        $mark->maths = $request->get('maths');
        $mark->science = $request->get('science');
        $mark->history = $request->get('history');
        $mark->term = $request->get('term');
        $mark->totalmark = $request->get('maths') + ($request->get('history')) + $request->get('science');

        $mark->is_deleted = 0;
        
        if ($mark->save()) {
            DB::commit();
            return response()->json(
                [
                    'status' => 201,
                    'message' => 'Marks Added',
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

    public function delete($id) {

        echo $id;

        DB::beginTransaction();
        
        $mark = Marks::find($id);
        echo $id;
        $mark->is_deleted = 1;
        $mark->save();

        DB::commit();

        return response()->json(
            [
                'status' => 200,
                'message' => 'Marks Deleted',
            ]
        );

    }

    public function getTerms () {
        $term = DB::table('term AS t')
            ->select(
                't.id AS id',
                't.term AS term'
            );

        $term = $term->get();

        return response()->json([
            "status" => 200,
            "data" => $term,
        ]);
    }

    public function updateMarks($id, Request $request) {

        $student = Marks::find($id);

        $validationArray = [
            'student' => 'required',
            'term' => 'required',
            'maths' => 'required',
            'science' => 'required',
            'history' => 'required'
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

        $mark->studentId = $request->get('student');
        $mark->maths = $request->get('maths');
        $mark->science = $request->get('science');
        $mark->history = $request->get('history');
        $mark->term = $request->get('term');
        $mark->totalmark = $request->get('maths') + ($request->get('history')) + $request->get('science');
        
        if($mark->save()) {
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
}
