<?php

namespace App\Repository\RepoInterface;

interface SpecListnotifInterface
{
    /**
     * Function utilisé dans le notificationController pour récupérer les shared_content en relation polymorphique
     * On utilise cette fonction dans chacun des repository concernés en remplacement de la simple function "find" de symfony
     * La raison etant de faire les jointures en DQL pour éviter le lazy loading à répétition sur les enfants des shared_content
     *
     * @param integer $id
     * @return instance of class 
     */
    public function findOneForListNotifs(int $id);
}
