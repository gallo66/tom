<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Person;
use App\Models\Errors;
use App\Rules\Login_same;
use App\Rules\pass_same;
use App\Rules\Login_new;
use App\Rules\pass_new;
use App\Rules\Login_update;
use App\Models\Content;
use App\Models\Comment;
use App\Models\History;
use App\Models\Recommend;
use App\Models\Good;
use DateTime;

class Ka2Controller extends Controller
{

    public function index(Request $request){    
       
        $num = $request->index;            
        $icon_name = [];

        $userLogin = null;
        if($request->session()->has('user')){
            $userLogin = $request->session()->get('user');

            $icon = $userLogin->icon;

            if($icon < 7){
                if(preg_match('/^[a-zA-Z0-9]+$/',$userLogin->login) || preg_match('/[^!#<>:;&~@%+$"\'\*\^\(\)\[\]\|\/\.,_-]/',$userLogin->login)){
                    if(preg_match('/^[ａ-ｚＡ-Ｚ０-９]+$/',$userLogin->login)){
                        $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                    }else{
                        $icon_name = [$icon,substr($userLogin->login,0,1)];
                    }
                }else{
                    $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                }
            }else{
                    $icon_name = [$icon,$icon];
            }
        }      

        

        return view('Ka2.index',['index'=>$num,'userLogin'=>$userLogin,'icon'=>$icon_name]);
    }  

    public function login(Request $request){               

        $userLogin = null;
        $icon_name = [];

        return view('Ka2.login',['userLogin'=>$userLogin,'icon'=>$icon_name]);
    }

    public function postLogin(Request $request){

        $user = $request->user;
        $detail = null;

        if(Session::has('detail')){
            $detail = Session::get('detail');
        }
        
        $rules = [

            'login'=>['required',new Login_same()],
            'password'=>['required',new pass_same($user['login'])],
        ];

        $validator = Validator::make($request->all(),$rules,Errors::$errors);

        if($validator->fails()){
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        $user = Person::where('login',$user['login'])->first();

        $request->session()->put('user',$user);

        $icon = $user['icon'];

        if($icon < 7){
            if(preg_match('/^[a-zA-Z0-9]+$/',$user['login']) || preg_match('/[^!#<>:;&~@%+$"\'\*\^\(\)\[\]\|\/\.,_-]/',$user['login'])){

                if(preg_match('/^[ａ-ｚＡ-Ｚ０-９]+$/',$user->login)  || preg_match('/[＾！＃＜＞：；＄～＠％＋＄“”\’\＊\（\）\［\］\｜\／\．，＿ー ]/',$user->login)){
                    $icon_name = [$icon,mb_substr($user['login'],0,1)];
                }else{
                    $icon_name = [$icon,substr($user['login'],0,1)];
                }
                
            }else{
                $icon_name = [$icon,mb_substr($user['login'],0,1)];
            }
        }else{
                $icon_name = [$icon,$icon];
        }

        if($detail != null){
             return view('Ka2.detail',['userLogin'=>$user,'icon'=>$icon_name,'content'=>$detail['content'],'comments'=>$detail['comments'],'recommend'=>$detail['recommend'],'good'=>$detail['good'],'count'=>$detail['count'],'id'=>$detail['id']]);
        }

        return view('Ka2.index',['index'=>1,'userLogin'=>$user,'icon'=>$icon_name]);

    }

    public function logout(Request $request){

        $request->session()->forget('user');
      
        return view('Ka2.index',['index'=>1,'userLogin'=>null]);

    }

    public function new(Request $request){               

        $userLogin = null;

          return view('Ka2.new',['userLogin'=>$userLogin]);
    }

    public function postNew(Request $request){

        $detail = null;

        if(Session::has('detail')){
            $detail = Session::get('detail');
        }

        $user = $request->user;
        
        $rules = [

            'login'=>['required',new Login_new()],
            'mail'=>'required',
            'password'=>['required',new pass_new()],
            'repassword'=>'required|same:password',
        ];

        $validator = Validator::make($request->all(),$rules,Errors::$errors);

        if($validator->fails()){
            return redirect('/new')
                ->withErrors($validator)
                ->withInput();
        }

        $person = new Person();

        $person->fill($user)->save();

        unset($user['_token']);

        $people = Person::where('login',$user['login'])->first();

        $request->session()->put('user',$people);

        $icon = $people->icon;

            if($icon < 7){                              
                if(preg_match('/^[a-zA-Z0-9]+$/',$people->login) || preg_match('/[^!#<>:;&~@%+$"\'\*\^\(\)\[\]\|\/\.,_-]/',$people->login)){
                    if(preg_match('/^[ａ-ｚＡ-Ｚ０-９]+$/',$people->login)  || preg_match('/[＾！＃＜＞：；＄～＠％＋＄“”\’\＊\（\）\［\］\｜\／\．，＿ー ]/',$people->login)){
                        $icon_name = [$icon,mb_substr($people->login,0,1)];
                    }else{
                        $icon_name = [$icon,substr($people->login,0,1)];
                    }
                }else{
                    $icon_name = [$icon,mb_substr($people->login,0,1)];
                }
            }else{
                    $icon_name = [$icon,$icon];
            }

        if($detail != null){
            return view('Ka2.detail',['userLogin'=>$people,'icon'=>$icon_name,'content'=>$detail['content'],'comments'=>$detail['comments'],'recommend'=>$detail['recommend'],'good'=>$detail['good'],'count'=>$detail['count'],'id'=>$detail['id']]);
        }

        return view('Ka2.index',['index'=>1,'userLogin'=>$people,'icon'=>$icon_name]);

    }

    public function update(Request $request){               

        $userLogin = null;
        $icon_name = [];

        if($request->session()->has('user')){
            $userLogin = $request->session()->get('user');

            $icon = $userLogin->icon;

            if($icon < 7){
                if(preg_match('/^[a-zA-Z0-9]+$/',$userLogin->login) || preg_match('/[^!#<>:;&~@%+$"\'\*\^\(\)\[\]\|\/\.,_-]/',$userLogin->login)){
                    if(preg_match('/^[ａ-ｚＡ-Ｚ０-９]+$/',$userLogin->login)   || preg_match('/[＾！＃＜＞：；＄～＠％＋＄“”\’\＊\（\）\［\］\｜\／\．，＿ー ]/',$userLogin->login)){
                        $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                    }else{
                        $icon_name = [$icon,substr($userLogin->login,0,1)];
                    }
                }else{
                    $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                }
            }else{
                    $icon_name = [$icon,$icon];
            }
        }

        return view('Ka2.update',['userLogin'=>$userLogin,'icon'=>$icon_name]);
    }

    public function postUpdate(Request $request){

        $user = $request->user;
        $userId = $request->session()->get('user');

        
        $rules = [

            'login'=>['required',new Login_update($userId->login)],
            'mail'=>'required',
            'password'=>['required',new pass_new()],
            'repassword'=>'required|same:password',
        ];

        $validator = Validator::make($request->all(),$rules,Errors::$errors);

        if($validator->fails()){
            return redirect('/update')
                ->withErrors($validator)
                ->withInput();
        }

        $person = Person::where('login',$userId['login'])->first();
        
        unset($user['_token']);

        $person->fill($user)->save();

        $people = Person::where('login',$user['login'])->first();

        $request->session()->put('user',$people);

        $icon = $people->icon;

        if($icon < 7){
            if(preg_match('/^[a-zA-Z0-9]+$/',$people->login) || preg_match('/[^!#<>:;&~@%+$"\'\*\^\(\)\[\]\|\/\.,_-]/',$people->login)){
                if(preg_match('/^[ａ-ｚＡ-Ｚ０-９]+$/',$people->login)  || preg_match('/[＾！＃＜＞：；＄～＠％＋＄“”\’\＊\（\）\［\］\｜\／\．，＿ー ]/',$people->login)){
                    $icon_name = [$icon,mb_substr($people->login,0,1)];
                }else{
                    $icon_name = [$icon,substr($people->login,0,1)];
                }
            }else{
                $icon_name = [$icon,mb_substr($people->login,0,1)];
            }
        }else{
                $icon_name = [$icon,$icon];
        }


        return view('Ka2.index',['index'=>1,'userLogin'=>$people,'icon'=>$icon_name]);

    }

    public function user_data(Request $request){               

        $userLogin = null;
        $icon_name = [];

        if($request->session()->has('user')){
            $userLogin = $request->session()->get('user');

            $icon = $userLogin->icon;

            if($icon < 7){
                if(preg_match('/^[a-zA-Z0-9]+$/',$userLogin->login) || preg_match('/[^!#<>:;&~@%+$"\'\*\^\(\)\[\]\|\/\.,_-]/',$userLogin->login)){
                    if(preg_match('/^[ａ-ｚＡ-Ｚ０-９]+$/',$userLogin->login)   || preg_match('/[＾！＃＜＞：；＄～＠％＋＄“”\’\＊\（\）\［\］\｜\／\．，＿ー ]/',$userLogin->login)){
                        $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                    }else{
                        $icon_name = [$icon,substr($userLogin->login,0,1)];
                    }
                }else{
                    $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                }
            }else{
                    $icon_name = [$icon,$icon];
            }
        }

        return view('Ka2.user_data',['userLogin'=>$userLogin,'icon'=>$icon_name]);
    }

    public function search(Request $request){               

        $userLogin = null;
        $icon_name = [];

        if($request->session()->has('user')){
          $userLogin = $request->session()->get('user');

          $icon = $userLogin->icon;

            if($icon < 7){
                if(preg_match('/^[a-zA-Z0-9]+$/',$userLogin->login) || preg_match('/[^!#<>:;&~@%+$"\'\*\^\(\)\[\]\|\/\.,_-]/',$userLogin->login)){
                    if(preg_match('/^[ａ-ｚＡ-Ｚ０-９]+$/',$userLogin->login)  || preg_match('/[＾！＃＜＞：；＄～＠％＋＄“”\’\＊\（\）\［\］\｜\／\．，＿ー ]/',$userLogin->login)){
                        $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                    }else{
                        $icon_name = [$icon,substr($userLogin->login,0,1)];
                    }
                }else{
                    $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                }
            }else{
                    $icon_name = [$icon,$icon];
            }
      }

      $word = $request->search;
      
      if($word == null){
          return view('Ka2.index',['index'=>1,'userLogin'=>$userLogin,'ans'=>'一致する結果はありませんでした','icon'=>$icon_name]);
      }else{

        $title = null;

        $serch = Content::where('title','like','%'.$word.'%')->orWhere('comment','like','%'.$word.'%')->get();

        foreach($serch as $num){
            $title = $num->title;
        }

        if($title == null){
            return view('Ka2.index',['index'=>1,'userLogin'=>$userLogin,'ans'=>'一致する結果はありませんでした','icon'=>$icon_name]);
        }else{
            return view('Ka2.serch',['index'=>1,'userLogin'=>$userLogin,'serch'=>$serch,'word'=>$word,'icon'=>$icon_name]);
        }

      }
    }

  public function detail(Request $request){               

      $userLogin = null;
      $icon_name = [];

      if($request->session()->has('user')){
            $userLogin = $request->session()->get('user');

            $icon = $userLogin->icon;

            if($icon < 7){
                if(preg_match('/^[a-zA-Z0-9]+$/',$userLogin->login) || preg_match('/[^!#<>:;&~@%+$"\'\*\^\(\)\[\]\|\/\.,_-]/',$userLogin->login)){
                    if(preg_match('/^[ａ-ｚＡ-Ｚ０-９]+$/',$userLogin->login)  || preg_match('/[＾！＃＜＞：；＄～＠％＋＄“”\’\＊\（\）\［\］\｜\／\．，＿ー ]/',$userLogin->login)){
                        $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                    }else{
                        $icon_name = [$icon,substr($userLogin->login,0,1)];
                    }
                }else{
                    $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                }
            }else{
                    $icon_name = [$icon,$icon];
            }
      }

    $id = null;

    if(isset($request->detail)){
        $id = $request->detail;
    }elseif(isset($request->detail_new)){
        $id = $request->detail_new;
    }else{
        $id = $request->id;
    }


    $good = Good::where('content_id',$id)->get();

    $count = 0;

    if($good != null){
        foreach($good as $num){
              
              $count++;
        }
    }
  
    $content = Content::find($id);
    $comments = Comment::where('content_id',$id)->orderBy('id','desc')->get();

    $recommend = null;

    if($userLogin != null){
        $recommend = Recommend::whereRaw('person_id=? and content_id=?',[$userLogin->id,$request->id])->first();
    }

    $good = null;

    if($userLogin != null){
        $good = Good::whereRaw('person_id=? and content_id=?',[$userLogin->id,$request->id])->first();
    }

    $detail = ['userLogin'=>$userLogin,'content'=>$content,'comments'=>$comments,'recommend'=>$recommend,'good'=>$good,'count'=>$count,'icon'=>$icon_name,'id'=>$id];

    if(isset($request->detail)){
        Session::flash('detail',$detail);
        return view('Ka2.login',['userLogin'=>null,'icon'=>null]);    
    }elseif(isset($request->detail_new)){
        Session::flash('detail',$detail);
        return view('Ka2.new',['userLogin'=>null,'icon'=>null]);    
    }

    return view('Ka2.detail',$detail);

  }

  public function put(Request $request){               

    $userLogin = null;
    $icon_name = [];

    if($request->session()->has('user')){
      $userLogin = $request->session()->get('user');

      $icon = $userLogin->icon;

            if($icon < 7){
                if(preg_match('/^[a-zA-Z0-9]+$/',$userLogin->login) || preg_match('/[^!#<>:;&~@%+$"\'\*\^\(\)\[\]\|\/\.,_-]/',$userLogin->login)){
                    if(preg_match('/^[ａ-ｚＡ-Ｚ０-９]+$/',$userLogin->login)  || preg_match('/[＾！＃＜＞：；＄～＠％＋＄“”\’\＊\（\）\［\］\｜\／\．，＿ー ]/',$userLogin->login)){
                        $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                    }else{
                        $icon_name = [$icon,substr($userLogin->login,0,1)];
                    }
                }else{
                    $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                }
            }else{
                    $icon_name = [$icon,$icon];
            }
    }

    $good = Good::where('content_id',$request->id)->get();

    $count = 0;

    if($good != null){
        foreach($good as $num){
              
              $count++;
        }
    }

    $recommend = null;

    if($userLogin != null){
        $recommend = Recommend::whereRaw('person_id=? and content_id=?',[$userLogin->id,$request->id])->first();
    }

    $good = null;

    if($userLogin != null){
        $good = Good::whereRaw('person_id=? and content_id=?',[$userLogin->id,$request->id])->first();
    }

    $content = Content::find($request->id);
    $comments = Comment::where('content_id',$request->id)->orderBy('id','desc')->get();

    if($request->comment == null || $request->comment == ""){
        return view('Ka2.detail',['userLogin'=>$userLogin,'content'=>$content,'comments'=>$comments,'come'=>'コメントを入力してください','count'=>$count,'good'=>$good,'recommend'=>$recommend,'icon'=>$icon_name]);
    }

    $param = [
        'person_id'=>$userLogin->id,
        'content_id'=>$request->id,
        'comment'=>$request->comment, 
    ];

    unset($param['_token']);

    $comment = new Comment();

    $comment->fill($param)->save();

    $comments = Comment::where('content_id',$request->id)->orderBy('id','desc')->get();
   
    return view('Ka2.detail',['userLogin'=>$userLogin,'content'=>$content,'comments'=>$comments,'count'=>$count,'good'=>$good,'recommend'=>$recommend,'icon'=>$icon_name]);

  }

  public function history(Request $request){               

    $userLogin = null;
    $icon_name = [];

    if($request->session()->has('user')){
      $userLogin = $request->session()->get('user');

      $icon = $userLogin->icon;

            if($icon < 7){
                if(preg_match('/^[a-zA-Z0-9]+$/',$userLogin->login) || preg_match('/[^!#<>:;&~@%+$"\'\*\^\(\)\[\]\|\/\.,_-]/',$userLogin->login)){
                    if(preg_match('/^[ａ-ｚＡ-Ｚ０-９]+$/',$userLogin->login)  || preg_match('/[＾！＃＜＞：；＄～＠％＋＄“”\’\＊\（\）\［\］\｜\／\．，＿ー ]/',$userLogin->login)){
                        $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                    }else{
                        $icon_name = [$icon,substr($userLogin->login,0,1)];
                    }
                }else{
                    $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                }
            }else{
                    $icon_name = [$icon,$icon];
            }
    }

    $id = $userLogin->id;
    $person = null;

    $history = History::where('person_id',$id)->orderBy('id','desc')->get();   
  
    foreach($history as $num){
        $person = $num->person_id;
    }

    if($person == null){
        return view('Ka2.index',['index'=>1,'userLogin'=>$userLogin,'history_ans'=>'視聴履歴はありません','icon'=>$icon_name]);
    }else{
        return view('Ka2.history',['index'=>1,'userLogin'=>$userLogin,'history'=>$history,'icon'=>$icon_name]);
    }

  }
 

  public function recommended(Request $request){               

      $userLogin = null;
      $icon_name = [];

      if($request->session()->has('user')){
      $userLogin = $request->session()->get('user');

      $icon = $userLogin->icon;

            if($icon < 7){
                if(preg_match('/^[a-zA-Z0-9]+$/',$userLogin->login) || preg_match('/[^!#<>:;&~@%+$"\'\*\^\(\)\[\]\|\/\.,_-]/',$userLogin->login)){
                    if(preg_match('/^[ａ-ｚＡ-Ｚ０-９]+$/',$userLogin->login)  || preg_match('/[＾！＃＜＞：；＄～＠％＋＄“”\’\＊\（\）\［\］\｜\／\．，＿ー ]/',$userLogin->login)){
                        $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                    }else{
                        $icon_name = [$icon,substr($userLogin->login,0,1)];
                    }
                }else{
                    $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                }
            }else{
                    $icon_name = [$icon,$icon];
            }
      }

    $recommend =null;
    $person = null;

    if($userLogin != null){

        $id = $userLogin->id;
    
        $recommend = Recommend::where('person_id',$id)->orderBy('id','desc')->get();   
      
        foreach($recommend as $num){
            $person = $num->person_id;
        }
    }


    if($person == null){
        return view('Ka2.index',['index'=>1,'userLogin'=>$userLogin,'recommended_ans'=>'お気に入りはありません','icon'=>$icon_name]);
    }else{
        return view('Ka2.recommend',['index'=>1,'userLogin'=>$userLogin,'recommend'=>$recommend,'icon'=>$icon_name]);
    }

  }


  public function del(Request $request){    
    
    
    $userLogin = $request->session()->get('user');

    $icon = $userLogin->icon;

    if($icon < 7){
        if(preg_match('/^[a-zA-Z0-9]+$/',$userLogin->login) || preg_match('/[^!#<>:;&~@%+$"\'\*\^\(\)\[\]\|\/\.,_-]/',$userLogin->login)){
            if(preg_match('/^[ａ-ｚＡ-Ｚ０-９]+$/',$userLogin->login)  || preg_match('/[＾！＃＜＞：；＄～＠％＋＄“”\’\＊\（\）\［\］\｜\／\．，＿ー ]/',$userLogin->login)){
                $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
            }else{
                $icon_name = [$icon,substr($userLogin->login,0,1)];
            }
        }else{
            $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
        }
    }else{
            $icon_name = [$icon,$icon];
    }
    
    return view('Ka2.delete',['userLogin'=>$userLogin,'icon'=>$icon_name]);
  }

  public function delete(Request $request){    
    
    $userLogin = $request->session()->get('user');

    Person::find($userLogin->id)->delete();
    Comment::where('person_id',$userLogin->id)->delete();
    History::where('person_id',$userLogin->id)->delete();
    Recommend::where('person_id',$userLogin->id)->delete();
    Good::where('person_id',$userLogin->id)->delete(); 
    
    return view('Ka2.index',['index'=>1,'userLogin'=>null,'icon'=>null]);
  }  

  public function come_del(Request $request){               

    Comment::where('id',$request->come_id)->delete();

    $userLogin = null;
    $icon_name = [];

    if($request->session()->has('user')){
          $userLogin = $request->session()->get('user');

          $icon = $userLogin->icon;

          if($icon < 7){
              if(preg_match('/^[a-zA-Z0-9]+$/',$userLogin->login) || preg_match('/[^!#<>:;&~@%+$"\'\*\^\(\)\[\]\|\/\.,_-]/',$userLogin->login)){
                  if(preg_match('/^[ａ-ｚＡ-Ｚ０-９]+$/',$userLogin->login)  || preg_match('/[＾！＃＜＞：；＄～＠％＋＄“”\’\＊\（\）\［\］\｜\／\．，＿ー ]/',$userLogin->login)){
                      $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
                  }else{
                      $icon_name = [$icon,substr($userLogin->login,0,1)];
                  }
              }else{
                  $icon_name = [$icon,mb_substr($userLogin->login,0,1)];
              }
          }else{
                  $icon_name = [$icon,$icon];
          }
    }

  $id = null;

  if(isset($request->detail)){
      $id = $request->detail;
  }elseif(isset($request->detail_new)){
      $id = $request->detail_new;
  }else{
      $id = $request->id;
  }


  $good = Good::where('content_id',$id)->get();

  $count = 0;

  if($good != null){
      foreach($good as $num){
            
            $count++;
      }
  }

  $content = Content::find($id);
  $comments = Comment::where('content_id',$id)->orderBy('id','desc')->get();

  $recommend = null;
  

  if($userLogin != null){
      $recommend = Recommend::whereRaw('person_id=? and content_id=?',[$userLogin->id,$request->id])->first();
  }

  $good = null;

  if($userLogin != null){
      $good = Good::whereRaw('person_id=? and content_id=?',[$userLogin->id,$request->id])->first();
  }

  $detail = ['userLogin'=>$userLogin,'content'=>$content,'comments'=>$comments,'recommend'=>$recommend,'good'=>$good,'count'=>$count,'icon'=>$icon_name,'id'=>$id,'come'=>'コメントを削除しました'];

  return view('Ka2.detail',$detail);

  }

 
  public function like($id,$index,Request $request){   

    
    $userLogin = $request->session()->get('user');
 
    if($index == 0){
        $good = new Good();

        $param = [
          'person_id'=>$userLogin->id,
          'content_id'=>$id,
        ];
        
        unset($param['_token']);   
        $good->fill($param)->save();
    }else{

        $good = Good::whereRaw('person_id=? and content_id=?',[$userLogin->id,$id])->delete();
    }   
  }

  public function favorite($id,$index,Request $request){   

    
    $userLogin = $request->session()->get('user');
 
    if($index == 0){
    
        $recommend = new Recommend();

        $param = [
          'person_id'=>$userLogin->id,
          'content_id'=>$id,
        ];

        unset($param['_token']);

        $recommend->fill($param)->save();

    }else{
        Recommend::whereRaw('person_id = ? and content_id = ?',[$userLogin->id,$id])->delete();
    }   
  }


  public function history_put($id,Request $request){   

    
    $userLogin = $request->session()->get('user');
 
    
    if($userLogin != null){

        $history = new History();
    
        $param = [
            'person_id'=>$userLogin->id,
            'content_id'=>$id,
            'now_time'=>now(+9), 
        ];
    
        unset($param['_token']);
    
        $history->fill($param)->save();
    }
  }


}


