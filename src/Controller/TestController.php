<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller used to manage blog contents in the public part of the site.
 *
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class TestController extends AbstractController
{
    /**
     * @Route("/test2", name="test2")
     * @return Response
     * @throws \Exception
     */
    public function test2(): Response
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder
            ->register('test_sam', 'App\Model\Test')
            ->addArgument('testdata');

        $test = $containerBuilder->get('test_sam');
        echo "done";

        return $this->render('blog/test.twig');
    }

    /**
     * @Route("/templating", name="test3")
     * @return Response
     * @throws \Exception
     */
    public function test3(): Response
    {
        $articles = ['article1','article2','article3'];
        return $this->render('blog/test3.twig',['articles'=>$articles]);
    }

    /**
     * @Route("/test4/{slug}", name="test4")
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function test4(string $slug): JsonResponse
    {
        return new JsonResponse(true);
    }

    /**
     * @Route("/test5", name="test5")
     *
     * @param Request $request
     * @return Response
     */
    public function test5(Request $request): Response{
        $task = new Task();
        $task->setTask("Otvesti tvoya mamka v kino.");
        $task->setDueDate(new \DateTime('now'));
        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->render('blog/test5.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/test6", name="test6")
     *
     * @param Request $request
     */
    public function test6(Request $request): Response{
      $testArray = [
          1 => 'str1',
          2 => 'str2',
          3 => [
              4=>'str4',
              5=>'str5'
          ]
      ];
      array_walk_recursive($testArray,[$this,'display']);
        return new JsonResponse(true);
    }

    public function display($item,$key){
        print("$key => $item \n");
    }

    /**
     * @Route("/test7", name="test7")
     *
     * @param Request $request
     */
    public function test7(Request $request): JsonResponse
    {
        $testArray = [
            'a' => 'str1',
            'b' => 'str2',
            'c' => [
                'd'=>'str4',
                'e'=>'str5'
            ]
        ];
        extract($testArray);

        return new JsonResponse($c);
    }

    /**
     * @Route("/test8", name="test8")
     *
     * @param Request $request
     */
    public function test8(Request $request): JsonResponse
    {
        $a = "The quick brown fox jumped over the lazy dog.";
        $b = array_map("strtoupper", explode(" ", $a));
        foreach ($b as $value) {
            print "$value ";
        }


        return new JsonResponse(true);
    }

    /**
     * @Route("/test9", name="test9")
     *
     * @param Request $request
     */
    public function test9(Request $request): Response
    {
        $a = "The quick brown fox jumped over the lazy dog.";
        $b = array_map("strtoupper", explode(" ", $a));
        array_unshift($b,'qewtewqtqwetwqetqtwqe');
        var_dump($b);

        $a = array(0.001 => 'b', .1 => 'c');
        var_dump($a);

        return new Response('');
    }

    /**
     * @Route("/arrays", name="testArrays1")
     */
    public function testArrays(): Response
    {
        $testArray = [
            0.1 => 1,
            0.33 => 3,
            "-8" => 'key string',
            true => 'boolean key',
            null => 'null key',
            'a' => 'test A',
            'b' => 'test B',
            'c' => 'test C',
            'd' => [
                'e' => 'test E',
                'f' => 'test F'
            ]
        ];
        var_dump($testArray);

        $testArray2 = [
            1 => 'test',
            2 => 'test2'
        ];
        var_dump($testArray2);

        $testArray2 = array_values($testArray2);

        var_dump($testArray2);

        $a = "The quick brown fox jumped over the lazy dog.";
        $b = array_map("strtoupper", explode(" ", $a));
        foreach ($b as $value) {
            print "$value ";
        }

        $testArray3 = [
            0 => 'arr',
            3 => 'qwerty',
            4.1 => 'bqwet'
        ];

        sort($testArray3);

        var_dump($testArray3);
        
        echo "<br/>";

        return new Response('a');

    }
}