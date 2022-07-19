<h2>Add new job position</h2>

<hr>

<form action="/jobpositions/create" method="POST">

    <label for="name">Enter name (required)</label><br>
    <input class="styled-input" name="name" type="text" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>"> <br><br>

    <label for="salary">Enter salary (required)</label><br>
    <input class="styled-input" name="salary" type="text" value="<?php echo isset($_POST['salary']) ? $_POST['salary'] : ''; ?>"> <br><br>   

    <button class="green_button" type="submit">Confirm</button>

</form>