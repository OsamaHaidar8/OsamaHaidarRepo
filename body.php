<!--start body of page-->
          
  <!-- start Description of page-->
    <section class="aboutsite">
      <div class="container text-center">
        <div class="row">
          <div class="col-lg-6 col-sm-12" style="float:right">
            <br><br>
            <h1>التعلم الذاتي</h1>
            <br>
            <p class="lead">يوفر موقع التعلم الذاتي للراغبين في تعلم لغات البرمجة روابط لافضل الكورسات المتوفره على اليوتيوب مع شرح مميزات كل كورس بالاضافة الي روابط لاهم الكتب العالمية الخاصة بالبرمجة وايضا يحتوى الموقع على منتدى يساعد المتعلمين في طرح استفساراتهم ومنافشة مشاكلهم البرمجية</p>
            <br>
          </div>
          <div class="col-lg-6 col-sm-12" style="float:right">
            <img class="img-responsive main-img" src="images/back.jpg">
          </div>
        </div>
        <hr align="center" color="black" width="100%" size="10px">
      </div>
    </section>
  <!-- end Description of page-->
             
  <!-- start class description-->
    <section class="descriptions">
      <div class="container text-center">
        <div class="row">
          <?php
            $query="select * from subjects";
            $stm=$con->prepare($query);
            $stm->execute();
            if($stm->rowCount())
            {
            foreach($stm->fetchAll() as $row)
            {
                    $id=$row["id"];
                    $image=$row['image'];
                    $title=$row['name'];
                    $description=$row['description'];               
            ?>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="thumbnail" style="float:right">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <img class="img-responsive" src="admin/upload/<?php echo $image; ?>" alt="...">
                  <div class="caption wrap1">
                    <h3><?php echo $title; ?></h3>
                    <p class="lead" style="width: 240px;" ><?php echo $description; ?></p>
                    <p><a href="subjects.php?action=course&id=<?php echo $id; ?>" class="btn btn-primary" role="button">أدخل</a> 
                  </div>
              </div>
            </div>                
            <?php
                }
                }
            ?>
        </div> 
      </div>
    </section>
  <!-- End Description of classes-->

<!--end of body of page-->         