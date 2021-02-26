<?php
require_once 'core/init.php';


if(isset($_POST['catExp'])){

  $user = new User();
  $resultresult = $user->data();
  $userID = $resultresult ->userID;
  $rewuser = new Preward();
  
  $corporateID = $resultresult->corporateID;
  $companyID = $resultresult->companyID;
  date_default_timezone_set('Asia/Kuala_Lumpur');
  $today = date('Y-m-d H:i:s');

  $id = $_POST['catExp'];
  if ($id==="all3"){
      if (empty($resultresult->corporateID) || $resultresult->corporateID == 0) {
        $row = $rewuser->RewardExpired($resultresult->companyID, 'companyID');
    }
      else {
        $row = $rewuser->RewardExpired($resultresult->corporateID, 'corporateID');
    }
  }
  else {
    if (empty($resultresult->corporateID) || $resultresult->corporateID == 0) {
        $row = $rewuser->RewardExpiredCat($resultresult->companyID, 'companyID', $id);
    }
    else {
        $row = $rewuser->RewardExpiredCat($resultresult->corporateID, 'corporateID', $id);
    }
  }
  
  $view = ' ';

   if ($row){
                                
                              foreach ($row as $key) {
                            
                        $view .= '<div class="col-sm-4 col-lg-3 col-md-3">
                          
                          <div class="card" style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; ">
                            <!-- <div class="px-2 btn btn-outline-danger btn-sm text-uppercase" style="width: 120px; font-size: 14px;font-weight: 900;left: 13px;top: 15px;position: absolute;background: white;" >
                            </div> --> ';
                            
                            if (empty($key->reward_img)){
                              $view .='<div class="d-flex card-img-top"><img src="img/nopicture.png" width="180" height="200"  alt="Reward Picture" class="rewardimg"></div>';}
                              else {
                                $view .= '<div class="d-flex card-img-top"><img src="data:image/jpeg;base64,'.base64_encode($key->reward_img).'" width="180" height="200" alt="Reward Picture" class="rewardimg"></div>'; }

                              $view .= '<div class="card-body">
                                <h5 class="card-title">
                                  <span class="badge badge-success">'
                                     .$key->category.'</span>
                                  <strong>'.$key->reward.'</strong>
                                </h5>
                                <p class="card-text">
                                <span class="badge badge-pill badge-warning"> P </span>'
                                   .$key->points.'<br>'
                                   .$key->description.'<br>
                                  Valid til:'.$key->expiredate.
                                '</p>

                              </div>
                          </div>
                        </div>';

                          
             }

             
           }
                  
  else {
    $view .= 'You have no reward currently';
  }


  $array = ['view' => $view,
  ];

  echo ($view);
  

}