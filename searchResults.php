<?php
include_once 'header.php';
?>


<!--Results Gallery-->
<div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
    <h4 class="text-light text-center font-weight-lighter mb-3"> Results</h4>


   <div class="row px-4">
       <!--Fetching products-->
       <?php
       require_once 'includes/results.inc.php';
       ?>
   </div>
</div>
<!--Results Gallery End-->


<?php
include_once 'footer.php';
?>