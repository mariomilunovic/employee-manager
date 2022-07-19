<?php

namespace App\controllers;

use App\View;
use App\database\DB;
use App\models\JobPosition;

class JobPositionController
{
    public function index()
    {
        $jobpositions = [];

        try
        {
            $db = DB::getInstance();

            $query = 'SELECT * FROM jobpositions';

            $statement = $db->pdo->query($query);
       
            while ($row = $statement->fetch())
            {                
                $jobposition = new JobPosition();
                $jobposition->id = $row['id'];
                $jobposition->name = $row['name'];
                $jobposition->salary = $row['salary'];          

                $jobpositions[] = $jobposition;
            }
        }
        catch (\PDOException $e)
        {
            header('location:/db_options');
            $_SESSION["msg"]='Database error!';
            exit;
        }

        echo (new View('jobpositions/index',['jobpositions'=>$jobpositions]))->render();        
    }   

    public function create()
    {
        echo (new View('jobpositions/create'))->render();
    }

    public function edit()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        
        try {
        
            $db = DB::getInstance();
            $statement = $db->pdo->prepare("SELECT * FROM jobpositions WHERE id = ?");
            $statement->execute([$id]);
            $row =  $statement->fetch();

            $jobposition = new JobPosition();
            $jobposition->id = $row['id'];
            $jobposition->name = $row['name'];
            $jobposition->salary = $row['salary'];

        } catch (\PDOException $e) {
            header('location:/jobpositions/edit');
            $_SESSION["msg"]='Database error!';
            exit;
        }     

        echo (new View('jobpositions/update',['jobposition'=>$jobposition]))->render();
    }

    public function update()
    {

        if(isset($_POST['id']) && trim($_POST['id']) !== "")
        {                  
            $id=$_POST['id'];
            $location = '/jobpositions/edit?id='.$id; 
        }  
        else
        {    
            $_SESSION["msg"]='Something went wrong!';
            exit;
        }  
              
        if(isset($_POST['name']) && trim($_POST['name']) !== "")
        {                  
            $name=$_POST['name'];
        }  
        else
        {            
            header("location:$location");
            $_SESSION["msg"]='Please enter valid name!';
            exit;
        }     
        
        if(isset($_POST['salary']) && trim($_POST['salary']) !== "" && is_numeric($_POST['salary']))
        {                   
            $salary=$_POST['salary'];
        }  
        else
        {            
            header("location:$location");
            $_SESSION["msg"]='Please enter valid salary!';
            exit;
        }         

        
        if ($name!=="" && $salary!=="")
        {
            try {   

                $db = DB::getInstance();
                $statement = $db->pdo->prepare("UPDATE jobpositions SET name=:name, salary=:salary WHERE id=:id");
                $statement->execute([
                    'id'=>$id,
                    'name'=>$name,
                    'salary'=>$salary        
                ]);

            } catch (\PDOException $e) {
            
                header("location:$location");
                $_SESSION["msg"]='Database error!';
                exit;

            }
            header('location:/jobpositions');
            $_SESSION["msg"]='Job position is successfully updated!';
        }        
        
    }

    public function store()
    {
              
        if(isset($_POST['name']) && trim($_POST['name']) !== "")
        {                  
            $name=$_POST['name'];
        }  
        else
        {            
           
            $_SESSION["msg"]='Please enter valid name!';
            $this->create();
            exit;
        }     
        
        if(isset($_POST['salary']) && trim($_POST['salary']) !== "" && is_numeric($_POST['salary']))
        {                   
            $salary=$_POST['salary'];
        }  
        else
        {    
            $_SESSION["msg"]='Please enter valid salary!';
            $this->create();
            exit;
        }         

        
        if ($name!=="" && $salary!=="")
        {
            try {   

                $db = DB::getInstance();
                $statement = $db->pdo->prepare("INSERT INTO jobpositions (name, salary) VALUES (:name,:salary)");
                $statement->execute([
                    'name'=>$name,
                    'salary'=>$salary        
                ]);

            } catch (\PDOException $e) {
            
                header('location:/jobpositions/create');
                $_SESSION["msg"]=$e->getMessage();
                exit;

            }
            header('location:/jobpositions');
            $_SESSION["msg"]='Job position is successfully created!';
        }        
        
    }

    public function delete()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }

        try {
        
            $db = DB::getInstance();
            $statement = $db->pdo->prepare("SELECT * FROM jobpositions WHERE id = ?");
            $statement->execute([$id]);
            $row =  $statement->fetch();

            $jobposition = new JobPosition();
            $jobposition->id = $row['id'];
            $jobposition->name = $row['name'];
            $jobposition->salary = $row['salary'];

        } catch (\PDOException $e) {

            $_SESSION["msg"]=$e->getMessage();
            exit;
        }
        
        echo (new View('jobpositions/delete',['jobposition'=>$jobposition]))->render();
    }

    public function destroy()
    {   
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        try{
        $db = DB::getInstance();
        $statement = $db->pdo->prepare("DELETE FROM jobpositions WHERE id = ?");
        
            $statement->execute([$id]);

        } catch (\PDOException $e)
        {            
            header('location:/jobpositions');
            $_SESSION["msg"]='WARNING: This job position cannot be deleted!';
            exit;
        }
        header('location:/jobpositions');
        $_SESSION["msg"]='Job Position successfully deleted!';
      
    }
}