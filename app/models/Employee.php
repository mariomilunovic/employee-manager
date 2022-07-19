<?php

    namespace App\models; 

    use App\models\JobPosition;       

    class Employee
    {        
        public string $name;
        public string $surname;
        public string $degree;
        public string $email;
        public string $phone;
        public JobPosition $jobposition;     
    }