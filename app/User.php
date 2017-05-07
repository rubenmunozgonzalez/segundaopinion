<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use DB;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['*'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    static function createDoctor($doctorInfo){         
       $doctor_id = DB::table('users')->insertGetId($doctorInfo);
       return $doctor_id;
    }
    
    static function createPatient($patientInfo){         
       $patient_id = DB::table('users')->insertGetId($patientInfo);
       return $patient_id;
    }
    
    static function updatePatient($patientInfo){         
       $ret = DB::table('users')->where('id', $patientInfo['id'])->update($patientInfo);
       return $ret;
    }
    
    static function updateDoctor($doctorInfo){         
       $ret = DB::table('users')->where('id', $doctorInfo['id'])->update($doctorInfo);
       return $ret;
    }
    
    static function confiormDoctorEmail($id){
        DB::table('users')
            ->where('id', $id)
            ->update(['mailconfiorm' => 1]);
    }
    
    static function confiormPatientEmail($id){
        DB::table('users')
            ->where('id', $id)
            ->update(['mailconfiorm' => 1]);
    }
    
}
