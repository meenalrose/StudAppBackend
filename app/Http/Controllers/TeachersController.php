<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    //
    public function teachersList() {
        // echo "received";

        $teachers = DB::table('teachers AS t')
            ->where('t.is_deleted', 0)
            ->select(
                't.id AS id',
                't.name AS name'
            );

        $teachers = $teachers->get();

        return response()->json([
            "status" => 200,
            "data" => $teachers,
        ]);
    }
}
