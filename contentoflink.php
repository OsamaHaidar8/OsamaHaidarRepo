<!--start body of page-->
          
          
             <!-- start Description of page-->
           <section class="about" style="background-color: #ddf0d3;">
            <div class="container text-center ">
              <h1 style="margin-top:50px;margin-bottom:40px;font-weight: bolder; color: #F1B24A; line-height: 30px; text-align: center;background-color: #164A41;padding: 10px;border-radius: 10px;width: fit-content;height: 50px;">التعلم الذاتي</h1>
              <?php
              if(isset($_GET['action']))
              {
           
              $id=$_GET['id'];
              if($_GET['action']=='courses')
              {
               $stm=$con->prepare("select * from courses where id=?");
               $stm->execute(array($id));
               if($stm->rowCount())
               {
                    foreach($stm->fetchAll() as $row)
                    {
                         $description=$row['Description'];
                         $link=$row['Links'];
                    }
               }
              }
               if($_GET['action']=='books')
              {
               $stm=$con->prepare("select * from books where id=?");
               $stm->execute(array($id));
               if($stm->rowCount())
               {
                    foreach($stm->fetchAll() as $row)
                    {
                         $description=$row['Description'];
                         $link=$row['Links'];
                    }
               }
              }
              
              
              
              ?>
              <p class="lead" style="font-size:25px;"><?php
              echo $description;
               ?>
              <a href="<?php echo $link;
              } ?>">أضغط هنا</a>
              </p>
            </div>
           </section>         
             <!-- end Description of page-->
             
              <!-- start class description-->
              <section class="descriptions">
                  <div class="container text-center">
            <div class="row">
    
      </div>
     </div>
            </section>
              <!-- End Description of classes-->
           <!--end of body of page-->
           