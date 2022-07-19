
<h2>List of all job positions</h2>

<a class="blue_button" href="/jobpositions/create">Create new job position</a>

<hr>

<table class="styled-table">
    
    <thead>

        <tr>
            <th>id</th>
            <th>name</th>     
            <th>salary</th> 
            <th></th>   
            <th></th>  
        </tr>
    
    </thead>

    <tbody>
   
        <?php 
            foreach ($jobpositions as $jobposition)
            {
                echo '<tr>';
                    echo '<td>'.$jobposition->id.'</td>';
                    echo '<td>'.$jobposition->name.'</td>';     
                    echo '<td>'.$jobposition->salary.'</td>'; 
                    echo '<td><a class="green_button" href="/jobpositions/edit?id='.$jobposition->id.'">Update</a></td>';
                    echo '<td><a class="red_button" href="/jobpositions/delete?id='.$jobposition->id.'">Delete</a></td>';
                echo '</tr>';
            }   
        ?>   

    </tbody>

</table>




