<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;


class TaskController extends Controller
{
    private $tasks = [];

    public function __construct()
    {
        $this->tasks = [
           1 =>  [
                'id' => 1,
                'title' => 'Подготовить ужин',
                'description' => 'Приготовить суп из курицы',
                'status' => 'в процессе',
                'created_at' => now(),
            ],
          2 =>  [
                'id' => 2,
                'title' => 'Сходить в магазин',
                'description' => 'Необходимо купить теплые вещи',
                'status' => 'выполнено',
                'created_at' => now(),
            ],
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $id = count($this->tasks) + 1;
        
        $data = [
            'id' => $id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'created_at' => now(),
        ];
    
        $this->tasks[$id] = $data;
    
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (isset($this->tasks[$id])) {
            return response()->json($this->tasks[$id]);
        } 
            return response()->json(['error' => 'Задача не найдена'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        if (isset($this->tasks[$id])) {
            
            $data = [
                'id' => $id,
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'created_at' => $this->tasks[$id]['created_at'],
            ];

            $this->tasks[$id] = $data;

            return response()->json($data);
        } 
            return response()->json(['error' => 'Задача не найдена'], 404);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (isset($this->tasks[$id])) {
            unset($this->tasks[$id]);
            return response()->json($this->tasks);
        } 
            return response()->json(['error' => 'Задача не найдена'], 404);
    }
}
