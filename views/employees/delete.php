<h2>Are you sure you want to delete this employee?</h2>

<?php
    echo 'ID : '.$employee->id.'<br>';
    echo 'NAME : '.$employee->name.'<br>';
    echo 'SURNAME : '.$employee->surname.'<br>';
    echo 'DEGREE : '.$employee->degree.'<br>';
    echo 'EMAIL : '.$employee->email.'<br>';
    echo 'PHONE : '.$employee->phone.'<br><br>';

    echo '<a class="red_button" href="/employees/destroy?id='.$employee->id.'">Confirm Delete</a>';
    echo '&nbsp &nbsp';
    echo '<a class="green_button" href="/employees">Cancel</a>';
?>