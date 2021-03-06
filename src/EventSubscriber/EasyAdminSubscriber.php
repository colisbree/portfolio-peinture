<?php
namespace App\EventSubscriber;

use App\Entity\Blogpost;
use App\Entity\Peinture;
use DateTime;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\Security\Core\Security;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $slugger;
    private $security;

    public function __construct(SluggerInterface $slugger, Security $security)
    {
        $this -> slugger = $slugger;
        $this -> security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            // ecoute les événements avant qu'une entité soit persistée et on l'envoi dans une fonction nommée setBlogpostSlugAndDateAndUser
            BeforeEntityPersistedEvent::class => ['setDateAndUser'],
        ];
    }

    public function setDateAndUser(BeforeEntityPersistedEvent $event)
    {
        // $entity récupère l'objet blogpost
        $entity = $event -> getEntityInstance();

        // on vérifie que l'objet appartient bien à Blogpost car l'écoute se fait sur tous les événements et pas seulement sur blogpost
        if (($entity instanceof Blogpost)) {
            
            //génération de la date
            $now = new DateTime('now');
            $entity -> setCreatedAt($now);
    
            // récupération de l'utilisateur courant
            $user = $this -> security -> getUser();
            $entity -> setUser($user);
        }

        if (($entity instanceof Peinture)) {
            
            //génération de la date
            $now = new DateTime('now');
            $entity -> setCreatedAt($now);
    
            // récupération de l'utilisateur courant
            $user = $this -> security -> getUser();
            $entity -> setUser($user);
        }

        return;

    }
}
