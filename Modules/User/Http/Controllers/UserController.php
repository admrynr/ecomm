<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Guzzle;
use DataTables;
use App\User;
use App\Role;
use App\UserRole;
use App\Http\Models\UserLevel;



class UserController extends Controller
{
    //view page
    public function index()
    {
        $title = 'User Management';
        $levels = UserLevel::all();
        //$user = User::where('level', '!=',1)->with('userLevels')->first();
        //dd($user->userLevels->name);

        return view('user::index')->withTitle($title)->withLevels($levels);
    }

    //get data fot DataTable
    public function data(Request $request)
    {
        if ($request->filter == 'all')
        $user = User::where('level', '!=',1)->with('userLevels');
        else if($request->filter == 'active')
        $user = User::where('level', '!=',1)->where('is_verified',1)->with('userLevels');
        else if($request->filter == 'deactive')
        $user = User::where('level', '!=',1)->where('is_verified',0)->with('userLevels');
        else
        $user = User::onlyTrashed()->where('level', '!=',1)->with('userLevels');
        
        return DataTables::eloquent($user)
                ->addColumn('userLevels', function (User $user) {
                    return $user->userLevels->name;
                })
                ->toJson();
        //return datatables::of($user)->make(true);
    }

    public function setReseller($id)
    {
        $model = User::findOrFail($id);
        $model->level = 3;

        if(!$model->update()){
            $data = [
                'status' => 2,
                'message' => 'Fail Approve Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Approve Data'
            ];
        }

        return json_encode($data);

    }

    public function setMitra($id)
    {
        $model = User::findOrFail($id);
        $model->level = 2;

        if(!$model->update()){
            $data = [
                'status' => 2,
                'message' => 'Fail Approve Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Approve Data'
            ];
        }

        return json_encode($data);

    }

    //store data
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'digits:12', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->level = $request->level;
        //
        $user->password = \Hash::make($request->password);
        $user->is_verified = 0;

        $user->save();
        
        $data = [
            'status' => 1,
            'message' => 'Success Update Data'
        ];

        return json_encode($data);
    }

    //get data for Edit
    public function edit($id, Request $request)
    {
        $data = User::where('id', $id)->first();

        return json_encode($data);
    }

    //update data
    public function update($id, Request $request)
    {
        
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = $request->password;
        $user->level = $request->level;

        if(!$user->update()){
            $data = [
                'status' => 2,
                'message' => 'Fail Update Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Update Data'
            ];
        }


        return json_encode($data);

    }

    //approve data
    public function approve($id, Request $request)
    {
        $model = User::findOrFail($id);
        $model->is_verified = 1;

        if(!$model->update()){
            $data = [
                'status' => 2,
                'message' => 'Fail Approve Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Approve Data'
            ];
        }

        return json_encode($data);
    }

    //decline data
    public function decline($id, Request $request)
    {
        $model = User::findOrFail($id);
        $model->is_verified = 0;

        if(!$model->update()){
            $data = [
                'status' => 2,
                'message' => 'Fail Update Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Update Data'
            ];
        }

        return json_encode($data);
    }

    //delete data
    public function destroy($id, Request $request)
    {
        $user = User::where('id', $id);
        $user->delete();

        if(!$user->delete()){
            $data = [
                'status' => 2,
                'message' => 'Fail Update Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Update Data'
            ];
        }

        return json_encode($data);
    }

    //bulk data
    public function bulk($data, Request $request)
    {
        $datas = explode(',',$request->id);
        foreach($datas as $key){
            if($data == 'trash')
            $bulk = User::where('id',$key)->delete();
            else if($data == 'restore')
            $bulk = User::where('id',$key)->restore();
            else 
            $bulk = User::where('id',$key)->forcedelete();
        }
        
        $data = [
            'status' => 1,
            'message' => 'Success Update Data'
        ];

        return json_encode($data);
    }

    //get info data
    public function info(Request $request)
    {
        $model = User::where('level', '!=',1)->get();

        $active = User::where('level', '!=',1)->where('is_verified',1)->count();
        $deactive = User::where('level', '!=',1)->where('is_verified',0)->count();;
        $total = $model->count();
        $trashed = User::onlyTrashed()->where('level', '!=',1)->count();

        $info = [
            'total' => $total,
            'active' => $active,
            'deactive' => $deactive,
            'trashed' => $trashed
        ];

        return json_encode($info);
    }

    //profil 
    public function profil()
    {
        $user = User::findOrFail(Auth::user()->id);
        // $instansi = Instansi::get();
        $title = 'PROFIL';
        return view('user::profil')->withData($user)->withTitle($title);
    }

    public function updateprofil(Request $request)
    {
        $user = User::findOrFail($request->id);
        
        if($request->new_password != NULL){
            if($request->new_password == $request->confirm_password)
            {
                $user->username = $request->username;
                $user->phone = $request->phone;
                $user->password = \Hash::make($request->new_password);
                $user->save();

                $data = [
                    'status' => 1,
                    'message' => 'Success Update Data'
                ];

                return \Redirect::back()->with('status', 'Data Update Success');
            } else {
                $data = [
                    'status' => 2,
                    'message' => 'Fail Update Data'
                ];
                return \Redirect::back()->with('danger', 'Your Password Confirmation is Incorrect');
            }
        } else {
            $user->username = $request->username;
            $user->phone = $request->phone;
            $user->save();

            $data = [
                'status' => '1',
                'message' => 'Success Update Data'
            ];

            return \Redirect::back()->with('status', 'Data Update Success');
        }       
    }

    public function updateprofilpic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required|file|max:100000000',
        ]);

        if ($validator->fails()){
            $data = [
                'status' => 2,
                'message' => 'Fail Update Data'
            ];

            return json_encode($data);
        }else{
            $foto = Storage::disk('sftp')->put('foto', $request->file('foto'));
            if ($foto) {
                $model = User::findOrFail($request->id);
                $model->image = $foto;
                $model->update();
                $request->session()->regenerate();
                $data = [
                    'status' => 1,
                    'message' => 'Success Update Data'
                ];
                return json_encode($data);
            }else{
                $data = [
                    'status' => 2,
                    'message' => 'Fail Update Data'
                ];
                return json_encode($data);
            }
        }
    }

    public function deletepic(Request $request)
    {
        $model = User::findOrFail($request->id);
        $model->image = null;
        $model->update();
        $request->session()->regenerate();
        $data = [
            'status' => 1,
            'message' => 'Success Update Data'
        ];
        return redirect()->route('profil.index');
    }

}
