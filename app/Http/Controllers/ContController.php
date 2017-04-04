<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contype;
use App\Contractor;
use App\Http\Requests;

class ContController extends Controller
{   

    
    public function my(Request $request)
    {   
        
        $contractors = $request->user()->contractors()->with('phones')->with('adverts')->get();
        return View('contractor.contractors', ['contractors' => $contractors]);
    }
    
    public function all()
    {   
        $contractors = Contractor::with('phones')->with('adverts')->get();
        return View('contractor.contractors', ['contractors' => $contractors]);
    }
    
    public function add()
    {   
        $contypes = Contype::all();
        return View('contractor.add_cont', ['contypes' => $contypes]);
    }
    
    
    
    public function save(Request $request){
        
        $this->validate($request, [
            'name' => 'required|max:100',
            'surname' => 'max:100',
            'middlename' => 'max:100',
            'birthday' => 'max:10',
            'email' => 'required|email|max:255|unique:contractors',
            'address' => 'max:100',
            'phone' => 'required|max:12',
            'contype' => 'required|numeric|max:3',
        ]);
        
        $add_contractor = $request->user()->contractors()->create([
            'name' => $request->name,
            'surname' => $request->surname,
            'middlename' => $request->middlename,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'email' => $request->email,
            'allow_type_id' => 2,
            'constat_id' => 2,
            'contype_id' => $request->contype,
        ]);
                
        $add_phone = Contractor::find($add_contractor->id)->phones()->create([
            'name' => 'Main',
            'phone' => $request->phone,
            'contractor_id' => $add_contractor->id
        ]);
        
        return redirect('/contractors/my');
    }
    
    public function delete(Request $request, Contractor $contractor)
    {
        $this->authorize('delete', $contractor);
        $contractor->delete();
        return redirect('/contractors/my');
    }
}
