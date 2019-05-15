<?php
namespace  Tests;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;


class Home {
    protected $navegador;
    public $mensagem;

    public function __construct($navegador){
        $this->navegador = $navegador;
       
    }

    public function editarPerfil(){
        $this->navegador->findElement(WebDriverBy::xpath('/html/body/div[6]/section/header/div[2]/div/div[3]/div/div[4]/nav/div[4]/div/div[1]'))->click();
        return $this;
    }

    public function editarPerfilAcesso(){
        $this->navegador->findElement(WebDriverBy::xpath('/html/body/div[6]/section/header/div[2]/div/div[3]/div/div[4]/nav/div[4]/div/div[2]/ul/li[2]/a'))->click();
        return $this;
    }

    public function editarPerfilEmail(){
        $this->navegador->findElement(WebDriverBy::xpath('//*[@id="content-old"]/div[1]/div[2]/ul/li[4]/a/span[1]'))->click();
        return $this;
    }

    public function editarEmailForm($email, $password){
        $this->navegador
			->findElement(WebDriverBy::xpath('//*[@id="UserEditForm"]/fieldset[2]/div[1]/div/input'))
			->sendKeys($password);
		
		$this->navegador
			->findElement(WebDriverBy::xpath('//*[@id="UserUsername"]'))
            ->sendKeys($email);
            
        return $this;
    }
    public function editarEmail(){
        $this->navegador->findElement(WebDriverBy::xpath('//*[@id="UserEditForm"]/div/input[@value = "Alterar!"]'))
                        ->click();

        $wait = new WebDriverWait($this->navegador, 9, 500);
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('/html/body/div[6]/section/header/div[1]/div/div/div'))
            );

        $msg = $this->navegador
            ->findElement(WebDriverBy::xpath('/html/body/div[6]/section/header/div[1]/div/div/div'))
            ->getText();
        $this->mensagem = $msg;

        $this->navegador->takeScreenshot('evidencies/screenshot.jpg');
        return $this;
    }
}

//