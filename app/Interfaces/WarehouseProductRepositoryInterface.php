<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Interfaces\BaseInterface;

interface WarehouseProductRepositoryInterface extends BaseInterface {
    public function getByWarehouseId($id);
    public function getByProductId($id);
}

?>