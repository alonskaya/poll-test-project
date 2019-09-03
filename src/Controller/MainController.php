<?php

namespace App\Controller;

use App\Form\PollActingType;
use App\Form\PollBuilderType;
use Klein\App;
use Klein\Request;
use Klein\Response;
use Klein\ServiceProvider;
use Predis\Client;
use Symfony\Component\Form\FormFactory;
use Twig\Environment;

/**
 * TODO: DI
 * TODO: Handle exceptions
 *
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
    public static function pollBuilderAction(Request $request, Response $response, ServiceProvider $service, App $app)
    {
        /** @var FormFactory $formFactory */
        $formFactory = $app->__get('formFactory');

        $form = $formFactory->create(PollBuilderType::class);

        if ($formData = $request->paramsPost()->get('poll_builder')) {
            $form->submit($formData);

            if ($form->isSubmitted() && $form->isValid()) {
                /** @var Client $redisClient */
                $redisClient = $app->__get('redisClient');

                do {
                    $hash = md5(uniqid(mt_rand(), true));
                } while ($redisClient->get($hash));

                $formData['results'] = [];

                $redisClient->set($hash, json_encode($formData));

                $response->redirect('/poll/' . $hash)->send();
            }
        }

        /** @var Environment $twig */
        $twig = $app->__get('twigEnvironment');

        $view = $twig->render('poll/poll_builder.html.twig', [
            'form' => $form->createView(),
        ]);

        $response->body($view);

        return $response;
    }

    /**
     * @param Request         $request
     * @param Response        $response
     * @param ServiceProvider $service
     * @param App             $app
     *
     * @return \Klein\AbstractResponse|Response|string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public static function pollActingAction(Request $request, Response $response, ServiceProvider $service, App $app)
    {
        /** @var FormFactory $formFactory */
        $formFactory = $app->__get('formFactory');
        /** @var Client $redisClient */
        $redisClient = $app->__get('redisClient');

        if ((!$hash = $request->paramsNamed()->get('hash'))
            || (!$data = $redisClient->get($hash))
            || (!$data = json_decode($data, true)) ) {
            return $response->body('Server invalid data');
        }

        if ($formData = $request->paramsPost()->get('poll_acting')) {
            $form = $formFactory->create(PollActingType::class, null, [
                'choices' => $data['answers']
            ]);

            $form->submit($formData);

            if ($form->isSubmitted() && $form->isValid()) {
                $data['results'][$formData['name']] = $formData['answers'];

                $redisClient->set($hash, json_encode($data));
                $response->cookie(
                    $hash,
                    json_encode(['name' => $formData['name'], 'answer' => $formData['answers']]),
                    time() + (10 * 365 * 24 * 60 * 60)
                );

                return $response->redirect($request->pathname());
            }

            return $response->body('Server invalid data');
        }

        /** @var Environment $twig */
        $twig = $app->__get('twigEnvironment');

        $choices  = $data['answers'];
        $disabled = false;

        if ($cookie = $request->cookies()->get($hash)) {
            $cookie = json_decode($cookie, true);

            $data['name']    = $cookie['name'];
            $data['answers'] = $cookie['answer'];
            $disabled        = true;
        } else {
            unset($data['answers']);
        }

        $form = $formFactory->create(PollActingType::class, $data, [
            'choices'  => $choices,
        ]);

        $response->body($twig->render(
            'poll/poll_acting.html.twig',
            [
                'form'          => $form->createView(),
                'results'       => $data['results'],
                'form_disabled' => $disabled
            ]
        ));

        return $response;
    }

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
    public static function renderResultsAction(Request $request, Response $response, ServiceProvider $service, App $app)
    {
        if ($hash = $request->paramsNamed()->get('hash')) {
            /** @var Client $redisClient */
            $redisClient = $app->__get('redisClient');

            if ($data = $redisClient->get($hash)) {
                $data = json_decode($data, true);

                /** @var Environment $twig */
                $twig = $app->__get('twigEnvironment');

                $view = $twig->render(
                    'poll/poll_result.html.twig',
                    [
                        'headers' => $data['answers'],
                        'results' => $data['results'],
                    ]
                );

                $response->body($view);
            }
        }

        return $response;
    }
}
