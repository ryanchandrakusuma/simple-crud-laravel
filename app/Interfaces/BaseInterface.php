<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface BaseInterface {
    public function create(Request $request);
    public function get();
    public function getById($id);
    public function update(Request $request, $id);
    public function delete($id);
}

?>