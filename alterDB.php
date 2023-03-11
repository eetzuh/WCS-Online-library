<?php
print_r($_POST['previous_author']);
if($_POST['previous_author']!=$_POST['compare_previous_author']){
    print('deleted');
}else{
    print ('same');
}

?>