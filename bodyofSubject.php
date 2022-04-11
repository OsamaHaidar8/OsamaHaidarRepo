<!--start body of page-->
          
          
             <!-- start Description of page-->
           <section class="about" style="background-color: #b5d1ab;">
            <div class="container text-center">
              
              <?php
              if(isset($_GET['action'])&&$_GET['action']=='course')
              {
               $id=$_GET['id'];
               $stm=$con->prepare("select * from subjects where id=?");
               $stm->execute(array($id));
               if($stm->rowCount())
               {
                    foreach($stm->fetchAll() as $row)
                    {
                      $name=$row['name'];
                      $description=$row['description'];
              }
              
              ?>
              <h1 style="margin-top:80px;margin-bottom:20px;font-weight: bolder; color: #F1B24A; line-height: 30px; text-align: center;background-color: #164A41;padding: 10px;border-radius: 10px;width: fit-content;height: 50px;"><?php echo $name; ?></h1>
              <p class="lead" style="font-size: 30px; line-height: 2em; color: #464E6D; text-align: justify;"><?php echo $description; ?></p>
              <?php  } ?>
            </div>
           </section>         
             <!-- end Description of page-->
             
              <!-- start class description-->
              <section class="descriptions">
                  <div class="container text-center">
            <div class="row">
               <fieldset>
                    <legend >الكورسات المتاحة</legend>
                <?php
                $query="select * from courses where sub_id=?";
                $stm=$con->prepare($query);
                $stm->execute(array($id));
                if($stm->rowCount())
                {
                foreach($stm->fetchAll() as $row)
                {
                        $id=$row["id"];
                        $image=$row['image'];
                        $title=$row['CourseName'];
                        $description=$row['Description'];               
                ?>  
                <div class="col-lg-3 col-md-4 col-sm-6">
                  <div class="thumbnail">
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                    <img class="img-responsive" src="admin/upload/<?php echo $image; ?>" alt="...">
                    <div class="caption">
                      <h3><?php echo $title; ?></h3>
                      <p class="lead"><?php echo $description; ?></p>
                      <p><a href="linkstobc.php?action=courses&&id=<?php echo $id; ?>" class="btn btn-primary" role="button">أدخل</a> 
                    </div>
                  </div>
                </div>
                
               <?php
                          }
                          }
               ?>
               </fieldset>
      </div>
            <div class="row">
               <fieldset>
                    <legend>الكتب المتاحة</legend>
                <?php
                $query="select * from books where sub_id=?";
                $stm=$con->prepare($query);
                $stm->execute(array($id));
                if($stm->rowCount())
                {
                foreach($stm->fetchAll() as $row)
                {
                        $id=$row["id"];
                        $image=$row['image'];
                        $title=$row['CourseName'];
                        $description=$row['Description'];               
                ?>  
                <div class="col-lg-3 col-md-4 col-sm-6">
                  <div class="thumbnail">
                    <img class="img-responsive" src="admin/upload/<?php echo $image; ?>" alt="...">
                    <div class="caption">
                      <h3><?php echo $title; ?></h3>
                      <p class="lead"><?php echo $description; ?></p>
                      <p><a href="linkstobc.php?action=books&&id=<?php echo $id; ?>" class="btn btn-primary" role="button">أدخل</a> 
                    </div>
                  </div>
                </div>
                
               <?php
                          }
                          }
              }
               ?>
               </fieldset>
      </div>
     </div>
            </section>
              <!-- End Description of classes-->
           <!--end of body of page-->
           