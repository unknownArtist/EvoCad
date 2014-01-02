<?php


Event::listen('orchestra.started: admin', function ()
{

    // Extend the form with the new fields
    Event::listen('orchestra.form: user.account', function ($model, $form)
    {
        $form->extend(function ($form)
        {
            if(Setting::get('provider.global',0)){
            $form->fieldset('Social Login', function ($fieldset)
            {
                if(Setting::get('provider.facebook',0)==1){
                $fieldset->control('input:button','Login with Facebook',function($control){
                     $control->label = 'Facebook Login';
                     $control->field = function(){
                        $providercheck = Oauth::where('user_id','=',Auth::user()->id)->where('provider','=','Facebook')->first();
                        $action = (($providercheck==null)?"register":"unlink");
                        $text = (($providercheck==null)?"Register":"Unlink");
                        return "<a class='btn btn-large' href='/$action/Facebook'>$text Facebook</a>";
                     };
                });
                }
                if(Setting::get('provider.google',0)==1){
                $fieldset->control('input:button','Login with Google +',function($control){
                    $control->label='Google + Login';
                    $control->field=function(){
                        $providercheck = Oauth::where('user_id','=',Auth::user()->id)->where('provider','=','Google')->first();
                        $action = (($providercheck==null)?"register":"unlink");
                        $text = (($providercheck==null)?"Register":"Unlink");
                        return "<a class='btn btn-large' href='/$action/Google'>$text Google+</a>";
                     };
                });
                }
                if(Setting::get('provider.twitter',0)==1 && Auth::check()){
                $fieldset->control('input:button','Login with Twitter',function($control){
                    $control->label='Twitter Login';
                    $control->field=function(){
                        $providercheck = Oauth::where('user_id','=',Auth::user()->id)->where('provider','=','Twitter')->first();
                        $action = (($providercheck==null)?"register":"unlink");
                        $text = (($providercheck==null)?"Register":"Unlink");
                        return "<a class='btn btn-large' href='/$action/Twitter'>$text Twitter</a>";
                       };
                });
                }
            });
            }
        });
    });
    Event::listen('orchestra.form: settings', function ($model, $form)
    {
        $form->extend(function($form)
        {
            $form->fieldset('Social Login',function($fieldset){
                $fieldset->control('checkbox','Enable Facebook Login',function($control){
                    $control->field=function(){
                        $checked = (Setting::get('provider.facebook',0)?'checked':'');
                        return "<input type='checkbox' name='facebooklogin' value='1' id='facebooklogin'".$checked.">";
                    };
                });
                $fieldset->control('checkbox','Enable Google Login',function($control){
                    $control->field=function(){
                        $checked = (Setting::get('provider.google',0)?'checked':'');
                        return "<input type='checkbox' name='googlelogin' value='1' id='googlelogin'".$checked.">";
                    };
                });
                $fieldset->control('checkbox','Enable Twitter Login',function($control){
                    $control->field=function(){
                        $checked = (Setting::get('provider.twitter')?'checked':'');
                        return "<input type='checkbox' name='twitterlogin' value='1' id='twitterlogin'".$checked.">";
                    };
                });
            });
        });
    });

    Event::listen('orchestra.saved: settings',function($memory,$input){
        $provider = array();
        $facebooklogin = (isset($input['facebooklogin'])?1:0);
        $provider[] = (isset($input['facebooklogin'])?'Facebook':0);
        Setting::set('provider.facebook',$facebooklogin);
        $googlelogin = (isset($input['googlelogin'])?1:0);
        $provider[] = (isset($input['googlelogin'])?'Google':0);
        Setting::set('provider.google',$googlelogin);
        $twitterlogin = (isset($input['twitterlogin'])?1:0);
        $provider[] = (isset($input['twitterlogin'])?'Twitter':0);
        Setting::set('provider.twitter',$twitterlogin);
        $globalsocial = (($twitterlogin == 0 &&  $facebooklogin==0 && $googlelogin==0)?0:1);
        $provider = implode('|', array_filter($provider));
        if($provider !== ''){
            Setting::set('providers.listing',$provider);
        }
        else {
            Setting::set('providers.listing','[A-Za-z]+');
        }
        Setting::set('provider.global',$globalsocial);
    });
});

?>