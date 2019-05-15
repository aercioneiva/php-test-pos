<?php
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

use Tests\Principal;

class Teste extends TestCase{

     private $navegador;

    public function setUp():void{
        $browserStack = 'http://aercioferreirane1:FMxZ75JLXeyqoHBfHf6U@hub-cloud.browserstack.com/wd/hub';
        $this->navegador = RemoteWebDriver::create($browserStack, array(
        "browser" => "Chrome",
        "browser_version" => "73.0",
        "os" => "Windows",
        "os_version" => "10",
        "resolution" => "1280x800"
        ));
        
        
        $this->navegador->get('https://brainly.com.br/');
        $this->navegador->manage()->window()->maximize();
		$this->navegador->manage()->timeouts()->implicitlyWait(5);

    }

    protected function tearDown() : void {
		$this->navegador->quit();
    }

    public static function dataDoSigninUsingAnExistentUser() {
      return array(
        'Teste de Login' => array('aercioneiva', 'mudar123', 'aercioneiva')
      );

      return $data;
    }

    public static function dataDoSigninUsingAnExistentUserEmail() {
        return array(
          'Teste de Login' => array('aercioneiva', 'mudar123', 'aercio@rbxsoft.com','Enviámos um link de ativação para o seu novo e-mail.Enquanto você não confirmar o novo, usaremos o seu e-mail antigo!')
        );
  
        return $data;
      }

    /**
    * @dataProvider dataDoSigninUsingAnExistentUser
    */
    public function testLogin($login,$senha,$msg){
      
        $pagina = new Principal($this->navegador);
        $pagina->abrirLogin()
               ->preencherLogin($login, $senha)
               ->efetuarLogin();
        $this->assertEquals($pagina->mensagem, $msg);
    }
    

    /**
    * @dataProvider dataDoSigninUsingAnExistentUserEmail
    */
    public function testChageEmail($login,$senha,$email,$msg){
      
        $pagina = new Principal($this->navegador);
        $home = $pagina->abrirLogin()
               ->preencherLogin($login, $senha)
               ->efetuarLogin()
               ->editarPerfil()
               ->editarPerfilAcesso()
               ->editarPerfilEmail()
               ->editarEmailForm($email, $senha)
               ->editarEmail();

        echo PHP_EOL.$home->mensagem.PHP_EOL;

        $this->assertEquals($msg, $home->mensagem);
    }
    //Enviámos um link de ativação para o seu novo e-mail.Enquanto você não confirmar o novo, usaremos o seu e-mail antigo!

}
?>