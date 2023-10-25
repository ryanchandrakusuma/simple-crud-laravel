<?php

namespace App\Http\Controllers;

use App\Repository\ServiceRepository;
use App\Repository\ProjectRepository;
use App\Repository\ClientRepository;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceRepository; 
    protected $projectRepository;
    protected $clientRepository;

    public function __construct(ServiceRepository $serviceRepository, ProjectRepository $projectRepository, ClientRepository $clientRepository){
        $this->serviceRepository = $serviceRepository;
        $this->clientRepository = $clientRepository;
        $this->projectRepository = $projectRepository;
    }

    //for index page
    public function index(){
        //get all records
        $services = $this->serviceRepository->get();

        return view('services.index', [
            'services' => $services,
        ]);
    }

    //for page based on id
    public function show($id){
        //get records based by id
        $projects = $this->projectRepository->get();
        $clients = $this->clientRepository->get();
        $service = $this->serviceRepository->getById($id);

        return view('services.edit', [
            'service' => $service,
            'projects' => $projects,
            'clients' => $clients,
        ]);
    }
    
    //for client creation page
    public function create(){
        $projects = $this->projectRepository->get();
        $clients = $this->clientRepository->get();
        return view('services.create',[
            'projects' => $projects,
            'clients' => $clients,
        ]);
    }

    //functionality
    public function store(Request $request){
        //perform create if validated
        $service = $this->serviceRepository->create($request);

        //null means the insertion is not success
        if ($service == null){
            return redirect()->route('services.create')->with('errors', 'Something is wrong.');
        }

        return redirect()->route('services.create')->with('success', 'Creation Success!');
    }

    //for filtering table based on status
    public function filter(Request $request)
    {
        $selectedStatus = $request->status;

        $services = $this->serviceRepository->getByStatus($selectedStatus);

        return response()->json($services);
    }

    public function update(Request $request, $id){
        //perform update if validated
        $service = $this->serviceRepository->update($request, $id);

        //null means the id is wrong
        if ($service == null){
            return redirect()->route('services.edit', ['id' => $id])->with('errors', 'Invalid ID.');
        }

        return redirect()->route('services.edit', ['id' => $id])->with('success', 'Update Success!');
    }

    public function updateStatus(Request $request, $id){
        //perform update if validated
        $service = $this->serviceRepository->updateStatus($request->status, $id);

        //null means the id is wrong
        if ($service == null){
            return redirect()->route('services.edit', ['id' => $id])->with('errors', 'Invalid ID.');
        }

        return redirect()->route('services.edit', ['id' => $id])->with('success', 'Update Success!');
    }

    public function destroy($id){
        //perform delete 
        $service = $this->serviceRepository->delete($id);
        if ($service){
            return redirect()->route('services.index')->with('success', 'service deleted successfully');
        }
        return redirect()->route('services.index')->with('error', 'Failed to delete service');
    }
}
