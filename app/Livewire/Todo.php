<?php

namespace App\Livewire;

use App\Repo\TodoRepo;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Todo extends Component
{
    protected $repo; 

    #[Rule('required|min:3')]

    public $todo = "";

    public function boot(TodoRepo $repo){
        $this->repo = $repo;
    }

    public function addTodo(){
        $validated  =$this->validateOnly('todo');
        $this->repo->store($validated);
        $this->todo = '';
    }

    public function render()
    {
        $todos = $this->repo->fetchAll();
        return view('livewire.todo', compact('todos'));
    }
}
