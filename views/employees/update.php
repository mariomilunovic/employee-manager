<h2>Edit employee data</h2>
<hr>

<form action="/employees/update" method="POST">


    <input name="id" type="hidden" value="<?php echo $employee->id ?>"> 

    <label for="name">Change name</label><br>
    <input class="styled-input" name="name" type="text" value="<?php echo $employee->name ?>"> <br><br>

    <label for="surname">Change surname</label><br>
    <input class="styled-input" name="surname" type="text" value="<?php echo $employee->surname ?>"> <br><br>

    <label for="degree">Change degree</label><br>
    <input class="styled-input" name="degree" type="text" value="<?php echo $employee->degree ?>"> <br><br>

    <label for="email">Change email</label><br>
    <input class="styled-input" name="email" type="text" value="<?php echo $employee->email ?>"> <br><br>

    <label for="phone">Change phone</label><br>
    <input class="styled-input" name="phone" type="text" value="<?php echo $employee->phone ?>"> <br><br>

    <label for="salary">Change salary</label><br>
    <input class="styled-input" name="salary" type="text" value="<?php echo $employee->salary ?>"> <br><br>

    <select class="styled-input" name="jobposition_id" id="jobposition_id">

        <?php
            foreach($jobpositions as $jobposition)
            {
                echo '<option value="';
                echo $jobposition->id.'"';
                if ($employee->jobposition_id == $jobposition->id) {echo 'selected>';} else {echo '>';}
                echo $jobposition->name;
                echo '</option>';
            }
        ?>
        
    </select> <br><br>

    <button class="green_button" type="submit">Confirm Update</button>

</form>