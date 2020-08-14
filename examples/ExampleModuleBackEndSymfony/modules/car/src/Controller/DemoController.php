<?php

namespace Modules\Car\Controller;

use Doctrine\ORM\EntityManager;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use Modules\Car\Entity\CarTest;
use Modules\Car\Form\CarType;
use Modules\Car\Service\YourService;

class DemoController extends FrameworkBundleAdminController
{

    public function demoAction(Request $request)
    {
        /** @var YourService $yourService */
        $yourService    = $this->get('your.service');
        /** @var EntityManager $em */
        $em             = $this->getDoctrine()->getManager();
        
        $car            = new CarTest();
        $car->setName('Renault');
        $form           = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $em->persist($task);
            $em->flush();
    
            // return $this->redirectToRoute('task_success');
        }

        $qb = $em->createQueryBuilder()
        ->select('ct')
        ->from('AppCar:CarTest', 'ct')
        ->orderBy('ct.name', 'ASC');
        $query = $qb->getQuery();
        // // Execute Query
        $result = $query->getResult();

        // $em = $this->getDoctrine()->getManager();
        // $car = new CarTest();
        // $car->setName("Alfa");
        // $em->persist($car);
        // $em->flush();
        return $this->render('@Modules/car/src/Resources/views/demo.html.twig', [
            'customMessage' => $yourService->getTranslatedCustomMessage(),
            'form'          => $form->createView(),
            'carCollection' => $result
        ]);
    }
}