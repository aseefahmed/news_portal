<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected  $fillable = ['first_name', 'last_name', 'father_name', 'mother_name', 'email', 'religion', 'gender','contact_no_home', 'contact_no_work', 'contact_no_other',
                            'gender', 'dob', 'dob_doc', 'maritial_status', 'nationality', 'national_id_number', 'national_id_doc',
                            'blood_group', 'address_verification_doc', 'picture', 'cv', 'references', 'experiences',
                            'comments'];
}
