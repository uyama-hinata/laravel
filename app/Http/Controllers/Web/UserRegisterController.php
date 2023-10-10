<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Rules\Hankaku;
use App\Rules\Email;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserRegisterController extends Controller
{
    /**
     * 会員登録画面を表示
     */
    public function adminRegisterUser(Request $request)
    { 
        // セッションに現在の画面場所を保存
        $request->session()->put('previous_page','register');
        return view('admin.RegisterUser');
    }
    /**
     * データを受け渡す(バリデーション)
     */
    public function adminPostUser(Request $request)
    {
        $request->validate([
            'name_sei'=>'required|max:20',
            'name_mei'=>'required|max:20',
            'nickname'=>'required|max:10',
            'gender'=>'required|in:1,2',
            'password'=>['required','min:8','max:20','confirmed',new Hankaku()],
            'email'=>['required','max:200','unique:users','email',new Email()],
        ]);
        
        $input=$request->all();
        $request->session()->put('register_input',$input);
        return redirect()->route('adminUserConfirm');
    }
    /**
     * 確認画面を表示
     */
    public function adminUserConfirm(Request $request)
    {
        // セッションから取り出す
        $input=$request->session()->get('register_input');

        return view('admin.UserConfirm',['input'=>$input]);
    }
    /**
     * 登録する
     */
    public function exeUserRegister(Request $request)
    {
        // セッションから取り出す
        $input=$request->session()->get('register_input');
        

        // 戻るボタン処理
        if($request->has('btn_back')){
        return redirect()->route('adminRegisterUser')
        ->withInput($input);
        }
        if($request->has('btn_Back')){
        return redirect()->route('adminEditerUser',['id'=>$input['id']])
        ->withInput($input);
        }

        if(session('previous_page')=='register'){
            // データベースに登録の処理
            $user=new User();
            $user->auth_code=str_pad(random_int(0,999999),6,0,STR_PAD_LEFT);
        }
        elseif(session('previous_page')=='editer'){
            // データベースに上書きの処理
            $user=User::find($input['id']); 
        }
        
        $user->name_sei=$input['name_sei'];
        $user->name_mei=$input['name_mei'];
        $user->nickname=$input['nickname'];
        $user->gender=$input['gender'];
        $user->email=$input['email'];
        if(!empty($input['password'])){
            $user->password=bcrypt($input['password']);
        }
        $user->save();
        
        // 二重登録を防ぐ
        $request->session()->regenerateToken();

        return redirect()->route('userList');
    }
    /**
     * 編集画面を表示
     */
    public function adminEditerUser($id,Request $request)
    {
        $user=User::find($id);

        // セッションに現在の画面場所を保存
        $request->session()->put('previous_page','editer');

        return view('admin.editerUser', compact('user'));
    }
    /**
     * データを受け渡す(バリデーション)
     */
    public function adminPostEditer($id,Request $request)
    {
        $user=User::find($id);

        $request->validate([
            'name_sei'=>'required|max:20',
            'name_mei'=>'required|max:20',
            'nickname'=>'required|max:10',
            'gender'=>'required|in:1,2',
            'email'=>['required','max:200',Rule::unique('users')->ignore($user->id),'email',new Email()],
        ]);

        if($request->filled('password')){
            $request->validate([
            'password'=>['min:8','max:20','confirmed',new Hankaku()],
            ]);
        }
        
        $input=$request->all();
        $request->session()->put('register_input',$input);
        return redirect()->route('adminUserConfirm');
    }
    /**
     * 詳細画面を表示
     */
    public function adminDetailUser($id,Request $request)
    {
        $user=User::find($id);

        return view('admin.detailUser', compact('user'));
    }
    /**
     * 削除処理
     */
    public function exeDeleteUser($id)
    {
        $user=User::find($id);

        // 紐づくレビューを削除
        if($user->reviews !== null){
            foreach($user->reviews as $review){
                $review->delete();
            }
        }

        $user->delete();

        return redirect()->route('userList');
    }
}