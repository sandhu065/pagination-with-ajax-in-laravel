<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaginationController extends Controller
{
    public function index()
    {
        if(request()->ajax()){
            if (request()->has('search') && request()->input('search.value') !== null) {
                echo $searchText = request()->input('search.value');
            }
            $query = DB::table('users')
            ->select('Fname', 'phone', 'city');
     
        $totalData = $query->count();
        $start = request()->input('start');
        
        $length = request()->input('length');
       
        $query->skip($start)->take($length);
        
        $data = $query->get();
     
        return response()->json([
            'draw' => request()->input('draw'),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'data' => $data
        ]);
        }
       return view('pagination');

       
    }


}
