<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upangsho extends Model
{
    protected $primaryKey = 'upangsho_id';
    protected $fillable = [
        
        'degree_id', 'subject_name', 'semester','sub_code'
    ];
    
    static protected $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
	static protected $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
	
	static protected $bnm = array("জানুয়ারি","ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগষ্ট", "সেপ্টেম্নবর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর");
	static protected $enm = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
	



    public static function degreedetails($degreeidd)
    {

        $degree_name= Upangsho::where('degree_id', $degreeidd)->get();

        if(count($degree_name)>0) {

            $allsemestername = $degree_name[0]->semester;


            $data = '<div id="semesterid" style="margin: 2px;"><div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select Subject</strong></label>
                                        <div class="col-lg-10">
                                            <select class="form-control m-bot15" id="degress"name="sub_id" onchange="studentgenerate(this.value)" required>';

            $data .= '<option value="">Select Subject </option>';
            foreach ($degree_name as $deg) {

                $data .= '<option value="' . $deg->upangsho_id . '">' . $deg->subject_name . '</option>';
            }

            $data .= ' <div id="studentId" style="margin-left: 380px;">
                            </div> </div>';
            echo $data;
        }else {

            $data = '<div id="semesterid"><div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select Subject</strong></label>
                                        <div class="col-lg-10">
                                            <select class="form-control m-bot15" id="sub_id"name="sub_id" onchange="" required>';

            $data .= '<option value="">Select Subject </option>';


            $data .= '</select></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select  Semester</strong></label>
                                        <div class="col-lg-10">
                                            <select class="form-control m-bot15"  name="sub_id"  required>
        
                                                <option value="">Select Semester </option>';

            $data .= '</select></div>
                             </div></div>';
            echo $data;
        }

    }

    public static function degreedetailwithoutsem($degreeidd)
    {

        $degree_name= Upangsho::where('degree_id', $degreeidd)->get();

        if(count($degree_name)>0) {

            $allsemestername = $degree_name[0]->semester;


            $data = '<div id="semesterid" style="margin: 2px;"><div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select Subject</strong></label>
                                        <div class="col-lg-10">
                                            <select class="form-control m-bot15" id="degress"name="sub_id" onchange="studentgenerate(this.value)" required>';

            $data .= '<option value="">Select Subject </option>';
            foreach ($degree_name as $deg) {

                $data .= '<option value="' . $deg->upangsho_id . '">' . $deg->subject_name . '</option>';
            }


            $data .= '</select></div></div></div>';
            echo $data;
        }else {

            $data = '<div id="semesterid"><div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select Subject</strong></label>
                                        <div class="col-lg-10">
                                            <select class="form-control m-bot15" id="sub_id"name="sub_id" onchange="get_courese(this.value)" required>';

            $data .= '<option value="">Select Subject </option>';


            $data .= '</select></div></div></div>';
            echo $data;
        }

    }

    public  static function getsemesterdetails($subject_id){

        $degree_name= Upangsho::where('upangsho_id', $subject_id)->get();

        $data = '<option value="">Select Subject </option>';
        foreach ($degree_name as $deg) {

            $data .= '<option value="' . $deg->upangsho_id . '">' . $deg->semester .' semester </option>';
        }
        echo $data;
    }

    public static function degreedetailswithsemester($degreeidd)
    {

        $degree_name= Upangsho::where('degree_id', $degreeidd)->get();

        if(count($degree_name)>0) {

            $allsemestername = $degree_name[0]->semester;


            $data = '<div id="semesterid" style="margin: 2px;"><div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select Subject</strong></label>
                                        <div class="col-lg-10">
                                            <select class="form-control m-bot15" id="degress"name="sub_id" onchange="studentgenerate(this.value)" required>';

            $data .= '<option value="">Select Subject </option>';
            foreach ($degree_name as $deg) {

                $data .= '<option value="' . $deg->upangsho_id . '">' . $deg->subject_name . '</option>';
            }


            $data .= '</select></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select  Semester</strong></label>
                                        <div class="col-lg-10">
                                            <select class="form-control m-bot15"  name="sem_id" onchange="get_courese(this.value)" required>
        
                                                <option value="">Select Semester </option>';

            $semestname = ["","st", "nd", "rd", "th", "th", "th","th","th","th"];
            for ($i = 1; $i <= $allsemestername; $i++) {

                $data .= '<option value="'. $i . $semestname[$i].'">' . $i . $semestname[$i].'</option>';

            }


            $data .= '</select></div>
                             </div> <div id="studentId" style="margin-left: 380px;">
                            </div> </div>';
            echo $data;
        }else {

            $data = '<div id="semesterid"><div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select Subject</strong></label>
                                        <div class="col-lg-10">
                                            <select class="form-control m-bot15" id="sub_id"name="sub_id" onchange="" required>';

            $data .= '<option value="">Select Subject </option>';


            $data .= '</select></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select  Semester</strong></label>
                                        <div class="col-lg-10">
                                            <select class="form-control m-bot15"  name="sub_id" onchange="" required>
        
                                                <option value="">Select Semester </option>';

            $data .= '</select></div>
                             </div></div>';
            echo $data;
        }

    }


}
