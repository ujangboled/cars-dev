<?php

namespace App\Http\Controllers;
use App\User;
use DataTables;
use App\Type_cars;
use Illuminate\Http\Request;

class TypeCarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Type_cars();
        return view('modules.type.form', compact('model'));
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
            'type' => 'required|string|max:255'
        ]);
        // $model = Type_cars::create([
        //     'type' => $request['type']
        //     ]);
        $model = new Type_cars();
        $model->type = $request['type'];
        $model->save();
        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type_cars  $type_cars
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Type_cars::findOrFail($id);
        return view('modules.type.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type_cars  $type_cars
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Type_cars::findOrFail($id);
        return view('modules.type.form', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type_cars  $type_cars
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type' => 'required|string|max:10'
        ]);

        $model = Type_cars::findOrFail($id);
        $model->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type_cars  $type_cars
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Type_cars::findOrFail($id);
        $model->delete();
    }

    public function dataTable()
    {
        $model = Type_cars::query();
        return DataTables::of($model)
        ->addColumn('action', function ($model) {
            return view('layouts._action', [
                'model' => $model,
                'url_show' => route('type.show', $model->id),
                'url_edit' => route('type.edit', $model->id),
                'url_destroy' => route('type.destroy', $model->id),
            ]);
        })
        ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
