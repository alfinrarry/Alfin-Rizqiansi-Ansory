<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris = DB::table('categories')->get();
        return view('kategori.index',['kategoris'=>$kategoris]);    
        
    }

    public function search(Request $request)
    {
        $search= $request->search;
        $kategoris=Category::where('category_name','like',"%".$search."%")->paginate(); 
       

        return view('kategori.index',compact('kategoris'));     
    } 

    public function pagination(Request $request)
    {
        $pagination= $request->pagination;
        $kategoris=Category::where('category_name','like',"%".$search."%")->pagination(); 
       
        $pagination->appends($request->only('keyword'));
        return view('kategori.index',compact('kategoris'));     
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('categories')->insert([
            'category_id' => $request->category_id,
            'category_name' => $request->category_name,
            'remarks' => $request->remarks,
            'tglInput' => $request->tglInput
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect('/kategori')->with('message', 'Data Berhasil Di Tambahkan');
      

        
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
        $kategoris = DB::table('categories')->where('category_id',$id)->get();
        return view('/kategori/edit',['kategoris' => $kategoris]);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::table('categories')->where('category_id',$request->id)->update([
            'category_id'=> $request->category_name,
            'category_name' => $request->category_name,
            'remarks' => $request->remarks,
            'tglInput'=> $request->tglInput
        ]);

      

        return redirect('/kategori')->with('message', 'Data Berhasil Di Tambahkan');   
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('categories')->where('category_id',$id)->delete();
        return redirect('/kategori')->with('message', 'Data berhasil dihapus!');
        
    }
}
