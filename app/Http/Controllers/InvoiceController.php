<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\InvoiceRepository;
use App\Repository\ServiceRepository;

class InvoiceController extends Controller
{
    protected $invoiceRepository;
    protected $serviceRepository;

    public function __construct(InvoiceRepository $invoiceRepository, ServiceRepository $serviceRepository){
        $this->invoiceRepository = $invoiceRepository;
        $this->serviceRepository = $serviceRepository;
    }

    //for index page
    public function index(){
        //get all records
        $invoices = $this->invoiceRepository->get();

        return view('invoices.index', [
            'invoices' => $invoices,
        ]);
    }

}
