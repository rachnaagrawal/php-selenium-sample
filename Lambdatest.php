<?php


require_once('C:/PHP7/vendor/autoload.php');

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\Assert;


/*
    LambdaTest selenium automation sample example
    Configuration
    ----------
    username: Username can be found at automation dashboard
    accessToken:  AccessToken can be generated from automation dashboard or profile section

    Result
    -------
    Execute PHP Automation Tests on LambdaTest Distributed Selenium Grid 
*/

 # username: Username can be found at automation dashboard		
    $LT_USERNAME = getenv("rachna10r@gmail.com");
    
    # accessKey:  AccessKey can be generated from automation dashboard or profile section
    $LT_ACCESS_KEY = getenv("z71l7Q9ohS9HhKiCqd690mH0sDu5AYrz8VSB0whO3mZ2JEkNAN");

    $host= "http://". $LT_USERNAME .":" . $LT_ACCESS_KEY ."@hub.lambdatest.com/wd/hub";

    $result="passed";

     $capabilities = array(
		"build" => "Sample PHP Build",
		"name" => "Sample PHP Test",
		"platform" => $LT_OPERATING_SYSTEM,
		"browserName" => $LT_BROWSER_NAME,
		"version" => $LT_BROWSER_VERSION
     );
     
      try{
           $driver = RemoteWebDriver::create($host, $capabilities);
        
        $driver->get("https://www.google.com/ncr");
      
        $element = $driver->findElement(WebDriverBy::name("q"));

          if($element) 
        {
        $element->sendKeys("LambdaTest");
        $element->submit();
        Assert::assertEquals($driver->getTitle(),'LambdaTest - Google Search');
        }
        } catch(Exception $e) {
            $result="failed";
            print  "Test failed with reason ".$e->getMessage();
        }
        finally{
            // finally quit the driver
            $driver->executeScript("lambda-status=".($result == "passed" ? "passed":"failed"));
            $driver->quit();
    }
?>
