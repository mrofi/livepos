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
    
    protected function userAuthorize($method, Closure $next)
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
            $data = $this->model->all()->toArray();  
            
            return livepos_arrayMapRecursive('livepos_round', $data);
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

            $create = livepos_arrayMapRecursive('livepos_round', $create->toArray());

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
            $model = $this->model;

            foreach ($this->model->get_dependencies() as $otherModel) 
            {
                $model = $model->with($otherModel);    
            }

            $show = $model->find($id);

            if (! $show) return ['error' => 'no data'];
            
            $show = livepos_arrayMapRecursive('livepos_round', $show->toArray());

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
            $update = $this->model->findOrFail($id);
            
            $new_data = array_merge($update->toArray(), $request->all());

            $request->merge($new_data);

            // validation
            $this->validate($request, $this->model->get_rules($id), $this->model->get_error_messages(), $this->model->get_attributes());
            
            // adding user
            $request->merge(['updated_by' => auth()->user()->id]);
            
            // update data
            $update->update($request->all());

            $update = livepos_arrayMapRecursive('livepos_round', $update->toArray());

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

            $delete = $delete->toArray();

            return ['message' => 'ok', 'deleted' => $delete];
        });
    }
}
