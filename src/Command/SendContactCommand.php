<?php
namespace App\Command;

// ce fichier va de pair avec le fichier Service\ContactService.php
// il permet d'envoyer les messages en différé via une tache CRON

use App\Service\ContactService;
use App\Repository\UserRepository;
use App\Repository\ContactRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class SendContactCommand extends Command
{
    private $contactRepository;
    private $mailer;
    private $contactService;
    private $UserRepository;
    protected static $defaultName = 'app:send-contact';  // pour lancer la ligne de commande => symfony console app:send-contact

    public function __construct(
        ContactRepository $contactRepository,
        MailerInterface $mailer,
        ContactService $contactService,
        UserRepository $userRepository
    ) {
        $this -> contactRepository = $contactRepository;
        $this -> mailer = $mailer;
        $this -> contactService = $contactService;
        $this -> userRepository = $userRepository;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)  // logique exécutée après le lancement de la ligne de commande ci-au-dessus
    {
        $toSend = $this -> contactRepository -> findBy(['isSend' => false]);    // récupère liste de tous les message en attente d'envoi
        
        /* bug non compris => Call to a member function getPeintre() on null
        $adress = new Address(
            $this->UserRepository->getPeintre()->getEmail(), 
            $this->UserRepository->getPeintre()->getNom(). ' ' . $this->UserRepository->getPeintre()->getPrenom()
            );
        */
        $adress = new Address('toto@toto.com','nom du Peintre');

        foreach ($toSend as $mail) {
            $email = (new Email())
                -> from($mail -> getEmail())
                -> to($adress)
                -> subject('Nouveau message de ' . $mail -> getNom())
                -> text($mail -> getMessage());

            $this -> mailer -> send($email);

            $this -> contactService -> isSend($mail);  // MAJ du contact service
        }

        return Command::SUCCESS;
    }
}
