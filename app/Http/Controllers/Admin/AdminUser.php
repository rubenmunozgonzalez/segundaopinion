<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Validator;
use View;
use Hash;
use Redirect;
use App\User;
use Mail;


class AdminUser extends Controller {


    //Admin login Form
    public function loginForm() {
        $data = array(
            'title' => 'Login Page'
        );
        return view::make('admin.pages.login_form')->with($data);
    }

    //Admin login Form
    public function adminForgotPassword() {
        $data = array(
            'title' => 'He olvidado mi contraseña'
        );
        return view::make('admin.pages.forgot_password')->with($data);
    }



    // Admin Login Check
    public function adminLoginCheck() {

        $validation_rule = [
            'username' => array('required', 'min:3', 'max:50'),
            'password' => array('required', 'min:6', 'max:50')
        ];

        $validation = Validator::make(Input::all(), $validation_rule);

        if ($validation->fails()) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors($validation);
        } else {
            $athentication = Auth::attempt(array('username' => Input :: get('username'), 'password' => Input :: get('password'), 'status' => 1,'mailconfiorm'=> 1 ));
            if ($athentication) {
                session()->pull('success_message');
                $rememberme = Input::get('remember');
                if (!empty($rememberme)) {
                    //Remember Login data
                    Auth::loginUsingId(Auth::user()->id, true);
                }
                $role = Auth::user()->role;
                switch ($role) {
                    case 'admin':
                        return Redirect::intended('admin/dashboard');
                        break;
                    case 'doctor':
                        return Redirect::intended('consultas-admin');
                        break;
                    case 'patient':
                        return Redirect::intended('consultas');
                        break;
                    default :
                        return Redirect::intended('adminDashboard');

                }

            }  else {//Athentication End
                return Redirect::to('/consultas/login')->withInput()->with('authentication_error', '¡Nombre de usuario o contraseña incorrectas!');
            }
        }
    }

    // Admin Login Check
    public function adminForgotPass() {

        $validation_rule = [
            'username' => array('required', 'exists:users,username'),
        ];

        $validation = Validator::make(Input::all(), $validation_rule);

        if ($validation->fails()) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors($validation);
        } else {

            $user = User::where('username', Input :: get('username'))->first();
            if ($user) {
                $data = ['username' => Input::get('username'), 'password' => $user->password];

                Mail::send('emails.email_password', $data, function ($message) use ($user) {
                        //$message->from('segundaopinioncemtro@segundaopinioncemtro.com', 'Clinicacemtro');
                        $message->subject('Contraseña segunda opinión de Clínica CEMTRO');
                        $message->to($user->email);
                });
                return view::make('front_end.pages.password_sent_massege')->with($data);
            }
            /*else {
                return view::make('front_end.pages.password_sent_massege')->with($data);
            }*/
        }
    }

    //Admin login Form
    public function adminChangePassword() {
        $data = array(
            'title' => 'Cambiar mi contraseña',
            'username' => Input::get('username')
        );
        return view::make('admin.pages.change_password')->with($data);
    }

    // Admin Login Check
    public function adminChangePass() {

        $validation_rule = [
            'username' => array('required', 'min:3', 'max:50'),
            'password'          => array('required','between:5,20'),
            'repeat_password'   => array('required','min:6', 'same:password')
        ];

        $validation = Validator::make(Input::all(), $validation_rule);

        if ($validation->fails()) {
            return redirect()->back()
                            ->withInput()
                            ->with('authentication_error', '¡Las contraseñas no coinciden!');
        } else {

            $user = User::where('username', Input :: get('username'))->first();

            $data = ['username' => Input::get('username'), 'password' => $user->password];
            $user->mailconfiorm = 1;
            $user->password = Hash :: make(Input::get('password'));
            $user->save();
            /*Mail::send('emails.email_password', $data, function ($message) use ($user) {
                    //$message->from('segundaopinioncemtro@segundaopinioncemtro.com', 'Clinicacemtro');
                    $message->subject('Contraseña cambiada con éxito');
                    $message->to($user->email);
            });*/


            /*$athentication = Auth::attempt(array('username' => Input :: get('username'), 'password' => Input :: get('password'), 'status' => 1,'mailconfiorm'=> 1 ));
            if ($athentication) {
                $rememberme = Input::get('remember');
                if (!empty($rememberme)) {
                    //Remember Login data
                    Auth::loginUsingId(Auth::user()->id, true);
                }
                $role = Auth::user()->role;
                switch ($role) {
                    case 'admin':
                        return Redirect::intended('adminDashboard');
                        break;
                    case 'doctor':
                        return Redirect::intended('consultas-admin');
                        break;
                    case 'patient':
                        return Redirect::intended('consultas');
                        break;
                    default :
                        return Redirect::intended('adminDashboard');

                }

            }  else {//Athentication End

            }*/
            return Redirect::to('/consultas/login')->withInput()->with('authentication_error', '¡Contraseña cambiada con éxito!');
        }
    }

    //Log Out
    public function getLogOut(){
        Auth::logout();
        return redirect('/');
    }


    // Admin Dashboard
    public function adminDashboard(){

        $data = array(
            'title' => 'Admin Dashboard'
        );

        return View::make('admin.pages.admin_dashboard')->with($data);
    }




    //Doctor's Dashboard
    public function doctorDashboard(){
       $data = array(
            'title' => 'Doctor Dashboard'
        );

        return View::make('admin.pages.doctor_dashboard')->with($data);
    }


    //Patient's Dashboard

    public function patientDashboard(){
        $data = array(
            'title' => 'Patient Dashboard'
        );

        return View::make('admin.pages.patient_dashboard')->with($data);
    }

}
