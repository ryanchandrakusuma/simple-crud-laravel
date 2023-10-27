<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Interfaces\BaseInterface;

interface PurchaseRequestRepositoryInterface extends BaseInterface {
    public function getByStatus($status);
    public function updateStatusToApproved($id);
}

?>