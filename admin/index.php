<?php
include('header.php');
?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2><i class="fa fa-dashboard "></i> Dashboard</h2>   
                       
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-users"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">
                        <?php                     
                        $query="select * from user";
                        $stm=$con->query($query);
                        $stm->execute();
                        echo $stm->rowCount();
                        ?>
                        Users
                        
                    </p>
                    <br>
                    <br>
                </div>
                <a href="users.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
             </div>
		     </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-tasks"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">
                        
                           <?php                     
                        $query="select * from subjects";
                        $stm=$con->prepare($query);
                        $stm->execute();
                        echo $stm->rowCount();
                        ?>
                        Subjects</p>
                    <br>
                    <br>
                   
                </div>
                <a href="subject.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
             </div>
		     </div>
                             <div class="col-md-4 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-book"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">
                        
                           <?php                     
                        $query="select * from books";
                        $stm=$con->prepare($query);
                        $stm->execute();
                        echo $stm->rowCount();
                        ?>
                        Books</p>
                    <br>
                    <br>
                   
                </div>
                <a href="book.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
             </div>
		     </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-table"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">
                         <?php                     
                        $query="select * from Courses";
                        $stm=$con->prepare($query);
                        $stm->execute();
                        echo $stm->rowCount();
                        ?>
                        Courses</p>
                    <br>
                    <br>
                </div>
                <a href="Course.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
             </div>
		     </div>
    
			</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
        <?php
        include('footer.php');
        ?>