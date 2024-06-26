<?php

namespace App\Livewire;

use App\Repo\TodoRepo;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;

class Todo extends Component
{
    use WithPagination;
    protected $repo;
    public $edit;

    #[Rule('required|min:3')]

    public $todo = "";

    #[Rule('required|min:3')]

    public $editedTodo;

    public function boot(TodoRepo $repo){
        $this->repo = $repo;
    }

    public function addTodo(){
        $validated  =$this->validateOnly('todo');
        $this->repo->store($validated);
        $this->todo = '';
    }

    public function editTodo($todoId){
        $this->edit = $todoId;
        $this->editedTodo = $this->repo->getTodo($todoId)->todo;
    }

    public function cancelEdit(){
        $this->edit  = "";
    }

    public function updateTodo($todoId){
        $validated = $this->validateOnly('editedTodo');
        $this->repo->update($todoId, $validated['editedTodo']);
        return $this->cancelEdit();
    }

    public function render()
    {
        $todos = $this->repo->fetchAll();
        return view('livewire.todo', compact('todos'));
    }
}
