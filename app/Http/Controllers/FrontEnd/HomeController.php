<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Validator;
use Redirect;
use App\User;
use Hash;
use Mail;
use Auth;
use Kordy\Ticketit\Models\Setting;
use Kordy\Ticketit\Models\Agent;

class HomeController extends Controller
{
    public function homePage(){
        $data = array(
            'title'=>'Home'
        );
        return View::make('front_end.home')->with($data);
    }

    public function addDoctor(){
          $validation_rule = array(
            'nombre'            => array('required', 'between:3,12'),
            'apellido_1'        => array('required'),
            'apellido_2'        => array(''),
            'nidno'             => array('required'),
            'sexo'              => array('required'),
            'movil'             => array('required'),
            'email'             => array('required','email','unique:users'),
            'password'          => array('required','between:5,20'),
            'repeat_password'   => array('required','min:6', 'same:password')
          );

          $validation = Validator::make(Input::all(), $validation_rule);
          if($validation -> fails()){
              return Redirect::to('/consultas-admin/agent/create')
                            ->withInput()
                            ->withErrors($validation,'doctor');
          }else{
                //Insert data into db
                $doctorInfo = array(
                    'name'          => Input::get('nombre'),
                    'l_name_1'      => Input::get('apellido_1'),
                    'l_name_2'      => Input::get('apellido_2'),
                    'username'      => Input::get('email'),
                    'email'         => Input::get('email'),
                    'password'      => Hash :: make(Input::get('password')),
                    'nid'           => Input::get('nidno'),
                    'doctor_reg_id' => Input::get('medical_reg_no'),
                    'gender'        => Input::get('sexo'),
                    'mobile'        => Input::get('movil'),
                    'role'          => 'doctor',
                    'status'        => 1,
                    'mailconfiorm'  => 0,
                    'ticketit_agent'=> true
                );

                $doctor_id = User::createDoctor($doctorInfo);

                //Assign categories and units
                $this->syncAgentCategories($doctor_id, Input::get('agent_cats'));

                //Send a mail to the Doctor
                $data = array(
                   'id'  => $doctor_id,
                   'name' => Input::get('doctor_name')
                );

                Mail::send('emails.email_conformation', $data, function ($message) {
                    //$message->from('segundaopinioncemtro@segundaopinioncemtro.com', 'Clinicacemtro');
                    $message->subject('Confirmación de email para segunda opinión');
                    $message->to(Input::get('email'));
                });

                //Session::flash('status', trans('ticketit::lang.agents-are-added-to-agents', ['names' => $agents_names]));

                return redirect()->action('\Kordy\Ticketit\Controllers\AgentsController@index');
              // Redriect to a new page with Email chacking massege.
            return Redirect::to('/consultas-admin/agent/create');
          }
    }

    /**
     * Sync Agent categories with the selected categories got from update form.
     *
     * @param $id
     * @param Request $request
     */
    public function syncAgentCategories($id, $categories)
    {
        $form_cats = ($categories == null) ? [] : $categories;
        $agent = Agent::find($id);
        $agent->categories()->sync($form_cats);
    }

    public function registrationSuccessMassege(){
        $data = array(
            'title'=>'Registro satisfactorio'
        );
        return View::make('front_end.pages.reg_success_massege')->with($data);
    }


    public function confiormEmail($id){
        User::confiormDoctorEmail($id);
        $user = User::find($id);
        $data = array(
            'title'=>'Registro satisfactorio',
        );
        Mail::send('emails.emailconfiorm_to_admin', $data, function ($message) {
                $message->from(Setting::grab('email.notify_to'), 'Clinica Cemtro');
                $message->subject('Dirección de email verificada');
                $message->to(Setting::grab('email.notify_to'));
        });
        Session::put('success_message', 'La dirección de email se ha confirmado correctamente');
        //$athentication = Auth::attempt(array('username' => $user->username, 'password' => $user->password, 'mailconfiorm'=> 1 ));
        return Redirect::to('consultas')->with($data);
        // Update doctor table and confiorm accordin to this id;
    }

    public function addPatient(){
          $validation_rule = array(
            'nombre'            => array('required', 'between:2,12'),
            'apellido_1'          => array('required'),
            'apellido_2'          => array(''),
            'day_birth'         => array('required', 'numeric', 'min:1','max:31'),
            'month_birth'       => array('required', 'numeric', 'min:1','max:12'),
            'year_birth'        => array('required', 'numeric', 'min:1910'),
            'edad'               => array('required', 'numeric', 'min:16'),
            'sexo'            => array('required'),
            'nidno'             => array('required'),
            'movil'             => array('required','between:5,10'),
            'email'             => array('required','email','unique:users'),
            'password'          => array('required','min:6'),
            'repeat_password'   => array('required','min:6', 'same:password'),
          );

          $validation = Validator::make(Input::all(), $validation_rule);
          if($validation->fails()){
              return Redirect::back()
                            ->withInput()
                            ->withErrors($validation,'patient');
          } else {
              $patientInfo = array(
                'name'          => Input::get('nombre'),
                'l_name_1'      => Input::get('apellido_1'),
                'l_name_2'      => Input::get('apellido_2'),
                'username'      => Input::get('email'),
                'email'         => Input::get('email'),
                'gender'        => Input::get('sexo'),
                'password'      => Hash :: make(Input::get('password')),
                'nid'           => Input::get('nidno'),
                'birthdate'     => Input::get('year_birth').'-'.Input::get('month_birth').'-'.Input::get('day_birth'),
                'mobile'        => Input::get('movil'),
                'role'          => 'patient',
                'status'        => 1,
                'mailconfiorm'  => 0
              );
              $patient_id = User::createPatient($patientInfo);
              //Send a mail to the Patient
              $data = array(
                'id'  => $patient_id,
                'name' => Input::get('f_name').' '.Input::get('l_name_1').' '.Input::get('l_name_2')
              );

              Mail::send('emails.email_conformation', $data, function ($message) {
                    $message->from('segundaopinioncemtro@segundaopinioncemtro.com', 'Clínica CEMTRO');
                    $message->subject('Confirmación de email para Clínica CEMTRO');
                    $message->to(Input::get('email'));
              });


              Session::put('condiciones', 1);
              Session::put('success_message', 'Se ha enviado un correo de activación para tu cuenta');

              return $this->registrationSuccessMassege();
          }
    }

    public function updateDoctor(){
          $validation_rule = array(
            'f_name'            => array('required', 'between:2,12'),
            'l_name_1'          => array('required'),
            'l_name_2'          => array(''),
            'gender'            => array('required'),
            'nidno'             => array('required'),
            'doctor_reg_id'     => array('required'),
            'movil'             => array('required','between:5,10'),
            'email'             => array('required','email')
          );

          $validation = Validator::make(Input::all(), $validation_rule);
          if($validation->fails()){
              return Redirect::back()
                    ->withInput()
                    ->withErrors($validation,'doctor');
          } else {
              $patientInfo = array(
                'id'            => Input::get('id'),
                'name'          => Input::get('f_name'),
                'l_name_1'      => Input::get('l_name_1'),
                'l_name_2'      => Input::get('l_name_2'),
                'username'      => Input::get('email'),
                'email'         => Input::get('email'),
                'gender'        => Input::get('gender'),
                'nid'           => Input::get('nidno'),
                'doctor_reg_id' => Input::get('doctor_reg_id'),
                'mobile'        => Input::get('movil')
              );
              $patient_id = User::updateDoctor($patientInfo);
              //Send a mail to the Doctor
              $data = array(
                'id'  => $patient_id,
                'name' => Input::get('f_name').' '.Input::get('l_name_1').' '.Input::get('l_name_2')
              );

              /*Mail::send('emails.email_conformation', $data, function ($message) {
                    $message->from('segundaopinioncemtro@segundaopinioncemtro.com', 'Clínica CEMTRO');
                    $message->subject('Actualización de los datos del paciente '.Input::get('f_name').' '.Input::get('l_name_1').' '.Input::get('l_name_2'));
                    $message->to(Input::get('email'));
              });*/

              return Redirect::back();
          }
    }

    public function updatePatient(){
          $validation_rule = array(
            'f_name'            => array('required', 'between:2,12'),
            'l_name_1'          => array('required'),
            'l_name_2'          => array(''),
            'gender'            => array('required'),
            'nidno'             => array('required'),
            'movil'             => array('required','between:5,10'),
            'email'             => array('required','email')
          );

          $validation = Validator::make(Input::all(), $validation_rule);
          if($validation->fails()){
              return Redirect::back()
                    ->withInput()
                    ->withErrors($validation,'patient');
          } else {
              $patientInfo = array(
                'id'            => Input::get('id'),
                'name'          => Input::get('f_name'),
                'l_name_1'      => Input::get('l_name_1'),
                'l_name_2'      => Input::get('l_name_2'),
                'username'      => Input::get('email'),
                'email'         => Input::get('email'),
                'gender'        => Input::get('gender'),
                'nid'           => Input::get('nidno'),
                'mobile'        => Input::get('movil')
              );
              $patient_id = User::updatePatient($patientInfo);
              //Send a mail to the Doctor
              $data = array(
                'id'  => $patient_id,
                'name' => Input::get('f_name').' '.Input::get('l_name_1').' '.Input::get('l_name_2')
              );

              /*Mail::send('emails.email_conformation', $data, function ($message) {
                    $message->from('segundaopinioncemtro@segundaopinioncemtro.com', 'Clínica CEMTRO');
                    $message->subject('Actualización de los datos del paciente '.Input::get('f_name').' '.Input::get('l_name_1').' '.Input::get('l_name_2'));
                    $message->to(Input::get('email'));
              });*/

              return Redirect::back();
          }
    }

    // Cookies details page
    public function cookie_policy(){
        $data = array(
            'title'=>'Cookies policy'
        );
        return View::make('front_end.pages.more_details.cookies_policy')->with($data);
    }

    // Doctors details page
    public function doctorRegDetail(){
        $data = array(
            'title'=>'Doctor registration Details'
        );
        return View::make('front_end.pages.more_details.about_doctor_registration')->with($data);

    }

    //Doctor singup form

    public function signUpDoctor(){
        $data = array(
            'title'=>'Doctor SignUp Form'
        );
        return View::make('front_end.pages.form.doctor_sign_up_form')->with($data);
    }


    // Patients details page
    public function patientRegDetail(){
        $data = array(
            'title'=>'Patient registration Details'
        );
        return View::make('front_end.pages.more_details.about_patient_registration')->with($data);

    }

    //Patient Sign upForm

    public function signUpPatient(){
        $data = array(
            'title'=>'Patient Sing Up Form'
        );
        return View::make('front_end.pages.form.patient_sign_up_form')->with($data);
    }

    //Patient Accept Conditions

    public function acceptConditions(){
        if (Session::has('condiciones')) {
            $data = array(
                'title'=>'Patient Sing Up Form'
            );
            return View::make('front_end.pages.form.patient_sign_up_form')->with($data);
        }
        else {
            $data = array(
                'title'=>'Accept Conditions'
            );
            return View::make('front_end.pages.form.accept_conditions_form')->with($data);
        }
    }

    //Patient Accept Conditions

    public function conditionsAccepted(){
        $validation_rule = array(
            'condiciones'        => array('required')
        );

        $validation = Validator::make(Input::all(), $validation_rule);
        if($validation->fails()){
            return Redirect::to('acceptConditions')
                        ->withInput()
                        ->withErrors($validation,'condiciones');
        } else {
            Session::put('condiciones', 1);
            return $this->signUpPatient();
        }
    }


    // Join Page

    public function joinPage(){
         $data = array(
            'title'=>'Join Details'
        );
        return View::make('front_end.pages.more_details.join_page')->with($data);
    }

    public function signIn(){
        $data = array(
            'title'=>'Sing In'
        );
        return View::make('front_end.pages.form.sign_in_form')->with($data);
    }



//
}
