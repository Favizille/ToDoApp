<?php

namespace App\Repo;

class TodoRepo{
    public function store($data){
        $createTodo = auth()->user()->todos()->create($data);

        if($createTodo){
            return $createTodo;
        }
    }

    // This function will be passed on the render method on the todo component because it has pagination
    public function fetchAll(){
        $todos = auth()->user()->todos()->paginate(3);
        return $todos;
    }

    public function getTodo($todoId){
        return auth()->user()->todos()->find($todoId);
    }

    public function update($todoId, $editedTodo){
        $todo = $this->getTodo($todoId);
        return $todo->update([
            "todo" => $editedTodo
        ]);
    }
}