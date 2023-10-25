<?php

namespace App\Repository;

use Illuminate\Http\Request;
use App\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;
use App\Models\ProjectProfession;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function create(Request $request){
        $project = new Project;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->base_price = $request->base_price;

        if ($project->save()){
            foreach($request->profession_ids as $pfId){
                $pf = new ProjectProfession;
                $pf->project_id = $project->id;
                $pf->profession_id = $pfId;
                $pf->save();
            }
            return $project;
        }
        return null;
        
    }

    public function get(){
        return Project::with('professions')->get();
    }

    public function getById($id){
        return Project::with('professions')->find($id);
    }

    public function update(Request $request, $id){
        $project = Project::find($id);

        if (!$project){
            return null;
        }

        $project->name = $request->name;
        $project->description = $request->description;

        if ($project->save()){
            $currentProfessions = $project->professions->pluck('id')->toArray();
            $selectedProfessions = $request->profession_ids;

            //determine new selected professions
            $newlySelectedProfessions = array_diff($selectedProfessions, $currentProfessions);

            //determine ths selected to unselected professions
            $professionsToDetach = array_diff($currentProfessions, $selectedProfessions);

            //attach the new selected professions
            $project->professions()->attach($newlySelectedProfessions);

            //detach new unselected professions
            $project->professions()->detach($professionsToDetach);
        }

        return $project;
    }

    public function delete($id){
        $project = Project::find($id);

        if ($project->delete()){
            return true;
        }

        return false;
    }
}

?>