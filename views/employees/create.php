<h2>Add new employee</h2>

<hr>

<form action="/employees/create" method="POST">

    <label for="name">Enter name</label><br>
    <input id="styled-input" name="name" type="text"> <br><br>

    <label for="surname">Enter surname</label><br>
    <input name="surname" type="text"> <br><br>

    <label for="degree">Enter degree</label><br>
    <input name="degree" type="text"> <br><br>

    <label for="email">Enter email</label><br>
    <input name="email" type="email"> <br><br> 

    <label for="phone">Enter phone</label><br>
    <input name="phone" type="string"> <br><br>

    <label for="jobposition">Choose job position</label><br>

    <select name="jobposition_id" id="jobposition_id">
        
        <?php
            foreach($jobpositions as $jobposition)
            {
            echo '<option value="'.$jobposition->id.'">'.$jobposition->name.'</option>';
            }
        ?>
        
    </select> <br><br>
   
    <button class="green_button" type="submit">Confirm</button>

</form>