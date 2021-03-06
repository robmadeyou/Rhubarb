<?php

namespace Rhubarb\Crown\Tests\Deployment;

use Rhubarb\Crown\Deployment\RelocationResourceDeploymentProvider;
use Rhubarb\Crown\Tests\RhubarbTestCase;

class RelocationResourceDeploymentHandlerTest extends RhubarbTestCase
{
    public function testUrlCreated()
    {
        $deploymentPackage = new RelocationResourceDeploymentProvider();
        $url = $deploymentPackage->getDeployedResourceUrl(__FILE__);

        $cwd = getcwd();
        $deployedUrl = "/deployed/" . str_replace("\\", "/", str_replace($cwd, "", __FILE__));

        $this->assertEquals($deployedUrl, $url);
    }

    public function testDeploymentCopiesFiles()
    {
        $cwd = getcwd();

        $deploymentPackage = new RelocationResourceDeploymentProvider();
        $deploymentPackage->deployResource(__FILE__);

        $deployedFile = "deployed/" . str_replace($cwd, "", __FILE__);

        $this->assertFileExists($deployedFile);

        unlink($deployedFile);
    }

    public function testDeploymentThrowsExceptions()
    {
        $this->setExpectedException("Rhubarb\Crown\Exceptions\DeploymentException");

        $deploymentPackage = new RelocationResourceDeploymentProvider();
        $deploymentPackage->deployResource("a/b/c.txt");
    }

    public function testDeploymentCreateFiles()
    {
        $deploymentPackage = new RelocationResourceDeploymentProvider();
        $deploymentPackage->deployResourceContent("This is a test", "temp/folder/file.txt");

        $deployedFile = "deployed/temp/folder/file.txt";

        $this->assertFileExists($deployedFile);

        $content = file_get_contents($deployedFile);

        $this->assertEquals("This is a test", $content);

        unlink($deployedFile);
    }
}
