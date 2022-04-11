<?php

if(isset($_GET["action"]))
{
    $image=$_GET["name"];
    
}
?>
<div>
<img  src="upload/<?php echo $image; ?>"/>
</div>