<?php

declare (strict_types=1);

namespace App\controllers;

// require_once '/var/www/html/employee_manager/app/models/Employee.php';

use App\View;
use App\database\DB;
use App\models\Employee;
use App\models\JobPosition;

class EmployeeController
{

    public function index()
    {
        $employees = [];
        try
        {
            $db = DB::getInstance();

            $query = 'SELECT e.id, e.name, e.surname,e.degree,e.email,e.phone,j.id 
            as jobposition_id, j.name as job,j.salary 
            FROM employees e 
                LEFT JOIN jobpositions j
                    ON e.jobposition_id = j.id';
            
            $statement_employee = $db->pdo->query($query);
       
            while ($row_employee = $statement_employee->fetch())
            {
    
                $employee = new Employee();            
                $employee->id = $row_employee['id'];
                $employee->name = $row_employee['name'];
                $employee->surname = $row_employee['surname'];
                $employee->degree = $row_employee['degree'];
                $employee->email = $row_employee['email'];
                $employee->phone = $row_employee['phone'];

                $jobposition = new JobPosition();

                //check if Employee has dedicated Job Position
                if ($row_employee['jobposition_id'])
                {            
                    $jobposition->id = $row_employee['jobposition_id'];
                    $jobposition->name = $row_employee['job'];
                    $jobposition->salary = $row_employee['salary'];       
                }
           
                $employee->jobposition = $jobposition; 

                //create array of Employee objects
                $employees[] = $employee;
            }

        } 
        catch (\PDOException $e)
        {
            header('location:/db_options');
            $_SESSION["msg"]='Database error!';
            exit;
        }

        echo ((new View('employees/index',['employees'=>$employees]))->render());   
            
    }

                 
        


    public function show()
    {
        
    }

    public function create()
    {
        $jobpositions = [];
        
        $db = DB::getInstance();
        
        $query = 'SELECT * FROM jobpositions';

        $statement_jobposition = $db->pdo->query($query);
       
        while ($row_jobposition = $statement_jobposition->fetch())
        {
    
            $jobposition = new jobposition();            
            $jobposition->id = $row_jobposition['id'];
            $jobposition->name = $row_jobposition['name'];
            $jobposition->surname = $row_jobposition['salary'];            

            $jobpositions[]=$jobposition;
        }
        echo (new View('employees/create',['jobpositions'=>$jobpositions]))->render();      
                        
    }

    public function store()
    {
        // echo '<pre>';
        // print_r ($_POST);
        // echo '</pre>';
        // exit;

        if(isset($_POST['name']) && trim($_POST['name']) !== "")
        {                  
            $name=$_POST['name'];
        }  
        else
        {            
            header('location:/employees/create');
            $_SESSION["msg"]='Please enter valid name!';
            exit;
        }     
        
        if(isset($_POST['surname']) && trim($_POST['surname']) !== "")
        {                  
            $surname=$_POST['surname'];
        }  
        else
        {            
            header('location:/employees/create');
            $_SESSION["msg"]='Please enter valid surname!';
            exit;
        }  
        
        if(isset($_POST['degree']) && trim($_POST['degree']) !== "")
        {                  
            $degree=$_POST['degree'];
        }  
        else
        {            
            header('location:/employees/create');
            $_SESSION["msg"]='Please enter valid degree!';
            exit;
        } 

        if(isset($_POST['email']) && trim($_POST['email']) !== "")
        {                  
            $email=$_POST['email'];
        }  
        else
        {            
            header('location:/employees/create');
            $_SESSION["msg"]='Please enter valid email!';
            exit;
        } 

        if(isset($_POST['phone']) && trim($_POST['phone']) !== "")
        {                  
            $phone=$_POST['phone'];
        }  
        else
        {            
            header('location:/employees/create');
            $_SESSION["msg"]='Please enter valid phone!';
            exit;
        } 

        if(isset($_POST['jobposition_id']) && trim($_POST['jobposition_id']) !== "")
        {                  
            $jobposition_id=$_POST['jobposition_id'];
        }  
        else
        {            
            header('location:/employees/create');
            $_SESSION["msg"]='Please enter valid phone!';
            exit;
        } 

        if ($name!=="" && $surname!=="" && $degree!=="" && $email!=="" && $phone!=="" && $jobposition_id!=="")
        {
            try {   

                $db = DB::getInstance();
                $statement = $db->pdo->prepare("INSERT INTO
                 employees (name, surname, degree, email, phone, jobposition_id) 
                 VALUES (:name, :surname, :degree, :email, :phone, :jobposition_id)");
                $statement->execute([
                    'name'=>$name,
                    'surname'=>$surname,
                    'degree'=>$degree, 
                    'email'=>$email, 
                    'phone'=>$phone,  
                    'jobposition_id'=>$jobposition_id
                ]);

            } catch (\PDOException $e) {
            
                header('location:/employees/create');
                $_SESSION["msg"]=$e->getMessage();
                exit;

            }
            header('location:/employees');
            $_SESSION["msg"]='Employee is successfully created!';
        }     




    }

    public function edit()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        
        try {
        
            $db = DB::getInstance();

            //get employee by id
            $statement = $db->pdo->prepare("SELECT * FROM employees WHERE id = ?");
            $statement->execute([$id]);
            $row =  $statement->fetch();

            $employee = new Employee();
            $employee->id = $row['id'];
            $employee->name = $row['name'];
            $employee->surname = $row['surname'];
            $employee->degree = $row['degree'];
            $employee->email = $row['email'];
            $employee->phone = $row['phone'];
            $employee->jobposition_id = $row['jobposition_id'];

            //get all job positions
            $query = 'SELECT * FROM jobpositions';
            $statement_jobposition = $db->pdo->query($query);       
            while ($row_jobposition = $statement_jobposition->fetch())
            {    
                $jobposition = new jobposition();            
                $jobposition->id = $row_jobposition['id'];
                $jobposition->name = $row_jobposition['name'];
                $jobposition->surname = $row_jobposition['salary'];            

                $jobpositions[]=$jobposition;
            }


        } catch (\PDOException $e) {
            header('location:/employees/edit');
            $_SESSION["msg"]='Database error!';
            exit;
        }    

        // echo '<pre>';
        // print_r($jobpositions);
        // echo '</pre>';

        echo (new View('employees/update',['employee'=>$employee],['jobpositions'=>$jobpositions]))->render();
    }



    public function update()
    {
        // echo '<pre>';
        // print_r ($_POST);
        // echo '</pre>';
        // exit;


        if(isset($_POST['id']) && trim($_POST['id']) !== "")
        {                  
            $id=$_POST['id'];
        }  
        else
        {            
            header('location:/employees/create');
            $_SESSION["msg"]='Something went wrong! Try again.';
            exit;
        }  

        if(isset($_POST['name']) && trim($_POST['name']) !== "")
        {                  
            $name=$_POST['name'];
        }  
        else
        {            
            header('location:/employees/create');
            $_SESSION["msg"]='Please enter valid name!';
            exit;
        }     
        
        if(isset($_POST['surname']) && trim($_POST['surname']) !== "")
        {                  
            $surname=$_POST['surname'];
        }  
        else
        {            
            header('location:/employees/create');
            $_SESSION["msg"]='Please enter valid surname!';
            exit;
        }  
        
        if(isset($_POST['degree']) && trim($_POST['degree']) !== "")
        {                  
            $degree=$_POST['degree'];
        }  
        else
        {            
            header('location:/employees/create');
            $_SESSION["msg"]='Please enter valid degree!';
            exit;
        } 

        if(isset($_POST['email']) && trim($_POST['email']) !== "")
        {                  
            $email=$_POST['email'];
        }  
        else
        {            
            header('location:/employees/create');
            $_SESSION["msg"]='Please enter valid email!';
            exit;
        } 

        if(isset($_POST['phone']) && trim($_POST['phone']) !== "")
        {                  
            $phone=$_POST['phone'];
        }  
        else
        {            
            header('location:/employees/create');
            $_SESSION["msg"]='Please enter valid phone!';
            exit;
        } 

        if(isset($_POST['jobposition_id']) && trim($_POST['jobposition_id']) !== "")
        {                  
            $jobposition_id=$_POST['jobposition_id'];
        }  
        else
        {            
            header('location:/employees/create');
            $_SESSION["msg"]='Please enter valid phone!';
            exit;
        } 

        if ($id!=="" && $name!=="" && $surname!=="" && $degree!=="" && $email!=="" && $phone!=="" && $jobposition_id!=="")
        {
            try {   

                $db = DB::getInstance();

                $statement = $db->pdo->prepare("UPDATE employees SET
                    name=:name,
                    surname=:surname,
                    degree=:degree,
                    email=:email,
                    phone=:phone,
                    jobposition_id=:jobposition_id
                    WHERE id=:id
                ");

                $statement->execute([
                    'id'=>$id,
                    'name'=>$name,
                    'surname'=>$surname,
                    'degree'=>$degree, 
                    'email'=>$email, 
                    'phone'=>$phone,  
                    'jobposition_id'=>$jobposition_id
                ]);

            } catch (\PDOException $e) {
            
                header('location:/employees/create');
                $_SESSION["msg"]=$e->getMessage();
                exit;

            }
            header('location:/employees');
            $_SESSION["msg"]='Employee is successfully updated!';
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
            $statement = $db->pdo->prepare("SELECT * FROM employees WHERE id = ?");
            $statement->execute([$id]);
            $row = $statement->fetch();

            $employee = new Employee();
            $employee->id = $row['id'];
            $employee->name = $row['name'];
            $employee->surname = $row['surname'];
            $employee->degree = $row['degree'];
            $employee->email = $row['email'];
            $employee->phone = $row['phone'];
                    

        } catch (\PDOException $e) {

            $message = $e->getMessage();
        }
        
        echo (new View('employees/delete',['employee'=>$employee]))->render();
    }

    public function destroy()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }

        try {
        
            $db = DB::getInstance();
            $statement = $db->pdo->prepare("DELETE FROM employees WHERE id = ?");
        
            $statement->execute([$id]);

        } catch (\PDOException $e)
        {            
            header('location:/employees');
            $_SESSION["msg"]='ERROR: Employee is not deleted!';
            exit;
        }
        header('location:/employees');
        $_SESSION["msg"]='Employee successfully deleted!';
        
    }
}