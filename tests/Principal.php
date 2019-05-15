<?php
namespace  Tests;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Tests\Home;

class Principal {
    protected $navegador;
    public $mensagem;

    public function __construct($navegador){
        $this->navegador = $navegador;
       
    }

    public function abrirLogin(){
        $this->navegador->findElement(WebDriverBy::linkText('ENTRAR'))->click();
        return $this;
    }

    public function preencherLogin($nome, $password){
        $this->navegador
			->findElement(WebDriverBy::cssSelector('input[name="username"]'))
			->sendKeys($nome);
		
		$this->navegador
			->findElement(WebDriverBy::cssSelector('input[name="password"]'))
            ->sendKeys($password);
            
        return $this;
    }

    public function efetuarLogin(){
        $this->navegador
			->findElement(WebDriverBy::cssSelector('.sg-button-primary--alt'))
            ->click();
        $wait = new WebDriverWait($this->navegador, 9, 500);
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('/html/body/div[6]/section/div[1]/div/div/div/div[3]/div[1]/div/div/div[1]/div[2]/a/h1'))
            );

        $msg = $this->navegador
            ->findElement(WebDriverBy::xpath('/html/body/div[6]/section/div[1]/div/div/div/div[3]/div[1]/div/div/div[1]/div[2]/a/h1'))
            ->getText();
        $this->mensagem = $msg;
        
        return new Home($this->navegador);
    }

    
}