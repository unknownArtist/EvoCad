<?php namespace Orchestra\Foundation\Routing;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Orchestra\Support\Facades\Messages;
use Orchestra\Support\Facades\Site;
use Orchestra\Model\User;
use Orchestra\Foundation\Validation\Auth as AuthValidator;

class CredentialController extends AdminController
{
    /**
     * Authentication/credential Controller routing.
     *
     * @param \Orchestra\Foundation\Validation\Auth $validator
     */
    public function __construct(AuthValidator $validator)
    {
        $this->validator = $validator;

        parent::__construct();
    }

    /**
     * Setup controller filters.
     *
     * @return void
     */
    protected function setupFilters()
    {
        $this->beforeFilter('orchestra.guest', array(
            'only' => array(
                'getLogin', 'postLogin',
            ),
        ));

        $this->beforeFilter('orchestra.csrf', array('only' => array('postLogin')));
    }

    /**
     * Login Page
     *
     * GET (:orchestra)/login
     *
     * @return Response
     */
    public function getLogin()
    {
        Site::set('title', trans("orchestra/foundation::title.login"));

        return View::make('orchestra/foundation::credential.login');
    }

    /**
     * POST Login
     *
     * POST (:orchestra)/login
     *
     * @return Response
     */
    public function postLogin()
    {
        $input      = Input::all();
        $validation = $this->validator->on('login')->with($input);

        // Validate user login, if any errors is found redirect it back to
        // login page with the errors.
        if ($validation->fails()) {
            return Redirect::to(handles('orchestra::login'))
                    ->withInput()
                    ->withErrors($validation);
        }

        if ($this->authenticate($input)) {
            Messages::add('success', trans('orchestra/foundation::response.credential.logged-in'));

            return Redirect::intended(handles('orchestra::/'));
        }

        Messages::add('error', trans('orchestra/foundation::response.credential.invalid-combination'));

        return Redirect::to(handles('orchestra::login'))->withInput();
    }

    /**
     * Logout the user
     *
     * DELETE (:bundle)/login
     *
     * @return Response
     */
    public function deleteLogin()
    {
        Auth::logout();
        Messages::add('success', trans('orchestra/foundation::response.credential.logged-out'));

        $intended = 'orchestra::login';

        is_null($redirect = Input::get('redirect')) or $intended = $redirect;

        return Redirect::intended(handles($intended));
    }

    /**
     * Authenticate the user.
     *
     * @param  array    $input
     * @return boolean
     */
    protected function authenticate($input)
    {
        $data = array(
            'email'    => $input['email'],
            'password' => $input['password'],
        );

        $remember = (isset($input['remember']) and $input['remember'] === 'yes');

        // We should now attempt to login the user using Auth class. If this
        // failed simply return false.
        if (! Auth::attempt($data, $remember)) {
            return false;
        }

        $user = Auth::user();

        // Verify user account if has not been verified, other this should
        // be ignored in most cases.
        if ((int) $user->status === User::UNVERIFIED) {
            $user->status = User::VERIFIED;
            $user->save();
        }

        return true;
    }
}
