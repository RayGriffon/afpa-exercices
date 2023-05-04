<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact.index')]
    public function index(Request $request, EntityManagerInterface $manager, MailerInterface $mailer): Response
    {

        $contact = new Contact();

        if($this->getUser()){
            $u = $this->getUser();
            /** @var User $u */
            $contact->setFullName($u->getFullName())
                    ->setEmail($u->getEmail());
        };

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $manager->persist($contact);

            $manager->flush();

            //Configuration de l'email
            $email = (new TemplatedEmail())
                ->from($contact->getEmail())
                ->to('admin@symrecipe.com')
                ->subject($contact->getSubject())
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'contact' => $contact
                ]);

                $mailer->send($email);

            $this->addFlash(
                'success',
                'Votre message a été envoyé avec succès !'
            );

            return $this->redirectToRoute('contact.index');
        }

        return $this->render('pages/contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
