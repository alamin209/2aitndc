<div id="detsilsregistation">
    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">
            <strong>Registration fee </strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control" placeholder=" Registration fee fo non du student " id="nonduereg" value="{{ $subjectcode->nonduereg }}"
                   name="nonduereg" required>

        </div>
    </div>
    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Exam fee *</strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control" placeholder="Give waiver in % " id="examfee"
                   name="examfee" value="{{ $subjectcode->examfee }}" required>

        </div>
    </div>

    <input type="hidden" value="{{ $subjectcode->id }}" name="master_id">

    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Transcript*</strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control" placeholder=" Transcript "
                   id="transcript" name="transcript" value="{{ $subjectcode->transcript }}" required>

        </div>
    </div>

    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Exam entry fee*</strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control" placeholder=" Exam entry fee " id="examentry" value="{{ $subjectcode->examentry }}"
                   name="examentry" required>
        </div>
    </div>

    <div class="form-group">
        <label for="inputSuccess"
               class="col-sm-2 control-label col-lg-2 lab"><strong>Admission fee*</strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control" placeholder="Admission fee  " id="admission"
                   value="{{ $subjectcode->admission }}" name="admission" required>
        </div>
    </div>
 
     <div class="form-group">
        <label for="inputSuccess"
               class="col-sm-2 control-label col-lg-2 lab"><strong>Tuition fee for whole course*</strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control" placeholder="Whole tuition Fee " id="admission"
                   value="{{ $subjectcode->whole_tuition }}" name="whole_tuition" required>
        </div>
    </div>
 


    
       <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Session Charge
                *</strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control" placeholder=" Session Charge "  value="{{ $subjectcode->session_charge  }}" id="session_charge "
                   name="session_charge" required>
        </div>
    </div>
    

    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Computer Lab fee
                *</strong></label>
        <div class="col-lg-10">
            <input type="trxt" class="form-control" placeholder="Computer Lab fee" value="{{ $subjectcode->com_lab_fee }}"
                   id="com_lab_fee" name="com_lab_fee" required>
        </div>
    </div>

    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Exam centre fee
                *</strong></label>
        <div class="col-lg-10">
            <input type="trxt" class="form-control" placeholder="Exam centre fee" value="{{ $subjectcode->exam_center_fee }}"
                   id="exam_center_fee" name="exam_center_fee" required>
        </div>
    </div>
    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Library fee
             </strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control" placeholder="Library fee " id="library_fee" value="{{ $subjectcode->library_fee }}"
                   name="library_fee" required>

        </div>
    </div>
    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>ID card
                *</strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control" placeholder="ID card Fee " id="idcard" value="{{ $subjectcode->idcard }}"name="idcard" required>

        </div>
    </div>

    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Misc.*</strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control" placeholder=" Misc. fee " value="{{ $subjectcode->misc }}"
                   id="misc" name="misc" required>

        </div>
    </div>

    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Library caution money *</strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control" placeholder=" Library caution money " value="{{ $subjectcode->libarycosion_money }}"
                   id="libarycosion_money" name="libarycosion_money" required>

        </div>
    </div>
</div>

