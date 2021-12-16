<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;
use DataTable;
use Auth;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


       if ($request->ajax()) {
            $staffs=Staff::get();
            return DataTable::of($staffs)->addIndexColumn()->make(true);
         }
        return view('staff.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff=new Staff();
        return view('staff.create',compact('staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required|unique:staffs,name',
            'email' => 'required|unique:staffs,email',
            'password'=>'required'
            
        ]);

        $staff=Staff::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'dob'=>$request->dob,
            'phone'=>$request->phone,
            'address'=>$request->fulladdress
        ]);


       $staffdata= $staff->assignRole('staff');
       // dd($staffdata);
       $permissions=$staffdata->roles[0]->permissions->pluck('name')->toArray();
       // dd($permissions);
        $staff->syncPermissions($permissions);

        
        return redirect()->route('staff.index');
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

        $staff=Staff::find($id);
        
        return view('staff.create',compact('staff'));
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
        //dd($request);
        $staff=Staff::find($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',       
        ]);

        if($request->password){
           $staff->password= Hash::make($request->password);
        }

        $staff->name=$request->name;
        $staff->email=$request->email;
        $staff->dob=$request->dob;
        $staff->phone=$request->phone;
        $staff->address=$request->address;
        $staff->save();
         $staff->syncPermissions($request->get('permission'));
        return redirect()->route('staff.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd(Auth::staff());
        //dd(Auth::guard('staff')->user()->name);
        $staff=Staff::find($id);
        $staff->delete();
        return response()->json(['status'=>200,'msg'=>'success']);
    }
}
