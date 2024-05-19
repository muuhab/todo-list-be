<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TodoCollection;
use App\Http\Resources\V1\TodoResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\TodoAttachment;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class TodoController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success('Todos retrieved successfully', new TodoCollection(Todo::all()->load('attachments')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {

        $todo = Todo::create($request->all());

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $path) {
                $filename = $this->saveFile($path, 'attachments');
                $attachment = new TodoAttachment();
                $attachment->todo_id= $todo->id;
                $attachment->path = $filename;
                $attachment->name = $path->getClientOriginalName();
                $attachment->save();

            }
        }

        return $this->success('Todo created successfully', new TodoResource($todo->load('attachments')));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $todo = Todo::find($id);
        if(!$todo){
            return $this->notFound('Todo not found');
        }
       return new TodoResource($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, $id)
    {
        $todo = Todo::find($id);
        if(!$todo){
            return $this->notFound('Todo not found');
        }
        $todo->update($request->all());
        if ($request->hasFile('attachments')) {
            $todo->attachments()->delete();
            foreach ($request->file('attachments') as $path) {
                $filename = $this->saveFile($path, 'attachments');
                $attachment = new TodoAttachment();
                $attachment->todo_id= $todo->id;
                $attachment->path = $filename;
                $attachment->name = $path->getClientOriginalName();
                $attachment->save();

            }
        }
        return $this->success('Todo updated successfully', new TodoResource($todo));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $todo = Todo::find($id);

            if(!$todo){

                return $this->notFound('Todo not found');
            }
                $todo->delete();
                $todo->attachments()->delete();
                return $this->success('Todo deleted successfully');
        }
}
