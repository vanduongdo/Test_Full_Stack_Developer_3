<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repository\Interfaces\TodoRepositoryInterface;

class TodoController extends Controller
{
    protected $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository) 
    {
        $this->todoRepository = $todoRepository;
    }

    public function list(Request $request){
        $result = $this->todoRepository->index();
        return response($result , 200);
    }

    public function create(Request $request){
        $data = $request->all();

        $data['user_id'] = $request->user()->id;
        $data['title'] = isset($data['title']) ? $data['title'] : null;
        $data['description'] = isset($data['description']) ? $data['description'] : null;
        $data['status'] = isset($data['status']) ? $data['status'] : null;
        $data['due_date'] = isset($data['due_date']) ? $data['due_date'] : null;

        $result = $this->todoRepository->storage($data);
        return response($result , 200);
    }

    public function update(Request $request){
        $data = $request->all();

        $data['id'] = isset($data['id']) ? $data['id'] : null;
        $data['title'] = isset($data['title']) ? $data['title'] : null;
        $data['description'] = isset($data['description']) ? $data['description'] : null;
        $data['status'] = isset($data['status']) ? $data['status'] : null;
        $data['due_date'] = isset($data['due_date']) ? $data['due_date'] : null;

        $result = $this->todoRepository->update($data['id'], $data);
        return response($result , 200);
    }

    public function delete(Request $request){
        $data = $request->all();
        $data['id'] = isset($data['id']) ? $data['id'] : null;

        $result = $this->todoRepository->delete($data['id']);
        return response($result , 200);
    }

    public function get_my_subscription(Request $request) {
        
    }

    public function update_subscription(Request $request) {
        $data = $request->all();

        $id = isset($data['id']) ? $data['id'] : null;
        $user_id = $request->user()->id;
        $result = $this->todoRepository->updateSubscription($id, $user_id);
        return response($result , 200);
    }
}
