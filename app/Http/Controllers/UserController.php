<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user/index', compact('users'));
    }
    public function edit($id = null)
    {

        if ($id) {
            // edit view
            $users = user::where('id', $id)->first();
            return view('user/edit')
                ->with('user', $users);
        } else {
            // add view
            return view('user/add');
            //    ->with('user', $users);
        }
    }
   

   public function insert (Request $request)
   {
         $request->validate([
              'name' => 'required',
              'email' => 'required',
              'password' => 'required'
         ]);
    
         // Hash รหัสผ่าน
         $hashedPassword = Hash::make($request->password);
    
         // บันทึกข้อมูลลงในฐานข้อมูล
         user::create([
              'name' => $request->name,
              'email' => $request->email,
              'password' => $hashedPassword
         ]);
    
         return redirect('user')
              ->with('ok', true)
              ->with('msg', 'บันทึกข้อมูลสําเร็จ');
   }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
    
        // หาข้อมูลผู้ใช้ตาม ID แล้วอัพเดทข้อมูล (ยกเว้นรหัสผ่าน)
        user::find($request->id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
    
        // Hash รหัสผ่าน
        $hashedPassword = Hash::make($request->password);
    
        // อัพเดทรหัสผ่านที่ถูก hash ลงในฐานข้อมูล
        user::find($request->id)->update([
            'password' => $hashedPassword
        ]);
    
        return redirect('user')
            ->with('ok', true)
            ->with('msg', 'แก้ไขข้อมูลสําเร็จ');
    }
    

 

    public function remove($id)
    {
        user::find($id)->delete();
        return redirect('user')
            ->with('ok', true)
            ->with('msg', 'ลบข้อมูลสําเร็จ');
    }

   
}
