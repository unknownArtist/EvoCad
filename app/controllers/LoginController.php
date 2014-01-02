<?php

class LoginController extends BaseController
{
    public function login($provider){
        if(!Auth::check()){
            $providers = explode('|',Setting::get('providers.listing'));
            if(!in_array($provider, $providers)){
                Orchestra\Messages::add('error','Using this Provider'.$provider.' is Prohibited');
                return Redirect::to('/admin/login');
            }

        try{
        $config = Config::get('providers');
        $hybridauth = new Hybrid_Auth( $config );
        $adapter = $hybridauth->authenticate( $provider );
        $user_profile = $adapter->getUserProfile();
        }
        catch(Exception $e) {
            // dd($e);
            Orchestra\Messages::add('error',$e->getMessage());
            return Redirect::to('/admin/login');
        }
        $oauths = Oauth::all();
        $uid = Oauth::where('uid','=',$user_profile->identifier)->where('provider','=',$provider)->first();
            if($uid !== null){
                Auth::loginUsingId($uid->user_id, '60');
            }
            else {
                return Redirect::to('register/'.$provider);
            }
        }
        return Redirect::to('/login');
    }

    public function register($provider){
        $providers = explode('|',Setting::get('providers.listing'));
        if(!in_array($provider, $providers)){
            Orchestra\Messages::add('error','Using this Provider'.$provider.' is Prohibited');
            return Redirect::to('/admin');
        }
        try{
        $config = Config::get('providers');
        $hybridauth = new Hybrid_Auth( $config );
        $adapter = $hybridauth->authenticate($provider);
        if(Auth::check()){
            $user = Auth::user();
            $userid=$user->id;
            $uid=$adapter->getUserProfile()->identifier;
            $userprovider=Oauth::where('provider','=',$provider)
            ->where('uid','=',$uid)->first();
            if($userprovider == null){
                // dd($uid);
                Oauth::create([
                              'provider'=>$provider,
                              'pid'=>0,
                              'uid'=>$uid,
                              'user_id'=>$userid
                              ]);
                Orchestra\Messages::add('success','Your '.$provider
                                        .' Account Has been linked
                                        to the Account. Now you can use
                                        '.$provider.' Login Button');
                return Redirect::to('/login');
            } else {
                Orchestra\Messages::add('error','This '.$provider
                                        .' Account Already Associated 
                                        to another Account.');
                return Redirect::to('/login');
            }
        } elseif($provider !== 'Twitter'){
            // dd($provider);
            $user_profile = $adapter->getUserProfile();
            $uidchecker = Oauth::where('uid','=',$user_profile->identifier)->where('provider','=',$provider)->first();
            if($uidchecker !== null){
                Auth::loginUsingId($uidchecker->user_id, 15);
                return Redirect::to('/login');
            } else{
                $user = User::where('email','=',$user_profile->email)->first();
                if($user !== null){
                    Orchestra\Messages::add('error','This '.$provider
                                        .' Account cannot be Associated. 
                                        Please login with your credentials 
                                        or use another Provider to login First.');
                    return Redirect::to('/login');
                }
            }
            $register['email']=$user_profile->email;
            $register['fullname']=$user_profile->firstName.' '.$user_profile->lastName;
            $input = $register;
            $password = Str::random(5);

            $user = App::make('orchestra.user');

            $user->email    = $input['email'];
            $user->fullname = $input['fullname'];
            $user->password = $password;


            DB::transaction(function () use ($user) {
                $user->save();
                $user->roles()->sync(array(
                                     Config::get('orchestra/foundation::roles.member', 2)
                                     ));
            });
            $user = User::where('email','=',$input['email'])->first();
            $userid = $user->id;
            $uid = $user_profile->identifier;
            Oauth::create([
                          'provider'=>$provider,
                          'pid'=>0,
                          'uid'=>$uid,
                          'user_id'=>$userid
                          ]);

            Orchestra\Messages::add('success', trans("orchestra/foundation::response.users.create"));
            $memory = Orchestra\Memory::make();
            $site   = $memory->get('site.name', 'Orchestra Platform');
            $data   = array(
                            'password' => $password,
                            'site'     => $site,
                            'user'     => (object) $user->toArray(),
                            );

            $callback = function ($mail) use ($data, $user, $site) {
                $mail->subject(trans('orchestra/foundation::email.credential.register', array('site' => $site)));
                $mail->to($user->email, $user->fullname);
            };

            $sent = Mail::send('orchestra/foundation::email.credential.register', $data, $callback);

            if (count($sent) > 0 or true === $memory->get('email.queue', false)) {
                Orchestra\Messages::add('success', trans('orchestra/foundation::response.credential.register.email-send'));
            } else {
                Orchestra\Messages::add('error', trans('orchestra/foundation::response.credential.register.email-fail'));
            }

            return Redirect::intended(handles('orchestra::login'));
        } else {
            Orchestra\Messages::add('error',trans('social.provider_not_allowed',array('provider'=>$provider)));
            return Redirect::intended(handles('orchestra::login'));
        }
        }
        catch (Exception $e){
            Orchestra\Messages::add('error',$e->getMessage());
            return Redirect::to('admin');
        }
    }

    public function unlinkProvider($provider){
        $oauth =  Oauth::where('provider','=',$provider)->where('user_id','=',Auth::user()->id)->first();
        if($oauth !== null){
        $oauth->delete();
        }
        return Redirect::to('/admin');
    }
}