<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProjectRequest;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ProjectTaskRequest;
use App\Interfaces\ProjectRepositoryInterface;

class ProjectController extends BaseController
{
    public function __construct(private ProjectRepositoryInterface $projectRepository)
    {
    }

    public function index()
    {
        try {
            $response = $this->projectRepository->index();

            return $this->sendResponse($response['data'], $response['message'], $response['status']);
        } catch (Exception $e) {

            return $this->sendError($e->getMessage() ? $e->getMessage() : 'Internal server error.', '', $e->getCode() ? $e->getCode() : 500);
        }
    }


    public function getData(Request $request)
    {
        try {
            $response = $this->projectRepository->getData($request);

            return $this->sendResponse($response['data'], $response['message'], $response['status']);
        } catch (Exception $e) {

            return $this->sendError($e->getMessage() ? $e->getMessage() : 'Internal server error.', '', $e->getCode() ? $e->getCode() : 500);
        }
    }


    public function store(ProjectRequest $request)
    {
        try {
            DB::beginTransaction();
            $response = $this->projectRepository->store($request);

            return $this->sendResponse($response['data'], $response['message'], $response['status']);
        } catch (Exception $e) {

            DB::rollBack();
            return $this->sendError($e->getMessage() ? $e->getMessage() : 'Internal server error.', '', $e->getCode() ? $e->getCode() : 500);
        }
    }


    public function storeProjectTasks(ProjectTaskRequest $request)
    {
        try {
            DB::beginTransaction();
            $response = $this->projectRepository->storeProjectTasks($request);

            return $this->sendResponse($response['data'], $response['message'], $response['status']);
        } catch (Exception $e) {

            DB::rollBack();
            return $this->sendError($e->getMessage() ? $e->getMessage() : 'Internal server error.', '', $e->getCode() ? $e->getCode() : 500);
        }
    }


    public function show($id)
    {
        try {
            $response = $this->projectRepository->show($id);

            return $this->sendResponse($response['data'], $response['message'], $response['status']);
        } catch (Exception $e) {

            return $this->sendError($e->getMessage() ? $e->getMessage() : 'Internal server error.', '', $e->getCode() ? $e->getCode() : 500);
        }
    }

    public function getProjectTasks($id)
    {
        try {
            $response = $this->projectRepository->getProjectTasks($id);

            return $this->sendResponse($response['data'], $response['message'], $response['status']);
        } catch (Exception $e) {

            return $this->sendError($e->getMessage() ? $e->getMessage() : 'Internal server error.', '', $e->getCode() ? $e->getCode() : 500);
        }
    }


    public function update(ProjectRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $response = $this->projectRepository->update($request, $id);

            return $this->sendResponse($response['data'], $response['message'], $response['status']);
        } catch (Exception $e) {

            DB::rollBack();
            return $this->sendError($e->getMessage() ? $e->getMessage() : 'Internal server error.', '', $e->getCode() ? $e->getCode() : 500);
        }
    }


    public function destroy($id)
    {
        try {
            $response = $this->projectRepository->destroy($id);

            return $this->sendResponse($response['data'], $response['message'], $response['status']);
        } catch (Exception $e) {

            return $this->sendError($e->getMessage() ? $e->getMessage() : 'Internal server error.', '', $e->getCode() ? $e->getCode() : 500);
        }
    }
}
