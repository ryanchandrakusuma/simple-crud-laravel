<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ProjectRepository;
use App\Repository\ProfessionRepository;

class ProjectController extends Controller
{
    protected $projectRepository;
    protected $professionRepository;

    public function __construct(ProjectRepository $projectRepository, ProfessionRepository $professionRepository){
        $this->projectRepository = $projectRepository;
        $this->professionRepository = $professionRepository;
    }

    //for index page
    public function index(){
        //get all records
        $projects = $this->projectRepository->get();

        return view('projects.index', [
            'projects' => $projects,
        ]);
    }

    //for creation page
    public function create(){
        $professions = $this->professionRepository->get();

        return view('projects.create', [
            'professions' => $professions,
        ]);
    }

    //for page based on id
    public function show($id){
        //get records based by id
        $project = $this->projectRepository->getById($id);
        $professions = $this->professionRepository->get();

        return view('projects.edit', [
            'project' => $project,
            'professions' => $professions,
        ]);
    }       

    //functionality
    public function store(Request $request){
        //perform create if validated
        $project = $this->projectRepository->create($request);

        //null means the insertion is not success
        if ($project == null){
            return redirect()->route('projects.create')->with('errors', 'Something is wrong.');
        }

        return redirect()->route('projects.create')->with('success', 'Creation Success!');
    }
    
    public function update(Request $request, $id){
        //perform update if validated
        $project = $this->projectRepository->update($request, $id);

        //null means the id is wrong
        if ($project == null){
            return redirect()->route('projects.edit', ['id' => $id])->with('errors', 'Invalid ID.');
        }

        return redirect()->route('projects.edit', ['id' => $id])->with('success', 'Update Success!');
    }

    public function destroy($id){
        //perform delete 
        $project = $this->projectRepository->delete($id);
        if ($project){
            return redirect()->route('projects.index')->with('success', 'project deleted successfully');
        }
        return redirect()->route('projects.index')->with('error', 'Failed to delete project');
    }
}
