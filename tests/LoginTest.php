<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Validation;

class LoginTest extends WebTestCase
{


    public function testPasswordValide(): void
    {
        
        $validator = Validation::createValidator();
        $password = 'testPassword';
    
        $constraint = new Regex([
            'pattern' => '/^(?=.*[a-z])$/',
        ]);
    
        $violations = $validator->validate($password, $constraint);
    
        $this->assertCount(1, $violations);
        
    }

    
    public function testPasswordInvalide(): void
    {
        
        $validator = Validation::createValidator();
        $password = '';
    
        $constraint = new Regex([
            'pattern' => '/^(?=.*[a-z])$/',
        ]);
    
        $violations = $validator->validate($password, $constraint);
    
        $this->assertCount(0, $violations);
        
    }
}