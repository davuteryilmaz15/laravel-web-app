<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::paginate(10);

        return view('admin.user_index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);

        return view('admin.user_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required|max:21',
            'email' => 'required|email|unique:users,email,' . $id, //users tablosundaki email colonuna bakacak, $id ilebelirtilen kayıt hariç tutulacak
            'password' => !empty($request->password) ? 'required|min:6' : '',
        ]);

        DB::beginTransaction();
        try {
            $user = User::find($id);

            $user->name = $request->name;
            $user->email = $request->email;

            $user->password = !empty($request->password) ? bcrypt($request->password) : $user->password;

            $user->save();

            DB::table('role_user')->where('user_id', $id)->delete();
            $yeni_roller = [];
            foreach ($request->roles as $role){
                array_push($yeni_roller, ['role_id' => $role, 'user_id' => $id]);
            }
            DB::table('role_user')->insert($yeni_roller);

            Session::flash('status', 1);
            DB::commit();
        } catch (\Exception $e) {
            Session::flash('status', 0);
            DB::rollBack();
        }

        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
        DB::beginTransaction();
        try{
            //Kullanıcıyı sil
            User::destroy($id);

            //Kullanıcının rollerini sil
            DB::table('role_user')->where('user_id', $id)->delete();

            Session::flash('status', 1);
            DB::commit();
        } catch (\Exception $e){
            Session::flash('status', 0);
            DB::rollback();
        }

        return redirect('/user');
    }
}
