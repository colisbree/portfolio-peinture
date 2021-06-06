<?php
namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserCommand extends Command
{
    private $entityManagerInferface;
    private $encoder;
    protected static $defaulName = 'app:create-user';  // cette commande est appelée dans la console => symfony console app:create-user

    public function __construct(
        EntityManagerInterface $entityManagerInferface,
        UserPasswordEncoderInterface $encoder       // hash du mdp
    )
    {
        $this -> entityManagerInferface = $entityManagerInferface;  // pour persister l'utilisateur
        $this -> encoder = $encoder;
        parent::__construct();
    }

    protected function configure():void
    {
        $this   -> addArgument('username', InputArgument::REQUIRED, 'The Username of the User')
                -> addArgument('password', InputArgument::REQUIRED, 'The PAssword of the User')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)  // logique exécutée après le lancement de la ligne de commande ci-au-dessus
    {
        
        $user = new User();

        $user -> setEmail($input->getArgument('username'));

        $password = $this -> encoder -> encodePassword($user, $input -> getArgument('password'));
        $user -> setPassword($password);
        
        $user   -> setRoles(['ROLE_PEINTRE'])
                -> setPrenom('')
                -> setNom('')
                -> setTelephone('');
        
        dump($user);

        $this -> entityManagerInferface -> persist($user);
        $this -> entityManagerInferface -> flush();

        return Command::SUCCESS;
    }
}