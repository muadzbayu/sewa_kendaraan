<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = DB::SELECT("select                
                cu.id,
                nama_customer ,
                id_kendaraan ,
                to_char(tanggal_mulai_sewa, 'YYYY-MM-DD') as tanggal_mulai_sewa ,
                to_char(tanggal_selesai_sewa, 'YYYY-MM-DD') as tanggal_selesai_sewa ,                
                to_char(cu.created_at, 'YYYY-MM-DD') as created_at ,
                harga_sewa,
                no_plat
            from
                public.customers cu
            left join
                public.kendaraan ke
            on cu.id_kendaraan = ke.id"); 
        
        $noPlat = DB::SELECT("select
                *
            from
                public.kendaraan
            ");

        return view('customer', [
            'customer' => $customer,
            'no_plat' => $noPlat
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('customer_barang.create');
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
            'nama_customer' => 'required',
            'tanggal_mulai_sewa' => 'required',
            'tanggal_selesai_sewa' => 'required',
            'harga_sewa' => 'required',
            'no_kendaraan' => 'required'
        ]);

        $dataStore = [
            'nama_customer' => $request->nama_customer,
            'tanggal_mulai_sewa' => $request->tanggal_mulai_sewa,
            'tanggal_selesai_sewa' => $request->tanggal_selesai_sewa,
            'harga_sewa' => $request->harga_sewa,
            'id_kendaraan' => $request->no_kendaraan
        ];

        $result = Customer::create($dataStore);

        if($result){
            //redirect dengan pesan sukses
            return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('customer.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
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
    public function edit(Request $request, $id)
    {
        $result = Customer::where('id', $id)->first();
        return view('customer.edit', compact('result'));
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
            'nama_customer' => 'required',
            'tanggal_mulai_sewa' => 'required',
            'tanggal_selesai_sewa' => 'required',
            'harga_sewa' => 'required',
            'no_kendaraan' => 'required'
        ]);

        $result = Customer::where('id',$id);

        $dataUpdate = [
            'nama_customer' => $request->nama_customer,
            'tanggal_mulai_sewa' => $request->tanggal_mulai_sewa,
            'tanggal_selesai_sewa' => $request->tanggal_selesai_sewa,
            'harga_sewa' => $request->harga_sewa
        ];

        $result->update($dataUpdate);


        if($result){
            //redirect dengan pesan sukses
            return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('customer.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $result = Customer::where('id',$id);
        $result->delete();
        if($result){
            //redirect dengan pesan sukses
            return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('customer.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
