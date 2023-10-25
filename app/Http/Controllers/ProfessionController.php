<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ProfessionRepository;
use App\Repository\ProfessionTypeRepository;
use App\Http\Requests\ProfessionRequest;

class ProfessionController extends Controller
{
    protected $professionRepository;
    protected $professionTypeRepository;

    public function __construct(ProfessionRepository $professionRepository, ProfessionTypeRepository $professionTypeRepository){
        $this->professionRepository = $professionRepository;
        $this->professionTypeRepository = $professionTypeRepository;
    }

    //for index page
    public function index(){
        //get all records
        $professions = $this->professionRepository->get();
    
        return view('professions.index', [
            'professions' => $professions,
        ]);
    }

    //for profession creation page
    public function create(){
        $professionTypes = $this->professionTypeRepository->get();

        return view('professions.create', [
            'professionTypes' => $professionTypes,
        ]);
    }

    //for profession page based on id
    public function show($id){
        //get records based by id
        $profession = $this->professionRepository->getById($id);
        $professionTypes = $this->professionTypeRepository->get();

        return view('professions.edit', [
            'profession' => $profession,
            'professionTypes' => $professionTypes,
        ]);
    }   

    //functionality
    public function store(ProfessionRequest $request){
        //perform update if validated
        $profession = $this->professionRepository->create($request);

        //null means the insertion is not success
        if ($profession == null){
            return redirect()->route('professions.create')->with('errors', 'Something is wrong.');
        }

        return redirect()->route('professions.create')->with('success', 'Creation Success!');
    }

    public function update(ProfessionRequest $request, $id){
        //perform update if validated
        $profession = $this->professionRepository->update($request, $id);

        //null means the id is wrong
        if ($profession == null){
            return redirect()->route('professions.edit', ['id' => $id])->with('errors', 'Invalid ID.');
        }

        return redirect()->route('professions.edit', ['id' => $id])->with('success', 'Update Success!');
    }

    public function destroy($id){
        //perform delete profession
        $profession = $this->professionRepository->delete($id);
        if ($profession){
            return redirect()->route('professions.index')->with('success', 'profession deleted successfully');
        }
        return redirect()->route('professions.index')->with('error', 'Failed to delete profession');
    }
}
