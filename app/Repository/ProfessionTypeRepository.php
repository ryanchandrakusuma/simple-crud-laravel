<?php

namespace App\Repository;

use Illuminate\Http\Request;
use App\Interfaces\ProfessionTypeRepositoryInterface;
use App\Models\ProfessionType;

class ProfessionTypeRepository implements ProfessionTypeRepositoryInterface
{
    public function create(Request $request){

    }

    public function get(){
        return ProfessionType::get();
    }

    public function getById($id){

    }

    public function update(Request $request, $id){

    }

    public function delete($id){

    }
}
?>