<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use App\Cars;
use DataTables;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.car.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Cars();
        $get_type = DB::table('Type_cars')->pluck('type','id');
        return view('modules.car.form', compact('get_type', 'model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'id_type' => 'required|integer|max:100'
        ]);

        $model = Cars::create($request->all());

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Cars::findOrFail($id);
        return view('modules.car.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Cars::findOrFail($id);
        $get_type = DB::table('Type_cars')->pluck('type','id');;
        return view('modules.car.form', compact('get_type', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255' . $id
        ]);

        $model = Cars::findOrFail($id);

        $model->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Cars::findOrFail($id);
        $model->delete();
       
    }

    public function dataTable()
    {
        $model = DB::table('cars')
        ->join('type_cars', 'cars.id_type', '=', 'type_cars.id')
        ->select('cars.*', 'type_cars.type')
        ->get();
        return DataTables::of($model)
        ->addColumn('action', function ($model) {
            return view('layouts._action', [
                'model' => $model,
                'url_show' => route('cars.show', $model->id),
                'url_edit' => route('cars.edit', $model->id),
                'url_destroy' => route('cars.destroy', $model->id),
            ]);
        })
        ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
