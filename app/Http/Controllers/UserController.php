<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        
        return view ('user.index', compact('users'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'                => 'required',
                'surname'             => 'required',
                'registration_number' => 'required|unique:users',
                'password'            => 'required',
                'role_id'             => 'required',
            ],
            [
                'name.required'                => 'Ad alanı boş bırakılamaz.',
                'surname.required'             => 'Soyad alanı boş bırakılamaz.',
                'password.required'            => 'Parola alanı boş bırakılamaz.',
                'registration_number.required' => 'Kullanıcı adı alanı boş bırakılamaz.',
                'registration_number.unique'   => 'Bu kullanıcı adı daha önce oluşturulmuş.',
                'role_id.required'             => 'Kullanıcı türü boş bırakılamaz.',
            ]
        );
        
        User::create([
            'registration_number' => $request->registration_number,
            'password'            => Hash::make($request->password),
            'name'                => $request->name,
            'surname'             => $request->surname,
            'role_id'             => $request->role_id
        ]);
        
        return redirect('/user')
                ->with('success', 'Kullanıcı oluşturma işlemi başarılı bir şekilde gerçekleştirildi.');
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
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                'registration_number' => 'required',
                'name'                => 'required',
                'surname'             => 'required',
                'role_id'             => 'required',
            ],
            [
                'registration_number.required' => 'Kullanıcı adı alanı boş bırakılamaz.',
                'name.required'                => 'Ad alanı boş bırakılamaz.',
                'surname.required'             => 'Soyad alanı boş bırakılamaz.',
                'role_id.required'             => 'Kullanıcı türü boş bırakılamaz.',
            ]
        );

        if ($request->password) {
            $user->update([
                'registration_number' => $request->registration_number,
                'password'            => Hash::make($request->password),
                'name'                => $request->name,
                'surname'             => $request->surname,
                'role_id'             => $request->role_id
            ]);
        } else {
            $user->update(
                $request->only(['registration_number', 'name', 'surname', 'role_id'])
            ); 
        }
              
        
        return redirect('/user')
                ->with('success', 'Kullanıcı güncelleme işlemi başarılı bir şekilde gerçekleştirildi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/user')
                ->with('success', 'Kullanıcı silme işlemi başarılı bir şekilde gerçekleştirildi.');
    }
}
