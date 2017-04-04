<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DB;
Use Illuminate\Support\Facades\Storage;
use App\Contractor;
use App\Advert;
use App\Advert_cit;
use App\Cit;
use App\Advert_categor;
use App\Http\Requests;

class AdvertController extends Controller
{
    
    
    public function my(Request $request)
    {   
        $cities = Cit::all();
        $categories = Advert_categor::all();
        $city = ($request->has('city')) ? $request->city : '';
        $category = ($request->has('category')) ? $request->category : '';
        IF($request->has('sort'))
        {
            switch($request->sort)
            {
                case 'created': $sort = 'created_at'; break;
                case 'published': $sort = 'published_at'; break;
                default : $sort = 'created_at'; break;
            }
        }
        {
            $sort = 'created_at';
        }
      
        
        $adverts = Advert::with('advert_cits')->with('advert_categor')->with('advert_stat')
                ->where('user_id', $request->user()->id )
                ->when($category, function($query) use ($category){
                    return $query->where('advert_categor_id', '=', $category);
                })
                ->when($city, function($q) use ($city){
                    return $q->whereExists(function($q) use ($city){
                        $q->select('cit_id','advert_id')->from('advert_cits')->whereRaw('advert_cits.advert_id = adverts.id')->where('cit_id', '=', $city);
                    });
                })
                ->orderBy($sort, 'desc')
                ->get()
                ;
         
        //DB::table('adverts')->whereExists
         
        return View('advert.adverts_my', ['adverts' => $adverts, 'cities' => $cities, 'categories' => $categories]);
    }
    
    
    public function all(Request $request)
    {   
        $cities = Cit::all();
        $categories = Advert_categor::all();
        $city = ($request->has('city')) ? $request->city : '';
        $category = ($request->has('category')) ? $request->category : '';
        IF($request->has('sort'))
        {
            switch($request->sort)
            {
                case 'created': $sort = 'created_at'; break;
                case 'published': $sort = 'published_at'; break;
                default : $sort = 'created_at'; break;
            }
        }
        {
            $sort = 'created_at';
        }
        
        $adverts = Advert::with('advert_cits')
                ->when($category, function($query) use ($category){
                    return $query->where('advert_categor_id', '=', $category);
                })
                ->when($city, function($q) use ($city){
                    return $q->whereExists(function($q) use ($city){
                        $q->select('cit_id','advert_id')->from('advert_cits')->whereRaw('advert_cits.advert_id = adverts.id')->where('cit_id', '=', $city);
                    });
                })
                ->orderBy($sort, 'desc')
                ->get()
                ;
                
        return View('advert.adverts_all', ['adverts' => $adverts, 'cities' => $cities, 'categories' => $categories]);
    }
    
    
    public function add(Request $request, Contractor $contractor)
    {   
        $adv_cats = Advert_categor::all();
        return View('advert.add_adv', ['adv_cats' => $adv_cats, 'contr' => $contractor]);
    }
    
    
    public function save(Request $request)
    {
        $this->validate($request, [
            'contractor_id' => 'required|numeric',
            'name' => 'required|max:100',
            'description' => 'max:100',
            'adv_cat' => 'required|numeric|max:3',
            'photos' => 'array|image',
            'videos' => 'array|active_url',
            
        ]);
        
        $contractor = Contractor::findOrFail($request->contractor_id);
        
        $add_advert = $contractor->adverts()->create([
            'name' => $request->name,
            'description' => $request->description,
            'rating' => 0,
            'views' => 0,
            'allow_type_id' => 2,
            'advert_categor_id' => $request->adv_cat,
            'advert_stat_id' => 2,
            'contractor_id' => $request->contractor_id,
            'user_id' => $request->user()->id,
            'publicshed_at' => time(),
        ]);
        
        $createStorage::makeDirectory('upload/adverts/'.$add_advert)->make;
        
        
        IF($request->hasFile('photos'))
        {
            FOREACH($request->file('photos') as $photo):
                
                IF($photo->isValid())
                {
                    $photo->move($directory, $name)
                }
                
            ENDFOREACH;
        }
                
        return redirect('/contractors/my');
    }
    
    public function delete(Request $request, Contractor $contractor)
    {
        return redirect('/');
    }
}
/*
        $adverts = $request->user()
                ->with(['adverts' => function($q) use($category, $city, $sort){
                    $q->where(
                        'advert_categor_id', '=' , $category
                    );
                    $q->with(['advert_cits' => function ($q)use ($city){
                        $q->where('cit_id', '=',$city);
                    }]);
                    $q->with('advert_categor');
                    $q->with('advert_type');
                    $q->orderBy($sort, 'desc');}])
                ->get(); 
        
        $adverts = DB::table('adverts')
                ->join('advert_cits', 'adverts.id' ,'=', 'advert_cits.advert_id')
                ->where('user_id', '=', $request->user()->id)
                ->get();
        
        $adverts_cit = Advert_cit::with(['advert' => function($q) use ($category){
            $q->where('advert_categor_id','=', '1');
        }])->where('cit_id', '=', '')->get();
        */