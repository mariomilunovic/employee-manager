<h2>Edit job position</h2>

<hr>

<form action="/jobpositions/update" method="POST">


    <input name="id" type="hidden" value="<?php echo $jobposition->id ?>"> 

    <label for="name">Change name</label><br>
    <input class="styled-input" name="name" type="text" value="<?php echo $jobposition->name ?>"> <br><br>

    <label for="salary">Change salary</label><br>
    <input class="styled-input" name="salary" type="text" value="<?php echo $jobposition->salary ?>"> <br><br>

    <button class="green_button" type="submit">Confirm Update</button>

</form>