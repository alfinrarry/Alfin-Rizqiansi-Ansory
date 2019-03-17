<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris=Category::all();
        return view('kategori.index',compact('kategoris'));      
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
        return view('kategori.create');
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
            
            'category_name' => 'required',
            'remarks' => 'required',
            'tglInput'=> 'required'
        ]);
        $kategoris = new Category([
            'category_name' => $request->get('category_name'),
            'remarks'=> $request->get('remarks'),
            'tglInput'=> $request->get('tglInput')
          ]);
          $kategoris->save();
      

        return redirec('kategori.index')->with('message', 'Data Berhasil Di Tambahkan');
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
        $kategoris = Category::find($id);

        return view('kategori.edit', compact('kategoris'));
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
            'category_id'=> 'required',
            'category_name' => 'required',
            'remarks' => 'required',
            'tglInput'=> 'required'
        ]);

        $kategoris = Category::findOrFail($id)->update($request->all());

        return redirect()->route('kategori.index')->with('message', 'Data Berhasil di Ubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategoris = Category::findOrFail($id)->delete();
        return redirect()->route('kategori.index')->with('message', 'Data berhasil dihapus!');
    }
}
