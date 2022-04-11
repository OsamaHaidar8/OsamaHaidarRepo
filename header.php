<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <!--IE Compatiblity Meta-->
            <meta http-equiv="X-UA-Compatible" content="IE-edge">
            <!--First Mobile meta-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
            <title>التعلم الذاتي</title>
            <link rel="stylesheet" href="css/bootstrap.css"/>
            <link rel="stylesheet" href="css/css.css" type="text/css">
            <link rel="stylesheet" href="css/main.css"/>
            <link rel="stylesheet" href="css/useredit.css"/>
            <link rel="stylesheet" href="css/footercss.css"/>
            <link rel="stylesheet" href="css/font-awesome.css"/>
            <link rel="stylesheet" href="css/font-awesome.min.css"/>
            
            <!-- IE -->
            <script src="js/html5shiv.min.js"></script>
             <script src="js/respond.min.js"></script>
        </head>
        <body class="main">
       
           <?php session_start(); ?>
             <!-- startin of  our navbar-->
                
   <nav class="navbar navbar-default navbar-fixed-top ">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed navbar-left" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>    
      </button>
        <a class="navbar-brand hidden-lg hidden-md hidden-sm">التعلم</a>
    </div>    


    <div class="collapse navbar-collapse" id="navbar">
    
      <ul class="nav navbar-nav ">
         <li><a href="#about">نبذه عنا</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">الحساب<span class="caret"></span></a>
          <ul class="dropdown-menu">
           <?php if(!isset($_SESSION['userinfo']))
           {
           ?>
              <li><a href="#"  class="button1" id="modelbtn1">تسجيل الدخول</a></li>
          <?php } ?>
            <li><a href="created account.php">انشاء حساب</a></li>
            <?php if(isset($_SESSION['userinfo']))
           {
           ?>
            <li><a href="useredit.php?action=edit&&id=<?php echo $_SESSION['userinfo']['id']; ?>" >الملف الشخصي</a></li>
            <li><a href="logout.php" >تسجيبل الخروج</a></li>
            
            <?php } ?>
            <li role="separator" class="divider"></li>
          </ul>
            <?php 
            include "login.php";
            ?>
        </li>
      </ul>
       <ul class="nav navbar-nav ">
          <?php if(isset($_SESSION['userinfo'])&&$_SESSION['userinfo']['prv_id']==1)
           {
           ?>
            <li><a href="admin/index.php" >لوحة التحكم</a></li>
            <?php } ?>
        <li><a href="#about"> المنتدى</a></li>
        <li ><a href="home.php">الصفحة الرئسية</a></li>
      </ul>
      <script src="js/java.js"></script>
       <a class="navbar-brand visible-lg-block visible-md-block visible-sm-block">التعلم</a>
    </div>
    
  </div><!-- /.container-fluid -->
</nav>
   <script src="js/jquery5.3.1.js"></script>          
    <script src="js/bootstrap.min.js"></script>