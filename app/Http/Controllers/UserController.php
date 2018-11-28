<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Indonesia;
use App\User;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getaddess = DB::table('provinces')
        ->join('cities', 'provinces.id', '=', 'cities.province_id')
        ->join('districts', 'cities.id', '=', 'districts.city_id')
        ->join('villages', 'districts.id', '=', 'villages.district_id')
        ->get();
        return view('modules.user.index', compact('getaddess'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUserAddress(Request $request){
        
        $data = array();
        $prov = DB::table('provinces')->get();
        foreach($prov as $getIdprov)
                {
                    
                    $kab = DB::table('provinces')
                            ->join('cities', 'provinces.id', '=', 'cities.province_id')
                            ->select('cities.id As id_kab', 'cities.name as kab')
                            ->where('provinces.id', '=', $getIdprov->id)
                            ->get();
                    foreach($kab as $getIdkab)
                    {
                        $kec = DB::table('cities')
                                ->join('districts', 'cities.id', '=', 'districts.city_id')
                                ->select('districts.id As id_kec', 'districts.name As kec')
                                ->where('cities.id', '=', $getIdkab->id_kab)
                                ->get();
                               
                        foreach($kec as $getIdKec)
                        {
                            
                            $desa = DB::table('districts')
                                    ->join('villages', 'districts.id', '=', 'villages.district_id')
                                    ->select('villages.id As id_desa', 'villages.name As desa')
                                    ->where('districts.id', '=', $getIdKec->id_kec)
                                    ->get();
                            foreach($desa as $getIddesa)
                            {
                                $data[$getIdprov->name][$getIdkab->kab][$getIdKec->kec][] = $getIddesa->desa ;
                            }

                        }
                        
                    }
                }

                
                
                
                
        return response()->json($data);

    }
}
