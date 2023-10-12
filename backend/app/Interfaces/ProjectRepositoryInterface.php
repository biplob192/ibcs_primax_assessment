<?php

namespace App\Interfaces;

interface ProjectRepositoryInterface
{
    public function index();
    public function getData($request);
    public function store($request);
    public function storeProjectTasks($request);
    public function show($id);
    public function getProjectTasks($id);
    public function update($request, $id);
    public function destroy($id);
}
