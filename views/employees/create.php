<h2>Add new employee</h2>

<hr>


<form action="/employees/create" method="POST">

    <label for="name">Enter name (required)</label><br>
    <input class="styled-input" name="name" type="text" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>"> <br><br>

    <label for="surname">Enter surname (required)</label><br>
    <input class="styled-input" name="surname" type="text" value="<?php echo isset($_POST['surname']) ? $_POST['surname'] : ''; ?>"> <br><br>

    <label for="degree">Enter degree (required)</label><br>
    <input class="styled-input" name="degree" type="text" value="<?php echo isset($_POST['degree']) ? $_POST['degree'] : ''; ?>"> <br><br>

    <label for="email">Enter email (required)</label><br>
    <input class="styled-input" name="email" type="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"> <br><br> 

    <label for="phone">Enter phone (required)</label><br>
    <input class="styled-input" name="phone" type="string" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>"> <br><br>

    <label for="salary">Enter salary (leave empty for salary defined by job position)</label><br>
    <input class="styled-input" name="salary" type="string"> <br><br>

    <label for="jobposition">Choose job position</label><br>

    <select class="styled-input" name="jobposition_id" id="jobposition_id">
        
        <?php
            echo '<option value="empty" selected>-- select job position --</option>';
            foreach($jobpositions as $jobposition)
            {
            echo '<option value="'.$jobposition->id.'">'.$jobposition->name.'</option>';
            }
        ?>
        
    </select> <br><br>
   
    <button class="green_button" type="submit">Confirm</button>

</form>