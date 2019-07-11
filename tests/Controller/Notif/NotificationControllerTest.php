<?php

namespace App\Tests\Controller\Notif;

use PHPUnit\Framework\TestCase;
use App\Controller\Notif\NotificationController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NotificationControllerTest extends WebTestCase
{

    private $sharableContent;

    protected function setUp(){
        parent::setUp();
        $this->sharableContent = ['album','playlist','track','user','podcast'];
    }
    /**
     * @test
     */
    public function routing_getNotifsAction(){

        $client = static::createClient();
        $crawler = $client->request('GET','/api/notifications');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());

    }

    /**
     * @test
     */
    public function routing_postNotifSeen(){

        $client = static::createClient();
        $crawler = $client->request('POST','/api/notification/seen', ['id' => 1]);
        $validCode = [204,405];
        $this->assertEquals(true,in_array($client->getResponse()->getStatusCode(),$validCode),'Le statusCode attendu en réponse est 204 ou 405');
        
    }

    /**
     * @test
     */
    public function getNotifsAction_return_json(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/notifications');
        $json = $this->is_json($client->getResponse()->getContent());
        $this->assertEquals(true, $json, "Doit retourner un JSON.");
    }

    /** 
     * @test 
     * Il faut tester le tableau instancié dans le constructeur, car il sert au lazy loading des contenus partagés.
     * Si un développeur s'amuse à trafiquer ce tableau, on est cuit.
     * Il faudra venir modifier ce test si une nouvelle entity devient partageable.
     * 
     * */
    public function constructor_has_specific_array(){

        $notifController = new NotificationController();
        $listOfSharableContent = $notifController->listOfSharableContent;

        $this->assertInternalType('array', $listOfSharableContent);

        $rupt = true;
        foreach($listOfSharableContent as $k => $v){
            if(!in_array($k,$this->sharableContent)){
                $rupt = false;
                break;
            }
        }

        $this->assertEquals(true,$rupt,"Une Entity non prévu est passé dans le constructor, le test ne passera pas tant qu'on en discutera pas calmement autour d'un café.");
        
    }

    /**
     * @test
     * Les sharables doivent etre des chemins vers des class;
     */
    public function sharables_are_class(){

        $notifController = new NotificationController();
        $listOfSharableContent = $notifController->listOfSharableContent;

        foreach ($listOfSharableContent as $s) {
            if (!class_exists($s)) {
                $this->assertEquals(true, false, $s . " n'existe pas en tant que class.");
            }
        }
        
        $this->assertEquals(true,true); // phpunit affiche risky si on laisse seulement l'assert dans le foreach.

    }


    private function is_json($string)
    {
        $data = json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE) ?  true : false;
    }


}