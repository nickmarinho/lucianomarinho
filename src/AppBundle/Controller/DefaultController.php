<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
	public function contactForm()
	{
		return $this->createFormBuilder()
			->add('name', TextType::class, array(
				'attr' => array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'Nome'),
				'label' => 'Nome',
				'label_attr' => array('class' => 'sr-only')
			))
			->add('email', EmailType::class, array(
				'attr' => array('id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email'),
				'label' => 'Email',
				'label_attr' => array('class' => 'sr-only')
			))
			->add('phone', TextType::class, array(
				'attr' => array('id' => 'phone', 'class' => 'form-control', 'placeholder' => 'Telefone'),
				'label' => 'Telefone',
				'label_attr' => array('class' => 'sr-only')
			))
			->add('message', TextareaType::class, array(
				'attr' => array('id' => 'message', 'class' => 'form-control', 'placeholder' => 'Mensagem', 'cols' => 30, 'rows' => 5),
				'label' => 'Mensagem',
				'label_attr' => array('class' => 'sr-only')
			))
			->add('submit', SubmitType::class, array(
				'attr' => array('class' => 'btn btn-primary btn-block'),
				'label' => 'Enviar Mensagem',
			))
			->getForm();
	}

	/**
	 * @Route("/", name="homepage")
	 */
	// public function indexAction(Request $request)
	public function indexAction()
	{
		$form = $this->contactForm();
		
		return $this->render('default/index.html.twig', array(
			'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
			'form' => $form->createView(),
		));
	}

	/**
	 * @Route("/contato", name="contact")
	 */
	public function contactAction(Request $request)
	{
		$form = $this->contactForm();

		if ($request->isMethod('POST')) {
			$postData = $request->request->all('form');
			$form = $postData['form'];
			$name = $form['name'];
			$email = $form['email'];
			$phone = $form['phone'];
			$message = $form['message'];

			$message = \Swift_Message::newInstance()
				->setSubject('Email Enviado Através do Site')
				->setFrom('contato@lucianomarinho.com.br')
				->setTo('contato@lucianomarinho.com.br')
				->setBody(
					$this->render(
						'default/contact-email.html.twig',
						array(
							'name' => $name,
							'email' => $email,
							'phone' => $phone,
							'message' => $message
						)
					),
					'text/html'
				);
			
			if($this->get('mailer')->send($message)){
				return $this->render('default/contact-success.html.twig', [
					'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
				]);
			} else {
				return $this->render('default/contact-error.html.twig', [
					'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
				]);
			}
		} else {
			return $this->render('default/contact-default.html.twig', [
				'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
				'form' => $form->createView(),
			]);
		}
	}
}
