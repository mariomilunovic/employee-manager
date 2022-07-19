
<h2>List of all employees</h2>

<a class="blue_button" href="/employees/create">Create new employee</a>

<hr>

<table class="styled-table">
    <thead>
        <tr >
            <th>id</th>
            <th>name</th>
            <th>surname</th>
            <th>degree</th>
            <th>email</th>
            <th>phone</th>
            <th>job position</th>
            <th>salary</th>
            <th></th>
            <th></th>
        </tr>
</thead>
<tbody>
   
        <?php 
            foreach ($employees as $employee)
            {
                echo '<tr>';
                
                echo '<td>'.$employee->id.'</td>';
                echo '<td>'.$employee->name.'</td>';
                echo '<td>'.$employee->surname.'</td>';
                echo '<td>'.$employee->degree.'</td>';
                echo '<td>'.$employee->email.'</td>';
                echo '<td>'.$employee->phone.'</td>';
          
                if(isset($employee->jobposition->id))
                {            
                    echo '<td>'.$employee->jobposition->name.'</td>';
                    echo '<td>'.$employee->jobposition->salary.'</td>';            
                    echo '<td><a class="green_button" href="/employees/edit?id='.$employee->id.'">Update</a></td>';
                    echo '<td><a class="red_button" href="/employees/delete?id='.$employee->id.'">Delete</a></td>';
                }

                else
                {            
                    echo '<td>N/A</td>';
                    echo '<td>N/A</td>';
                    echo '<td><a class="green_button" href="/employees/edit?id='.$employee->id.'">Update</a></td>';
                    echo '<td><a class="red_button" href="/employees/delete?id='.$employee->id.'">Delete</a></td>';            
                }

                echo '</tr>';
            }   
        ?>
    

</tbody>


</table>




