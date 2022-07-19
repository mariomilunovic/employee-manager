<?php

namespace App\controllers;

use App\View;
use App\models\Employee;
use App\models\JobPosition;
use App\database\DB;

class SearchController
{
    public function search()
    {
        
        //basic data validation
        if(isset($_POST['search']) && trim($_POST['search']) !== "")
        {                  
            $search=$_POST['search'];
        }  
        else
        {            
            header('location:/');
            $_SESSION["msg"]='Please enter search term!';
            exit;
        }         

        //search for employees
        $employees = [];
        
        $db = DB::getInstance();        

        $statement_employee = $db->pdo->prepare(
                       'SELECT
                                e.id,
                                e.name,
                                e.surname,
                                e.degree,
                                e.email,
                                e.phone,
                                e.salary,
                                j.id as jobposition_id,
                                j.name as jobposition_name,
                                j.salary as jobposition_salary 

                        FROM employees e 

                            LEFT JOIN jobpositions j

                                ON e.jobposition_id = j.id

                        WHERE       
                                e.name LIKE :name  OR
                                e.surname LIKE :surname OR
                                e.degree LIKE :degree OR
                                e.email LIKE :email OR
                                e.phone LIKE :phone OR
                                e.salary LIKE :salary OR
                                j.name LIKE :jobposition_name            
        ');
            
            $keyword = '%' . $search . '%';

            $statement_employee->execute([
                'name'=>$keyword,
                'surname'=>$keyword,
                'degree'=>$keyword, 
                'email'=>$keyword, 
                'phone'=>$keyword,  
                'salary'=>$keyword,
                'jobposition_name'=>$keyword              
            ]);
            
       
            while ($row_employee = $statement_employee->fetch())
            {
    
                $employee = new Employee();            
                    $employee->surname = $row_employee['surname'];
                    $employee->degree = $row_employee['degree'];
                    $employee->name = $row_employee['name'];
                    $employee->email = $row_employee['email'];
                    $employee->phone = $row_employee['phone'];
                    $employee->id = $row_employee['id'];
                    $employee->salary = $row_employee['salary'];

                $jobposition = new JobPosition();
                    $jobposition->id = $row_employee['jobposition_id'];
                    $jobposition->name = $row_employee['jobposition_name'];
                    $jobposition->salary = $row_employee['jobposition_salary'];  

              
                $employee->jobposition = $jobposition; 

                //create array of Employee objects
                $employees[] = $employee;
            }


        //search for job positions        
        $jobpositions = [];
        
        $db = DB::getInstance();        

        $statement_jobposition = $db->pdo->prepare(
                       'SELECT * 

                        FROM jobpositions                           

                        WHERE       
                                name LIKE :name  OR                               
                                salary LIKE :salary                                         
        ');
            
        $keyword = '%' . $search . '%';

        $statement_jobposition->execute([
            'name'=>$keyword,               
            'salary'=>$keyword,                            
        ]);
       
        while ($row_jobposition = $statement_jobposition->fetch())
        {
            $jobposition = new JobPosition();    
                $jobposition->id = $row_jobposition['id']; 
                $jobposition->name = $row_jobposition['name'];                   
                $jobposition->salary = $row_jobposition['salary'];   

            //create array of job position objects
            $jobpositions[] = $jobposition;
        }

        echo (new View('search/result',['employees'=>$employees],['jobpositions'=>$jobpositions]))->render();
    } 

    
}