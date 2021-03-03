<?php
/**
* Tag Attendance
*/
class Attendance extends DController{
    
    public function __construct(){
        parent::__construct();
        Session::checkSession();
        $data = array();
    }

    public function addAttendance(){
        $table = "tbl_tag";
        $tagmodel = $this->load->model("TagModel");
        $data['alltags']   = $tagmodel->alltags($table);
        $data['title']   = "Listapp | Attendance";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/attendance',$data);       
        $this->load->view('admin/footer');       
    }

    public function infoAttendance(){
        $table = "tbl_tag";
        $tagmodel = $this->load->model("TagModel");
        $data['alltags']   = $tagmodel->alltags($table);
        $data['title']   = "Listapp | Attendance info.";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/infoattendance',$data);       
        $this->load->view('admin/footer');       
    }

    public function fillAttendance(){
        //table
        $table = "tbl_member";
        $tbl_tag = "tbl_tag";
        $tbl_preatn = "tbl_preatn";

        //model
        $attenModel = $this->load->model("attenModel");
        $tagmodel = $this->load->model("TagModel");

        //condition
        $tag = $_GET['tag'];   
        
        //data
        $data['title']   = "Listapp | Take Attendance";
        $data['checkAtn'] = $attenModel->checkAtnFromPreTbl($tbl_preatn);

        // foreach ($checkAtn as $key => $value) {
        //     $data['valCheck'] = $value['memberid'];
        // }


        $data['memlistbyprog'] = $attenModel->memberByProg($table,$tag);
        $data['alltags']   = $tagmodel->alltags($tbl_tag);

        $this->load->view('admin/header',$data);
        $this->load->view('admin/sidebar');       
        $this->load->view('admin/addatten',$data);      
    }

    //UserName Exsits
    public function dateChecker(){
      $input = $this->load->validation('DForm');
      $table = "tbl_attendance";
      //$input->post('date');
      $date    = $_POST['date'];

      $attenModel = $this->load->model("attenModel");
      $result = $attenModel->checkDate($table,$date);
         
        if($result)
        {
          echo 'false';
        }
        else
        {
            echo'true';
        } 
  
    }

    public function selectAttendance(){
        if (!($_POST)) {
            header("Location:".BASE_URL."/Attendance/addAttendance");
        }
        $input = $this->load->validation('DForm');

        //table
        $tbl_attendance = "tbl_attendance";
        $tbl_preatn = "tbl_preatn";

        //model
        $attenModel = $this->load->model("attenModel");

        //condition
        //$tag   = $input->values['tag'];
        $input->post('tag');
        $input->post('date');
  
        $tag   = $input->values['tag'];
        $date   = $input->values['date'];
        $attend = $_POST['attend'];


        $re   = $attenModel->tagDateExst($tbl_attendance,$date,$tag);

        if ($re>0) {
          echo '1';
          exit();
        }

            foreach ($attend as $key => $value) {
              if ($value == 'present') {
                    $data = array(
                        'tag' => $tag,       
                        'm_id' => $key,       
                        'date' => $date,       
                        'attend' => 'present'       
                    );
                $result = $attenModel->addAttendByProg($tbl_attendance,$data);
                 }else{
                    $data = array(
                        'tag' => $tag,       
                        'm_id' => $key,       
                        'date' => $date,       
                        'attend' => 'absent'       
                    );
                    //data
                    $result = $attenModel->addAttendByProg($tbl_attendance,$data);
                 }   
            }

            if ($result) {
                $resulst = $attenModel->emptyDataTable($tbl_preatn);
            }

            echo json_encode(array("status" => TRUE));
      
        // $mdata = array();
        // if ($result == 1) {
        // $mdata['msg'] = "<div class='alert alert-success alert-dismissible'>
        //                     <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        //                     <strong>Success!</strong> Attendance taken successfully.
        //                   </div>";
        //   }else{
        //         $mdata['msg'] = "<div class='alert alert-danger alert-dismissible'>
        //                     <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        //                     <strong>Success!</strong> Does not add.
        //                   </div>";
        //   }
        
        // $url = BASE_URL."/Attendance/editAttend?tag=".$tag."&msg=".urlencode(serialize($mdata));
        //     header("Location:".$url);

    }

    public function dateByAttendance(){
        //table
        $tbl_attendance = "tbl_attendance";
        $tbl_member = "tbl_member";
        $tbl_tag = "tbl_tag";

        //model
        $attenModel = $this->load->model("attenModel");
        $tagmodel = $this->load->model("TagModel");

        //condition
        $tag = $_GET['tag'];
        $date = $_GET['date'];
        $attend = $_GET['attend'];

        //data
        $data['title']   = "Listapp | Information for attendance";
        $data['memlistbyprogNdate'] = $attenModel->memberByProgByDate($tbl_attendance,$tbl_member,$tag,$date,$attend);
        $data['alltags']   = $tagmodel->alltags($tbl_tag);
      
        $this->load->view('admin/attendinfo',$data);   
    }

    public function editAttend(){
        //table
        $tbl_member = "tbl_member";
        $tbl_attendance = "tbl_attendance";
        $tbl_tag = "tbl_tag";

        //model
        $attenModel = $this->load->model("attenModel");
        $tagmodel = $this->load->model("TagModel");

        //condition
        $tag = $_GET['tag'];      
        
        //data
        $data['title']   = "Listapp | View Attendance";
        $data['editAtenbyprog'] = $attenModel->editAtenByProg($tag,$tbl_attendance);
        $data['alltags']   = $tagmodel->alltags($tbl_tag);

        $this->load->view('admin/header',$data);
        $this->load->view('admin/sidebar');       
        $this->load->view('admin/editatten',$data); 
        $this->load->view('admin/footer',$data); 
    }

    public function editByAttendance(){
        if (!($_POST)) {
            header("Location:".BASE_URL."/Attendance/addAttendance");
        }
        $input = $this->load->validation('DForm');

        //table
        $tbl_attendance = "tbl_attendance";

        //model
        $attenModel = $this->load->model("attenModel");

        //condition
        $input->post('tag');
        $input->post('date');
  
        $tag   = $input->values['tag'];
        $date   = $input->values['date'];
        $attend = $_POST['attend'];

        foreach ($attend as $key => $value) {
          if ($value == 'present') {
                $data = array(
                    'tag' => $tag,       
                    'm_id' => $key,       
                    'date' => $date,       
                    'attend' => 'present'       
                );
            $result = $attenModel->addAttendByProg($tbl_attendance,$data);
             }else{
                $data = array(
                    'tag' => $tag,       
                    'm_id' => $key,       
                    'date' => $date,       
                    'attend' => 'absent'       
                );
                //data
                $result = $attenModel->addAttendByProg($tbl_attendance,$data);
             }   
        }

        $mdata = array();
        if ($result == 1) {
        $mdata['msg'] = "<div class='alert alert-success alert-dismissible'>
                            <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Success!</strong> Attendance taken successfully.
                          </div>";
          }else{
                $mdata['msg'] = "<div class='alert alert-danger alert-dismissible'>
                            <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Success!</strong> Does not add.
                          </div>";
          }
        
        $url = BASE_URL."/Attendance/addAttendance?msg=".urlencode(serialize($mdata));
        header("Location:".$url);

    }

    public function viewByDate(){
        //table
        $tbl_member = "tbl_member";
        $tbl_attendance = "tbl_attendance";
        $tbl_tag = "tbl_tag";

        //model
        $attenModel = $this->load->model("attenModel");
        $tagmodel = $this->load->model("TagModel");

        //condition
        $tag = $_GET['tag'];
        $date = $_GET['date'];
        
        //data
        $data['title']   = "Listapp | View Attendance";
        $data['viewresult'] = $attenModel->viewResultByDateProg($tag,$date,$tbl_attendance,$tbl_member);
        $data['alltags']   = $tagmodel->alltags($tbl_tag);

        $this->load->view('admin/header',$data);
        $this->load->view('admin/sidebar');       
        $this->load->view('admin/attenviewbydate',$data); 
        $this->load->view('admin/footer',$data); 
    }

    public function editByDate(){
        //table
        $tbl_member = "tbl_member";
        $tbl_attendance = "tbl_attendance";
        $tbl_tag = "tbl_tag";

        //model
        $attenModel = $this->load->model("attenModel");
        $tagmodel = $this->load->model("TagModel");

        //condition
        $tag = $_GET['tag'];
        $date = $_GET['date'];

        //data
        $data['title']   = "Listapp | Edit Attendance";
        $data['editview'] = $attenModel->viewByDateProg($tag,$date,$tbl_attendance,$tbl_member);
        $data['alltags']   = $tagmodel->alltags($tbl_tag);

        $this->load->view('admin/header',$data);
        $this->load->view('admin/sidebar');       
        $this->load->view('admin/editattenbyprogndate',$data); 
        $this->load->view('admin/footer'); 
    }

    public function EditSelectAttendance($date){
        if (!($_POST)) {
            header("Location:".BASE_URL."/Attendance/addAttendance");
        }
        $input = $this->load->validation('DForm');

        //table
        $tbl_attendance = "tbl_attendance";

        //model
        $attenModel = $this->load->model("attenModel");

        //condition
        //$tag   = $input->values['tag'];
        $input->post('tag');
        $input->post('date');
  
        $tag   = $input->values['tag'];
        $Ddate   = $input->values['date'];
        $attend = $_POST['attend'];

         

        foreach ($attend as $key => $value) {

          if ($value == 'present') {



          $sql = "UPDATE tbl_attendance SET attend='present', date='$Ddate' WHERE m_id='$key' AND date='$date' AND tag='$tag'";

            $result = $attenModel->editAttendByProgPresent($sql);




             }elseif($value == 'absent'){

           $sql = "UPDATE tbl_attendance SET attend='absent', date='$Ddate' WHERE m_id='$key' AND date='$date' AND tag='$tag'";
                //data
            $result = $attenModel->editAttendByProgPresent($sql);
             }   
        }



        $mdata = array();
        if ($result == 1) {
        $mdata['msg'] = "<div class='alert alert-success alert-dismissible'>
                            <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Success!</strong> Attendance Edited successfully.
                          </div>";
          }else{
                $mdata['msg'] = "<div class='alert alert-danger alert-dismissible'>
                            <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Success!</strong> Does not add.
                          </div>";
          }
        
        $url = BASE_URL."/Attendance/editAttend?tag=".$tag."&msg=".urlencode(serialize($mdata));
            header("Location:".$url);      
    }

    //Have to look---------------

    public function deleteByDate(){
        //table
        $tbl_attendance = "tbl_attendance";

        //model
        $attenModel = $this->load->model("attenModel");

        //condition
        $tag=$_GET['tag'];
        $date=$_GET['date'];

        $res = $attenModel->fetchTagDate($tbl_attendance,$tag,$date);

        foreach ($res as $key => $value) {
            $d=$value['date'];
            $t=$value['tag'];          
        }
        
        $sql = "DELETE FROM $tbl_attendance WHERE date='$d' AND tag='$t'";
        $result = $attenModel->deletDateByProg($sql);

        $mdata = array();
        if ($result > 1) {
        $mdata['msg'] = "<div class='alert alert-success alert-dismissible'>
                            <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Success!</strong> Attendance deleted successfully.
                          </div>";
          }else{
                $mdata['msg'] = "<div class='alert alert-danger alert-dismissible'>
                            <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Warning!</strong> Does not add.
                          </div>";
          }
        
        $url = BASE_URL."/Attendance/editAttend?tag=".$tag."&msg=".urlencode(serialize($mdata));
            header("Location:".$url);        
    }

    public function infoAttendanceByDateDff(){
        //table
        error_reporting(0);
        $tbl_attendance = "tbl_attendance";
        $tbl_member = "tbl_member";
        $tbl_tag = "tbl_tag";

        //model
        $attenModel = $this->load->model("attenModel");
        $tagmodel = $this->load->model("TagModel");

        //condition
        $tag = $_GET['tag'];
        $f_date = $_GET['f_date'];
        $t_date = $_GET['t_date'];
        //$attend = $_GET['attend'];

        //data
        $data['title']   = "Listapp | Information for attendance";
        
        $result1 = $attenModel->infoAttenByfDateDff($tbl_attendance,$tbl_member,$tag,$f_date);

        $data['result1']=$result1;
        $val=array();
        foreach ($result1 as $value) {
            $val[]=$value['id'];
        }

        $result2 = $attenModel->infoAttenBytDateDff($tbl_attendance,$tbl_member,$tag,$t_date);
        $val1=array();
        foreach ($result2 as $value) {
           $val1[]=$value['id'];

        }
        $data['info'] =array_diff($val,$val1);

        $data['alltags']   = $tagmodel->alltags($tbl_tag);
      
        $this->load->view('admin/infoattenbydate',$data);        
    }


    public function attenAnalysis(){
        $tbl_attendance = "tbl_attendance";
        $tbl_member = "tbl_member";
        $tbl_tag = "tbl_tag";

        //model
        $attenModel = $this->load->model("attenModel");
        $tagmodel = $this->load->model("TagModel");

        //condition
        $tag = $_GET['tag'];
        $id = $_GET['id'];
        $name = $_GET['name'];

        //data
        $data['title']= "Listapp | Attendance analysis"; 
        $data['analysis'] = $attenModel->infoAttenAnalysis($tbl_attendance,$tbl_member,$tag,$id);

        $this->load->view('admin/header',$data);
        $this->load->view('admin/sidebar');       
        $this->load->view('admin/attendanalysis',$data); 
        $this->load->view('admin/footer');     
    }

    public function selectAbsentMemByProg(){
        $tbl_attendance = "tbl_attendance";
        $tbl_member = "tbl_member";
        $tbl_tag = "tbl_tag";

        //model
        $attenModel = $this->load->model("attenModel");
        $tagmodel = $this->load->model("TagModel");
        $memmodel = $this->load->model("MemModel");

        //condition
        $tag = $_GET['tag'];
        //$member = $_GET['member'];
        $fdate = $_GET['fdate'];
        $tdate = $_GET['tdate'];
        $attend = $_GET['attend'];
        $num = $_GET['num'];

        $data['num']=$num;
        $data['attend']=$attend;

        //data
        $data['title']= "Listapp | Attendance analysis";

        $data['progname']   = $tagmodel->alltags($tbl_tag);
        
        

        if (empty($num)) {
        $data['absentanalysis'] = $attenModel->MemAbsentAnalysisNullNum($tbl_attendance,$tbl_member,$tag,$fdate,$tdate,$attend);
        }else{
        $data['absentanalysis'] = $attenModel->MemAbsentAnalysis($tbl_attendance,$tbl_member,$tag,$fdate,$tdate,$attend,$num);        }

        $data['numprog'] = $memmodel->AvgByTagNDateLimit($tbl_attendance,$tag,$fdate,$tdate);
     
        $this->load->view('admin/memabsent',$data);         
    }

    public function countMemberProAtn()
    {
        $tbl_attendance = "tbl_attendance";
        $tbl_member = "tbl_member";
        $tbl_tag = "tbl_tag";

        //model
        $attenModel = $this->load->model("attenModel");
        $tagmodel = $this->load->model("TagModel");
        $memmodel = $this->load->model("MemModel");

        //condition
        $tag = $_GET['tag'];
        $selectedYear = $_GET['year'];
        $data['inputYear'] = $_GET['year'];
        //$member = $_GET['member'];

        $attend = $_GET['attend'];

        $data['attend']=$attend;

        //data
        $data['title']= "Listapp | Attendance Count";

        $data['progname']   = $tagmodel->alltags($tbl_tag);
        
        //$data['absentanalysis'] = $attenModel->MemAbsentAnalysis($tbl_attendance,$tbl_member,$tag,$fdate,$tdate,$attend,$num); 

        $data['countAtn'] = $attenModel->countAtn($tbl_attendance,$tbl_member,$_GET['member'],$tag,$attend);

        $data['numprog'] = $memmodel->AvgByTagYear($tbl_attendance,$tag,$selectedYear);
     
        $this->load->view('admin/countmemberattendance',$data);  
    }

    public function deleteMultMembers(){
        //tables
        $tbl_attendance = "tbl_attendance";
        $tbl_member = "tbl_member";
        $tbl_tag = "tbl_tag";

        //models
        $attenModel = $this->load->model("attenModel");

        //condition
        $delid = $_POST['checked_id'];
        //$cond = "$delid";
        $nc = count($delid);
        $result   = $attenModel->delMultiMem($tbl_attendance,$tbl_member,$delid,$nc);

        $mdata = array();
        if ($result > 1) {
        $mdata['msg'] = "<div class='alert alert-success alert-dismissible'>
                            <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Success!</strong> Member deleted successfully.
                          </div>";
          }else{
                $mdata['msg'] = "<div class='alert alert-danger alert-dismissible'>
                            <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Warning!</strong> Not working.
                          </div>";
          }
        
       $url = BASE_URL."/Attendance/editAttend?tag=".$tag."&msg=".urlencode(serialize($mdata));
       header("Location:".$url); 
    }

    public function selectAttendMem(){ 
        //tables
        $tbl_attendance = "tbl_attendance";
        $tbl_member = "tbl_member";
        $tbl_tag = "tbl_tag";

        //Models 
        $attenModel = $this->load->model("attenModel");
        $tagmodel = $this->load->model("TagModel");  

        //conditions 
        $id = $_GET['checked_id'];
        $tag = $_GET['tag'];


        $data['progname']   = $tagmodel->alltags($tbl_tag);
         
        $data['membysearch'] = $attenModel->selectAttendList($tbl_attendance,$tbl_member,$id,$tag);
        $this->load->view('admin/selectedlist',$data);

    } 


  public function selectMemberForAtn(){
    $input = $this->load->validation('DForm');
    $table = "tbl_preatn";
    //Models 
    $attenModel = $this->load->model("attenModel");
    // $input->post('memberid');
    // $memberid   = $input->values['memberid'];

    $m_ids = $_POST['ids'];

    $data = array(
        'memberid' => $m_ids      
    ); 

    $re = $attenModel->memNameExst($table,$m_ids);

    if ($re>0) {
      echo '1';
      exit();
    }

    $result = $attenModel->selectMemberForAtn($table,$data);
    echo json_encode(array("status" => TRUE));
  }

 public function deleteAtnMember(){
        $table = "tbl_preatn";

        $id = $_POST['ids'];
        $cond = "memberid=$id";
        $attenModel = $this->load->model("attenModel");
        $result   = $attenModel->deleteAtnMember($table,$cond);

        $msg['success'] = false;
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);  
 }

 public function clearTable(){

         $tbl_preatn = "tbl_preatn";

         $attenModel = $this->load->model("attenModel");


         $resulst = $attenModel->emptyDataTable($tbl_preatn);

        echo json_encode(array("status" => TRUE));
 }

 public function countatnMem(){
    $tbl_preatn = "tbl_preatn";
    $tbl_member = "tbl_member";

    $attenModel = $this->load->model("attenModel");
    $countRow   = $attenModel->countResultByMem($tbl_preatn,$tbl_member);

    $data_html = '';
    
    foreach ($countRow as $value) {
        $QAm = $value['qamales'];
        $QAf = $value['qafemales'];
        $t_qa =  $QAm + $QAf;

        $QGm = $value['qgmales'];
        $QGf = $value['qgfemales'];
        $t_qg =  $QGm + $QGf;

        $QPMm = $value['qpmmales'];
        $QPMf = $value['qpmfemales'];
        $t_qpm =  $QPMm + $QPMf;
        
        $data_html .='
         <div class="row">
             <div class="col-md-4">
         <div>
           <legend style="margin-bottom: 1px;"><h5>QA('.$t_qa.')</h5></legend>
           <h6>Male: '.$value['qamales'].',  Female: '.$value['qafemales'].'</h6>
         </div>
             </div>
             <div class="col-md-4">
         <div>
           <legend style="margin-bottom: 1px;"><h5>QG('.$t_qg.')</h5></legend>
           <h6>Male: '.$value['qgmales'].',  Female: '.$value['qgfemales'].'</h6>
         </div>
             </div>
             <div class="col-md-4">
         <div>
           <legend style="margin-bottom: 1px;"><h5>QPM('.$t_qpm.')</h5></legend>
           <h6>Male: '.$value['qpmmales'].',   Female: '.$value['qpmfemales'].'</h6>
         </div>
             </div>
         </div> 
         <h5><b>Totall: '.$value['total'].'</b></h5>
         <a id="viewMember" href="'.BASE_URL.'/Attendance/viewSelectedMemForAtn" target="_blank" class="btn btn-primary">View Selected Members</a>
         ';
    }

    echo json_encode($data_html);
 }

    public function viewSelectedMemForAtn(){
        $tbl_preatn = "tbl_preatn";
        $tbl_member = "tbl_member";

        $attenModel = $this->load->model("attenModel");
        $data['seletedMembers']   = $attenModel->atnList($tbl_preatn,$tbl_member);

        //condition
        // $tag = $_GET['tag'];
        // $id = $_GET['id'];
        // $name = $_GET['name'];

        //data
        $data['title']= "Listapp | Selected Members For Attendance"; 
     
        //$this->load->view('admin/header',$data);
        //$this->load->view('admin/sidebar');       
        $this->load->view('admin/attend/viewselectedMem',$data); 
        //$this->load->view('admin/footer');     
    }


}
?>