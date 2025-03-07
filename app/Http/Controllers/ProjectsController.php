<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ds;
use App\Models\aams;
use App\Models\Cust;
use App\Models\ppms;
use App\Models\vendors;
use App\Models\projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects=projects::all();
       return view('dashboard.projects.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ds=ds::all();
        $custs=Cust::all();
        $aams=aams::all();
        $ppms=ppms::all();
        $vendors=vendors::all();
        return view('dashboard.projects.addpro',compact('ds','custs','aams','ppms', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { $data = $request->except(['po_attachment','epo_attachment']);


        if($request->hasFile('po_attachment')){ 
            $file = $request->file('po_attachment');
            $path = $file->store('uploads',[
                'disk' => 'public'
            ]);

            $data['po_attachment'] = $path;
        }

        if($request->hasFile('epo_attachment')){ 
            $file = $request->file('epo_attachment');
            $path = $file->store('uploads',[
                'disk' => 'public'
            ]);
            $data['epo_attachment'] = $path;
        }
        
      
      
     $project = projects::create(  $data);
     
        session()->flash('Add', 'Registration successful.');
        return redirect('/project');
   }
        
        
        
  

    /**
     * Display the specified resource.
     */
    public function show(Request $request ,projects $projects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        try{
            $project = projects::findOrFail($id);
        }catch(Exception $e){
            return redirect('/project')->with('error', 'Record not found!');
        }

        $ds=ds::where('id','<>',$id)->get();
        $custs=Cust::where('id','<>',$id)->get();
        $aams=aams::where('id','<>',$id)->get();
        $ppms=ppms::where('id','<>',$id)->get();
        $vendors=vendors::where('id','<>',$id)->get();

return view('dashboard.projects.edit',compact('project','ds','custs','aams','ppms', 'vendors'));


    }

    /**
     * Update the specified resource in storage.
     */
  

    public function update(Request $request, $id)
{    $project = projects::find($id);

$old_po_attachment = $project->po_attachment;
$old_epo_attachment = $project->epo_attachment;
    $data = $request->except(['po_attachment','epo_attachment']);


        if($request->hasFile('po_attachment')){ 
            $file = $request->file('po_attachment');
            $path = $file->store('uploads',[
                'disk' => 'public'
            ]);

            $data['po_attachment'] = $path;
        }

        if($request->hasFile('epo_attachment')){ 
            $file = $request->file('epo_attachment');
            $path = $file->store('uploads',[
                'disk' => 'public'
            ]);

            $data['epo_attachment'] = $path;
        }
        if($old_po_attachment && isset($data['po_attachment'])){
            Storage::disk('public')->delete($old_po_attachment);
        }
        if($old_epo_attachment && isset($data['epo_attachment'])){
            Storage::disk('public')->delete($old_epo_attachment);
        }
    $project->update($data);
    session()->flash('Edit', 'Update successful.');
    return redirect('/project');
}


    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     $project = projects::findOrFail($id);
    //     $project->delete();

    //     return redirect()->back()->with('success', 'Project deleted successfully!');
    // }
    public function destroy(Request $request)
    {
        $id=$request->id;
        projects::find($id)->delete();
        session()->flash('delete', 'Deleted successfully!');
             return redirect('/project');
    }

// public function getprojects ($id){
//     $projects = DB::table('projects')->where('project_id', $id)->pluck("project_name","id");
//     return json_encode($projects);
// }

}
// namespace App\Http\Controllers;

// use Exception;
// use App\Models\ds;
// use App\Models\aams;
// use App\Models\Cust;
// use App\Models\ppms;
// use App\Models\vendors;
// use App\Models\projects;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth;

// class ProjectsController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         $projects=projects::all();
//        return view('dashboard.projects.index',compact('projects'));
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         $ds=ds::all();
//         $custs=Cust::all();
//         $aams=aams::all();
//         $ppms=ppms::all();
//         $vendors=vendors::all();
//         return view('dashboard.projects.addpro',compact('ds','custs','aams','ppms', 'vendors'));
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {

      
//      $project = projects::create(  $request->all());
     
//         session()->flash('Add', 'Registration successful.');
//         return redirect('/project');
//    }
        
        
        
  

//     /**
//      * Display the specified resource.
//      */
//     public function show(Request $request ,projects $projects)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit($id)
//     {
        
//         try{
//             $project = projects::findOrFail($id);
//         }catch(Exception $e){
//             return redirect('/project')->with('error', 'Record not found!');
//         }

//         $ds=ds::where('id','<>',$id)->get();
//         $custs=Cust::where('id','<>',$id)->get();
//         $aams=aams::where('id','<>',$id)->get();
//         $ppms=ppms::where('id','<>',$id)->get();
//         $vendors=vendors::where('id','<>',$id)->get();

// return view('dashboard.projects.edit',compact('project','ds','custs','aams','ppms', 'vendors'));


//     }

//     /**
//      * Update the specified resource in storage.
//      */
  

//     public function update(Request $request, $id)
// {

//     $project = projects::find($id);
//     $project->update($request->all());
//     session()->flash('Edit', 'Update successful.');
//     return redirect('/project');
// }


//     /**
//      * Remove the specified resource from storage.
//      */
//     // public function destroy($id)
//     // {
//     //     $project = projects::findOrFail($id);
//     //     $project->delete();

//     //     return redirect()->back()->with('success', 'Project deleted successfully!');
//     // }
//     public function destroy(Request $request)
//     {
//         $id=$request->id;
//         projects::find($id)->delete();
//         session()->flash('delete', 'Deleted successfully!');
//              return redirect('/project');
//     }

// // public function getprojects ($id){
// //     $projects = DB::table('projects')->where('project_id', $id)->pluck("project_name","id");
// //     return json_encode($projects);
// // }

// }
