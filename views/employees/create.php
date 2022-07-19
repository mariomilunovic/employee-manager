<h2>Add new employee</h2>

<hr>

<form action="/employees/create" method="POST">

    <label for="name">Enter name (required)</label><br>
    <input id="styled-input" name="name" type="text"> <br><br>

    <label for="surname">Enter surname (required)</label><br>
    <input name="surname" type="text"> <br><br>

    <label for="degree">Enter degree (required)</label><br>
    <input name="degree" type="text"> <br><br>

    <label for="email">Enter email (required)</label><br>
    <input name="email" type="email"> <br><br> 

    <label for="phone">Enter phone (required)</label><br>
    <input name="phone" type="string"> <br><br>

    <label for="salary">Enter salary (leave empty for salary defined by job position)</label><br>
    <input name="salary" type="string"> <br><br>

    <label for="jobposition">Choose job position</label><br>

    <select name="jobposition_id" id="jobposition_id">
        
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