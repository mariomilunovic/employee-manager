<h2>Are you sure you want to delete this job position?</h2>

<?php
    echo 'ID : '.$jobposition->id.'<br>';
    echo 'NAME : '.$jobposition->name.'<br>';
    echo 'SALARY : '.$jobposition->salary.'<br><br>';

    echo '<a class="red_button" href="/jobpositions/destroy?id='.$jobposition->id.'">Confirm Delete</a>';
    echo '&nbsp &nbsp';
    echo '<a class="green_button" href="/jobpositions">Cancel</a>';

?>

