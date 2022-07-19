
<h2>Search results</h2>

<hr>

<h4>Employees found:<?= count($employees)?></h4>

<?php

if (count($employees) > 0)
{

    echo '
    <table class="styled-table">
        <thead>
            <tr >
                <th>id</th>
                <th>name</th>
                <th>surname</th>
                <th>degree</th>
                <th>email</th>
                <th>phone</th>
                <th>salary</th>
                <th>job position</th>            
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        ';
   
        
            foreach ($employees as $employee)
            {
                echo '<tr>';

                    echo '<td>'.$employee->id.'</td>';
                    echo '<td>'.$employee->name.'</td>';
                    echo '<td>'.$employee->surname.'</td>';
                    echo '<td>'.$employee->degree.'</td>';
                    echo '<td>'.$employee->email.'</td>';
                    echo '<td>'.$employee->phone.'</td>';

                    echo '<td';

                        if (isset($employee->salary))
                        {

                            if ($employee->salary > $employee->jobposition->salary)
                            {
                                echo ' style="color:red;">';
                                echo $employee->salary;
                                echo ' ( + '.round($employee->salary/$employee->jobposition->salary*100 - 100,2);
                                echo '%)';
                            }
                            else if ($employee->salary < $employee->jobposition->salary)
                            {
                                echo ' style="color:limegreen;">';
                                echo $employee->salary;
                                echo ' ( - '. round(100 - $employee->salary/$employee->jobposition->salary*100);
                                echo '%)';
                            } 
                            else if($employee->salary == $employee->jobposition->salary)
                            {
                                echo ' style="color:blue;">';
                                echo $employee->salary;
                                echo ' (same as default) ';                       
                            }      
                        }              

                        else
                        {
                            echo ' style="color:black;">';
                            echo $employee->jobposition->salary;
                            echo ' (not specified) ';
                        }

                    echo '</td>'; 

                    echo '<td style="font-size:small;">'.$employee->jobposition->name.' ( salary : '.$employee->jobposition->salary.' )</td>';

                    // update delete buttons
                    echo '<td><a class="green_button" href="/employees/edit?id='.$employee->id.'">Update</a></td>';
                    echo '<td><a class="red_button" href="/employees/delete?id='.$employee->id.'">Delete</a></td>';
                    
                echo '</tr>';
            }       
        
 echo '
    </tbody>

</table>';
}
?>

<h4>Job positions found:<?= count($jobpositions)?></h4>

<?php

if (count($jobpositions) > 0)
{

    echo '
    <table class="styled-table">
        <thead>
            <tr >
                <th>id</th>
                <th>name</th>               
                <th>salary</th>                          
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        ';
   
            foreach ($jobpositions as $jobposition)
            {
                echo '<tr>';

                    echo '<td>'.$jobposition->id.'</td>';
                    echo '<td>'.$jobposition->name.'</td>';
                    echo '<td>'.$jobposition->salary.'</td>';

                    // update and delete buttons
                    echo '<td><a class="green_button" href="/employees/edit?id='.$employee->id.'">Update</a></td>';
                    echo '<td><a class="red_button" href="/employees/delete?id='.$employee->id.'">Delete</a></td>';
                    
                echo '</tr>';
            }       
        
 echo '
    </tbody>

</table>';
}
?>


