<?php

namespace App\Repository\Eloquent;

use App\Repository\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;
use App\Models\Subscription;
use Carbon\Carbon;

class TodoRepository implements TodoRepositoryInterface
{

    protected $model;
    public function __construct(Todo $model)
    {
        $this->model = $model;
    }

    public function index() {
        $result = $this->model->where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate();
        return $result;
    }

    public function storage($data = []){
        $todo = $this->model->create([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'due_date' => date('Y-m-d', strtotime($data['due_date']." +1 days")),
        ]);
        return $todo;
    }

    public function update($id, $data = []){
        $todo = $this->model->whereId($id)->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'due_date' => date('Y-m-d', strtotime($data['due_date']." +1 days")),
        ]);

        return $todo;
    }

    public function delete($id){
        $result = $this->model->where('id',$id)->delete();
        return $result;
    }

    public function updateSubscription($package_id, $user_id) {

        $start_date = Carbon::now();
        $end_date = $start_date->addDays(30);
        $todo = Subscription::create([
            'user_id' => $user_id,
            'plan' => $package_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);
        return $todo;
    }
}