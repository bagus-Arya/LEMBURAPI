<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use App\Contracts\LemburRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\References;
use App\Models\Employees;
use App\Models\Overtimes;

class LemburRepository implements LemburRepositoryInterface
{  
    protected $settings;
    protected $references;
    protected $employees;
    protected $overtimes;

    public function __construct()
    {
        $this->settings = app(Settings::class);
        $this->references = app(References::class);
        $this->employees = app(Employees::class);
        $this->overtimes = app(Overtimes::class);
    }

    public function createOvertimes(Request $request){
        try {
            $validateOvertimes = Validator::make($request->all(), [
                'employee_id'      => 'required|min:2|unique:employees',
                'date'      => 'required|integer',
                'time_started'        => 'required|numeric|min:2000000|max:10000000',
                'time_ended'        => 'required|numeric|min:2000000|max:10000000',
            ]);
            if ($validateOvertimes->fails()) {
                return response()->json($validateOvertimes->errors()); 
            }
            $this->overtimes->employee_id = $request->input('employee_id');
            $this->overtimes->date = $request->input('date');
            $this->overtimes->time_started = $request->input('time_started');
            $this->overtimes->time_ended = $request->input('time_ended');

            $this->overtimes->save();
            return response()->json('Success');
        } catch (\Exception $ex) {
            return response()->json($ex->getMessage());
        }
    }
    public function create(Request $request){
        try {
            $validateEmployee = Validator::make($request->all(), [
                'name'      => 'required|min:2|unique:employees',
                'status_id'      => 'required|integer',
                'salary'        => 'required|numeric|min:2000000|max:10000000',
            ],[
                'name.required'      => "Nama Wajib Diisi",
                'status_id.required'      => "Status ID Wajib Diisi",
                'salary.required'        => "Salary Wajib Diisi",
            ]);
            if ($validateEmployee->fails()) {
                return response()->json($validateEmployee->errors()); 
            }
            $this->employees->name = $request->input('name');
            $this->employees->status_id = $request->input('status_id');
            $this->employees->salary = $request->input('salary');

            $this->employees->save();
            return response()->json('Success');
        } catch (\Exception $ex) {
            return response()->json($ex->getMessage());
        }
    }
    public function createRequest($request){
        $this->employees->name = $request->input('name');
        $this->employees->status_id = $request->input('status_id');
        $this->employees->salary = $request->input('salary');

        $this->employees->save();
        return response()->json('Success');
    }

    public function getEmployeesPaginated($request, $limit = 10, $offset = 0)
    {
        $response = [];
        $model = $this->employees;

        $total = $model->count();

        if ($request->has('pagination.perpage')) {
            $limit = $request->get('pagination')['perpage'];
        }

        if ($request->has('pagination.page')) {
            $offset = $request->get('pagination')['page'];
            $offset = $offset - 1;
            $offset = $offset * $limit;
        }

        $pages = $model->count();

        $data = $model->skip($offset)->take($limit)->get();

        $page = $request->get('pagination')['page'];	
        if(count($data)==0){
            $page = "1";
            $offset = 0;
            $data = $model->skip($offset)->take($limit)->get();
        }

        if ($request->has('sort.sort')) {
            $isSortDecending = true;
            if ($request->get('sort')['sort'] == 'asc') {
                $isSortDecending = false;
            }
            $data = $data->sortBy($request->get('sort')['field'], SORT_REGULAR, $isSortDecending);
        }

        $data = $this->reIndexCollection($data);

        $meta = [
            'page' => $page,
            'pages' => $pages,
            'perpage' => $limit,
            'total' => $total,
        ];
        $response['meta'] = $meta;
        $response['data'] = $data;

        return $response;
    }

    private function reIndexCollection(Collection $collections)
    {
        $response = [];
        foreach ($collections as $collection) {
            $response[] = $collection;
        }

        return $response;
    }
}
