<?php

namespace App\Repository;

use Illuminate\Http\Request;
use App\Interfaces\ProfessionRepositoryInterface;
use App\Models\Profession;

class ProfessionRepository implements ProfessionRepositoryInterface
{
    public function create(Request $request){
        $profession = new Profession;
        $profession->name = $request->name;
        $profession->profession_type_id = $request->profession_type_id;

        if ($profession->save()){
            return $profession;
        }
        return null;
        
    }

    public function get(){
        return Profession::with('professionType')->get();
    }

    public function getById($id){
        return Profession::find($id);
    }

    public function getByProfessionTypeId($pTypeId){

    }

    public function update(Request $request, $id){
        $profession = Profession::find($id);

        if (!$profession){
            return null;
        }

        $profession->name = $request->name;
        $profession->profession_type_id = $request->profession_type_id;

        $profession->save();

        return $profession;
    }

    public function delete($id){
        $profession = Profession::find($id);

        if ($profession->delete()){
            return true;
        }

        return false;
    }
}
?>