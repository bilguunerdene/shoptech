<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;

class TypeController extends Controller
{
    public function index(){
        $this->list_models();
    }
    public function edit($id = null){

    }
    private function list_models (){
       
        $search = $this->request->query('searchText');
        $$conditions = [];
        if($search != null) {
            $conditions['OR'] = [
                ['types.name LIKE' => '%' . $search . '%']
            ];
        }
    
        $query = DB::table('types')->where($conditions);
         
     }
}
