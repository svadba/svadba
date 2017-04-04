<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\Advert_stat;
use App\Advert_categor;
use App\Cit;
use App\Allow_type;

use App\Constat;
use App\Contype;

use App\Role_user;
use App\Http\Requests;

class AddRoleController extends Controller
{
    public function index()
    {
        
        
        Role::create([
            'name' => 'Администратор',
            'name_eng' => 'admin',
        ]);
        
        Role::create([
            'name' => 'Администратор блога',
            'name_eng' => 'blogAdmin',
        ]);
        
        Role::create([
            'name' => 'Менеджер объявлений',
            'name_eng' => 'adManager',
        ]);
        
        Role::create([
            'name' => 'Менеджер заявок',
            'name_eng' => 'requestManager',
        ]);
        
        Role::create([
            'name' => 'Пользователь',
            'name_eng' => 'Contractor',
        ]);
        
        Allow_type::create([
            'name' => 'Опубликовано',
        ]);
        
        Allow_type::create([
            'name' => 'Не опубликовано',
        ]);
        
        Advert_stat::create([
            'name' => 'Активно',
        ]);
        
        Advert_stat::create([
            'name' => 'Не активно',
        ]);
        
        Advert_categor::create([
            'name' => 'Певец',
            'name_eng' => 'Singer',
        ]);
        
        Advert_categor::create([
            'name' => 'Водитель',
            'name_eng' => 'Carer',
        ]);
        
        Advert_categor::create([
            'name' => 'Танцор',
            'name_eng' => 'Dancer',
        ]);
        
        Cit::create([
            'name' => 'Астана',
            'name_eng' => 'Astana',
        ]);
        
        Cit::create([
            'name' => 'Павлодар',
            'name_eng' => 'Pavlodar',
        ]);
        
        Cit::create([
            'name' => 'Алмата',
            'name_eng' => 'Almaty',
        ]);
        
        Constat::create([
            'name' => 'Активен',
        ]);
        
        Constat::create([
            'name' => 'Не активен',
        ]);
        
        Contype::create([
            'name' => 'Basic',
        ]);
        
        Contype::create([
            'name' => 'Premium',
        ]);
        
        Contype::create([
            'name' => 'Gold',
        ]);
       
        Role_user::create([
            'user_id' => '1',
            'role_id' => '1',
        ]);
    
    }
}
