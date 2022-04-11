<?php
include('header.php');
require('dbconnect.php');
?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="fa fa-users"></i> Add books</h2>


                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-8">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus-circle"></i> Edit book
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                 <?php
                                 
                                                if(isset($_GET['action'],$_GET['id']) && $_GET['action']=='edit')
                                                {
                                                $id=$_GET['id'];                                  
                                                   $stm= $con->prepare("select * from books where id=:catid");
                                                   $stm->execute(array('catid'=>$id));
                                                   if($stm->rowCount())
                                                   {
                                                     foreach($stm->fetchAll() as $row)
                                                     {
                                                      $subject=$row['sub_id'];
                                                        $id=$row['id'];
                                                        $name=$row['CourseName'];
                                                        $description=$row['Description'];
                                                         $level=$row['level_id'];
                                                         $link=$row['Links'];
                                                         $image=$row['image'];
                                                      if(isset($_POST["submit"]))
                                                      {
                                                         $id=$_POST['id'];
                                                         $name=trim($_POST['CourseName']);
                                                         $description=trim(($_POST['Description']));
                                                         $level=($_POST['Level_id']);
                                                         $link=($_POST['Links']);
                                                         $subject=$_POST['sub_id'];
                                                         $image=$_POST['image'];
                                                         $errors=array();
                                                         if(empty($name))
                                                         {
                                                            $errors['cname']="<div style='color:red'>enter name </div>";
                                                            
                                                         }
                                                         elseif(is_numeric($name))
                                                         {
                                                            $errors['cnameNumber']="<div style='color:red'>enter string name </div>";
                                                            
                                                         }
                                                         //checking if there is an image or not..!
                                                    if(isset($_FILES['file']))
                                                    {
                                             
                                                          //dealing with files..
                                                        $file=$_FILES["file"];
                                                        $file_name=$file["name"];
                                                        if(!empty($file_name))
                                                        {
                                                        $file_error=$file["error"];
                                                        $file_tmp=$file["tmp_name"];
                                                        $extination = explode('.',$file_name);// فصل الاسم عن الامتداد
                                                        $extination_id = strtolower(end($extination));//to catche the extination
                                                        $extinations = array("jpg","img","png");

                                                        if(!in_array($extination_id,$extinations)){// == false
                                                            $errors['error_extination']="<div class='alert-danger'> File should be image (img-png-jpg)..!</div>";
                                                        }
                                                        // if($file_error===4){//4 --> is an error if the file isn't uploadede
                                                        //     echo "<div class='alert-danger'> File not uploaded..!</div>";
                                                        // }

                                                        //updating with image
                                                        $query="Update books set CourseName=? , Description=? , Level_id=? , Links=?,image=?,sub_id=? where id=?";
                                                             $stm= $con->prepare($query);
                                                             $stm->execute(array($name,$description,$level,$link,$file_name,$subject,$id)); 
        
                                                        if($stm -> rowCount()){
                                                            echo "<script>
                                                                alert('One row updated successfully ^_^');
                                                                window.open('book.php','_self');
                                                            </script>";

                                                            move_uploaded_file($file_tmp,"upload/".$file_name);
                                                        }
                                                        
                                                        else{
                                                            echo "<div class='alert-danger'>Not updated..!</dive>";
                                                           
                                                        }
                                                        }
                                                    
                                                      //end of checking & updating first -> with image
                                                     
                                                         else
                                                         {
                                                            
                                                            $query="Update books set CourseName=? , Description=? , Level_id=? , Links=?,sub_id=?,image=? where id=?";
                                                             $stm= $con->prepare($query);
                                                             $stm->execute(array($name,$description,$level,$link,$subject,$image,$id));     
                                                             if ($stm->rowCount())
                                                             {
                                                               echo "<script>
                                                               alert('one row updated');
                                                               window.open('book.php', '_self');
                                                               </script>";
                                                             }
                                                             else
                                                             {
                                                               echo "<div class='alert alert-danger'>No row Updated</div>";
                                                               
                                                             }
                                                         }
                                                   }
                                                      }
                                                 
                                             
                                             ?>
                                              
                                 
                                    <div class="col-md-12">
                                        <form role="form" method="post" enctype="multipart/form-data">
                                              <div class="form-group">
                                                <label>Subject</label>
                                                <select class="form-control" name="sub_id">
                                                   <?php  $query="select * from subjects";
                                                   $stm= $con->prepare($query);
                                                   $stm->execute();
                                                   if($stm->rowCount())
                                                   {
                                                     foreach($stm->fetchAll() as $row)
                                                     {
                                                      if($subject==$row["id"])
                                                      {
                                                      ?>
                                                     
                                                     <option selected value="<?php echo $row['id']; ?>" ><?php  echo $row['name']; ?></option>
                                                    <?php
                                                      }
                                                      else
                                                      {
                                                         ?>
                                                         <option  value="<?php echo $row['id']; ?>" ><?php  echo $row['name']; ?></option>
                                                         <?php
                                                      }
                                                    }
                                                     }
                                                    ?> 
                                                </select>
                                            </div>
                                          <input type="hidden" name="id" value="<?php echo $id;  ?>" >
                                            <div class="form-group">
                                                <label>CourseName</label>
                                                <input type="text" name="CourseName" value="<?php echo $name ?>" placeholder="Please Enter The CourseName "
                                                    class="form-control" />
                                                 <?php if(isset($errors['cname'])) echo $errors['cname'] ?>
                                             <?php if(isset($errors['cnameNumber'])) echo $errors['cnameNumber']?>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="Description" placeholder="Please Enter Description" 
                                                class="form-control" cols="15" rows="3"><?php echo $description ?></textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Book Level</label>
                                                <select class="form-control" name="Level_id">
                                                   <?php  $query="select * from level";
                                                   $stm= $con->prepare($query);
                                                   $stm->execute();
                                                   if($stm->rowCount())
                                                   {
                                                     foreach($stm->fetchAll() as $row)
                                                     {
                                                      if($level==$row['id'])
                                                      {
                                                      ?>
                                                     <option selected value="<?php echo $row['id']; ?>" ><?php echo $row['name']; ?></option>
                                                    <?php
                                                      }
                                                      else
                                                      {
                                                         ?>
                                                         <option value="<?php echo $row['id']; ?>" ><?php echo $row['name']; ?></option>
                                                      <?php }   
                                                    }
                                                     }
                                                    ?> 
                                                </select>
                                            </div>
                                            <input type="hidden" name="image" value="<?php echo $image ?>" >
                                            <div class="form-group">
                                                <label>Course Link</label>
                                                <input type="text" name="Links" value="<?php echo $link ?>" class="form-control"
                                                    placeholder="Please Enter the Link">
                                            </div>
                                               <div class="form-group">
                                                <label>Photo</label>
                                                <input type="file" value="<?php echo $photo?>" name="file" placeholder="Please Enter book's Photo"
                                                class="form-control">

                                                    <?php
                                                        if(isset($errors['error_extination'])){
                                                            echo $errors['error_extination'];
                                                        }
                                                    ?>
                                            </div>
                                            
                                            <div style="float:right;">
                                                <button type="submit" name="submit" class="btn btn-primary">Edit Course</button>
                                                <button type="reset" name="cancel" class="btn btn-danger">Cancel</button>
                                            </div>

                                    </div>
                                    </form>
                              <?php }}}  ?>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>                    <hr />

                   
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
   </div>
   
   <?php
   include('footer.php');
   ?>