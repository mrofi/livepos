<?php

namespace livepos\Http\Controllers;

use Gate;
use Closure;    
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use livepos\Http\Requests;
use livepos\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $model;
    
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    
    private function userAuthorize($method, Closure $next)
    {
        $class = new \ReflectionClass($this->model);
        $area = $class->getShortName().'.'.$method;
        if (Gate::denies('api-authorization', $area)) return response(['error' => 'Unauthorized.'], 401);
        
        return $next();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->userAuthorize('index', function() use ($request)
        {
            return $this->model->all();  
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->merge(array_map('trim', $request->all()));
        return $this->userAuthorize('store', function() use ($request)
        {
            // validation
            $this->validate($request, $this->model->get_rules(), $this->model->get_error_messages(), $this->model->get_attributes());
            
            // adding user
            $request->merge(['created_by' => auth()->user()->id, 'updated_by' => auth()->user()->id]);
            // insert data
            $create = $this->model->create($request->all());

            if ($create['error']) return $create;

            return ['message' => 'ok', 'created' => $create];
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {        
        return $this->userAuthorize('show', function() use ($request, $id)
        {
            $show = $this->model->find($id);
            if (! $show) return ['error' => 'no data'];
            
            return $show;
        });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->merge(array_map('trim', $request->all()));
     
        return $this->userAuthorize('update', function() use ($request, $id)
        {
            // find record
            $update = $this->model->find($id);
            if (! $update) return ['error' => 'no data'];
            
            // validation
            $this->validate($request, $this->model->get_rules($id), $this->model->get_error_messages(), $this->model->get_attributes());
            
            // adding user
            $request->merge(['updated_by' => auth()->user()->id]);
            
            // update data
            $update->update($request->all());
            return ['message' => 'ok', 'updated' => $update];
        });
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        return $this->userAuthorize('destroy', function() use ($request, $id)
        {
            // find record
            $delete = $this->model->find($id);
            if (! $delete) return ['error' => 'no data'];
            
            $delete->delete();
            return ['message' => 'ok', 'deleted' => $delete];
        });
    }
}
