<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\ContactService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, ContactService $contactService): Response
    {
        $contact = new Contact();                                   // creation du contact
        $form = $this -> createForm(ContactType::class, $contact);  // creation du formulaire
        $form -> handleRequest($request);                           // on regarde s'il y a quelque chose qui concerne le formulaire

        if ($form->isSubmitted() && ($form->isValid())) {             // regarde si c'est la première fois qu'on affiche le formulaire ? Et si non est-il valid ?
            $contact = $form -> getData();                          // on lit des données du formulaire

            $contactService -> persistContact($contact);            // on execute la logique mis dans le fichier Service\ContactService.php

            return $this -> redirectToRoute('contact');             // après soumission du formulaire on recharge la page contact
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form -> createView(),                        // envoi le formulaire à la vue twig
        ]);
    }
}
