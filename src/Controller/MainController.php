<?php

namespace App\Controller;

use App\Form\PollBuilderType;
use Klein\App;
use Klein\Request;
use Klein\Response;
use Klein\ServiceProvider;
use Symfony\Component\Form\FormFactory;
use Twig\Environment;

/**
 * Class MainController
 * @package App\Controller
 */
class MainController
{
    /**
     * @param Request         $request
     * @param Response        $response
     * @param ServiceProvider $service
     * @param App             $app
     *
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public static function indexAction(Request $request, Response $response, ServiceProvider $service, App $app)
    {
        /** @var FormFactory $formFactory */
        $formFactory = $app->__get('formFactory');
        /** @var Environment $twig */
        $twig        = $app->__get('twigEnvironment');

        $form = $formFactory->create(PollBuilderType::class);

        if ($formData = $request->paramsPost()->get('poll_builder')) {
            $form->submit($formData);
            if ($form->isSubmitted() && $form->isValid()) {
                $response->body(1);
                return $response;
            }
        }

        $view = $twig->render('poll/poll_main.html.twig', [
            'form' => $form->createView(),
        ]);
        $response->body($view);
        return $response;
    }




}
