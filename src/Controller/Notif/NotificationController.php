<?php

namespace App\Controller\Notif;


use FOS\RestBundle\View\View;
use Doctrine\ORM\EntityManager;
use App\Repository\User\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Notif\NotificationRepository;
use App\Repository\Notif\NotificationUserRepository;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Notification controller.
 *
 * @Route("/api")
 */
class NotificationController extends AbstractController
{

    public $listOfSharableContent;

    public function __construct(){

        $this->listOfSharableContent = [
            'album'     => \App\Entity\Music\Album::class,
            'playlist'  => \App\Entity\Music\Playlist::class,
            'track'     => \App\Entity\Music\Track::class,
            'user'      => \App\Entity\User\User::class,
            'podcast'   => \App\Entity\Music\Podcast::class,
        ];
    }
    /**
     * Liste des Notifications.
     * @FOSRest\Get(path= "/notifications", name="notif_get_all")
     * @FOSRest\View(
     *     populateDefaultVars=false,
     *     serializerGroups = {"listNotifs"}
     * )
     *
     */
    public function getNotifsAction(UserRepository $userRepo, NotificationUserRepository $nuRepo, EntityManagerInterface $em)
    {
        $datas = [];
        $user = $userRepo->find(1); // on est l'utilisateur 1 pour la demo
        $countAllNotifs = $nuRepo->findListForCounting($user);
        $datas['notifications_count'] = $countAllNotifs;
        if($countAllNotifs<1){
            $datas['message'] = "Aucune notification pour l'instant";
           return View::create($datas, Response::HTTP_OK, []);
        }
        $countAllNotifsNotSeen = $nuRepo->findListForCounting($user, true);
        $notifs = $nuRepo->findList($user);
        foreach($notifs as $notif){
            if($notif->getNotification()->getSharedRef() && $notif->getNotification()->getSharedId() && array_key_exists($notif->getNotification()->getSharedRef(),$this->listOfSharableContent)){
                $content = $em->getRepository($this->listOfSharableContent[$notif->getNotification()->getSharedRef()])->findOneForListNotifs($notif->getNotification()->getSharedId());
                if($content){
                    $notif->getNotification()->setSharedContent($content);
                } 
            }
        }

        $datas['notifications_count_not_seen'] = $countAllNotifsNotSeen;        
        $datas['user'] = $user;
        $datas['notifications'] = $notifs;
        return View::create($datas, Response::HTTP_OK, []);
    }

    /**
     * Set manually seen notif by user.
     * @FOSRest\Post(path="/notification/seen", name="notif_post_one")
     */
    public function postNotifSeen(Request $request, UserRepository $userRepo, NotificationRepository $nRepo, NotificationUserRepository $nuRepo, EntityManagerInterface $em)
    {
        $user = $userRepo->find(1);

        $notifId = (int) $request->get('id');
        if($notifId<0){
            return View::create(['message'=>'Opération impossible'], Response::HTTP_METHOD_NOT_ALLOWED, []);
        }
        $notif = $nRepo->find($notifId);
        
        $notif = $nuRepo->findBy(['user'=>$user,'notification'=>$notif]);
        if($notif && $notif[0]->getSeen()===false){
            $notif[0]->setSeen(1);
            $em->persist($notif[0]);
            $em->flush();
        }else{
            return View::create(['message'=>'Opération impossible'], Response::HTTP_METHOD_NOT_ALLOWED, []);
        }

        return View::create(null, Response::HTTP_NO_CONTENT, []);
    }

}
