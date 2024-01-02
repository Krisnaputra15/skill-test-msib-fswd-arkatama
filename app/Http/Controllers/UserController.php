<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('index', [
            'users' => $users
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'data' => 'required|string',
        ]);
        if($validator->fails()){
            return redirect()->route('user.index')->with('error', $validator->errors()->first());
        }

        $data = explode(' ', $request->data);
        
        $ageNumIndex = array_keys(array_intersect($data, array_filter($data, function ($value) {
            return preg_match('/\d/', $value);
        })));
        $containsThNext = strtolower($data[$ageNumIndex[0] + 1]) == "th" || strtolower($data[$ageNumIndex[0] + 1]) == "thn" || strtolower($data[$ageNumIndex[0] + 1]) == "tahun";
        $name = '';
        $age = 0;
        $city = '';
        $skippedIndex = '';
        for ($i = 0; $i < count($data); $i++) {
            if($skippedIndex == $i){
                continue;
            }
            else if ($i < $ageNumIndex[0]) {
                $name .= "{$data[$i]} ";
            }
            else if ($i == $ageNumIndex[0]) {
                $age = preg_replace("/[^0-9]/", "", $data[$i]);
                if($containsThNext){
                    $skippedIndex = $i+1;
                } 
            }
            else {
                $city .= "{$data[$i]} ";
            }
        }

        try{
            $user = User::create([
                'NAME' => strtoupper($name),
                'AGE' => $age,
                'CITY' => strtoupper($city),
                'CREATED_AT' => now()
            ]);
            return redirect()->route('user.index')->with('success', 'berhasil menambahkan data');
        } catch(\Exception $e){
            return redirect()->route('user.index')->with('error',$e->getMessage());
        }

    }

    public function checkContains(string $string, array $check){
        foreach($check as $value){
            if(str_contains($string, $value)){
                return true;
            }
        }
        return false;
    }
}
