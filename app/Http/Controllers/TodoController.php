<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo = Todo::orderBy("plan_start", "desc")->paginate();
        return $todo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $v = Validator::make($params, $this->rules());
        if ($v->fails()){
            $error = $v->errors()->first();
            $errors = $v->errors();
            $data = ['code' => 0, 'status' => false, 'msg'=>$error, 'res'=>[], 'errors'=>$errors];
            return response()->json($data);
        }
        $data = array_intersect_key($params, $this->rules());
        $data["is_completed"] = $data["is_completed"] ? 1 : 0;
        $result = [];
        try{
            $todo = Todo::create($data);
            $result = ['code' => 0, 'status' => TRUE, 'msg'=>"添加成功", 'res'=>[$todo]];
        }catch(Exception $e){
            $result = ['code' => 0, 'status' => FALSE, 'msg'=>"添加失败", 'res'=>[]];
        }
        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
       $status = $request->get("status") ? $request->get("status") : 0;
       $todo->is_completed = $status;
       $result = [];
       $message = $status ? "任务完成" : "任务重启";
       try{
           $todo->save();
           $result = ['code' => 0, 'status' => TRUE, 'msg'=>$message, 'res'=>[$todo->toArray()]];
       }catch(Exception $e){
           $result = ['code' => 0, 'status' => FALSE, 'msg'=>"更新失败", 'res'=>[]];
       }
       return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        //
    }

    private function rules(){
        return [
            "title" => "required|unique:todos,title",
            "plan_start" => "required|date_format:Y-m-d H:i:s",
            "plan_end" => "required|date_format:Y-m-d H:i:s|after:plan_start",
            "is_completed" => "required|boolean"
        ];
    }
}
