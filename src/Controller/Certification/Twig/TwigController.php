<?php

declare(strict_types=1);

namespace App\Controller\Certification\Twig;
use App\Entity\Grow;
use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route(path="/certification/twig")
 */
class TwigController extends AbstractController
{
    private $templatePath = 'certification/twig';
    /**
     * @Route(path="/action1", name="twig_action1")
     */
    public function action1(): Response
    {
        $grow = new Grow();
        $grow2 = new Grow();
        $grow2->setFirstName('John');
        $grow2->setLastName('Sina');
        $grow3 = new Grow();
        $grow3->setFirstName('Johny');
        $grow->setLastName('Sins');
        $grows = [$grow,$grow2,$grow3];
        return $this->render(
            $this->templatePath.'/action1.html.twig',
            [
                'testPageTitle'=>'testPageTitle',
                'grow'=> $grow,
                'grows' =>$grows
            ]
        );
    }

    /**
     * @Route(path="/filters", name="twig_main_action")
     *
     * @return Response
     */
    public function filtersAction(): Response
    {
        return $this->render($this->templatePath.'/main_action.html.twig',[
            'orders' => \iterator_to_array($this->getOrders(10)),
            'numbersRange' => range(11,23)
            ]);
    }

    /**
     * @Route(path="/functions", name="twig_functions_action")
     *
     * @return Response
     */
    public function mainFunctionsAction(): Response
    {
        return $this->render($this->templatePath.'/functions.html.twig',[
            'orders' => \iterator_to_array($this->getOrders(10)),
            'numbersRange' => range(11,23)
            ]);
    }

    /**
     * @Route(path="/globals", name="twig_globals")
     * @return Response
     */
    public function globalsAction(): Response
    {
        return $this->render($this->templatePath.'/globals.html.twig');
    }

    /**
     * @Route(path="/if-condition", name="if_condition_action")
     * @return Response
     */
    public function ifConditionAction(): Response
    {
        return $this->render($this->templatePath.'/if_condition.html.twig');
    }

    /**
     * @Route(path="/loop-for", name="loop_for_action")
     * @return Response
     */
    public function loopForAction(): Response
    {
        return $this->render($this->templatePath.'/loop_for.html.twig');
    }

    /**
     * @Route(path="/linking", name="linking_action")
     * @return Response
     */
    public function linkingAction(): Response
    {
        return $this->render($this->templatePath.'/linking.html.twig');
    }

    /**
     * @Route(path="/string-interpolation", name="twig_string_interpolation")
     * @return Response
     */
    public function stringInterpolationAction(): Response
    {
        return $this->render($this->templatePath.'/string_interpolation.html.twig');
    }

    /**
     * @Route(path="/embed", name="twig_embed")
     * @return Response
     */
    public function embedController(): Response
    {
        return $this->render($this->templatePath.'/embed.html.twig');
    }

    /**
     * @Route(path="/i18n", name="twig_translation")
     *
     * @param TranslatorInterface $translator
     * @return Response
     */
    public function i18nAction(TranslatorInterface $translator): Response
    {
        dump($translator->trans('twig test trans'));

        return $this->render($this->templatePath.'/i18n.html.twig');
    }

    /**
     * @param int $number
     * @return \Generator
     */
    private function getOrders(int $number): \Generator
    {
        for($i=0;$i<$number;$i++){
            $order = new Order();
            $order->setId($i);
            $order->setFirstname('Firstname'.rand(1,9));
            $order->setLastname('Lastname'.rand(1,9));
            $rand = rand(1,9);
            $order->setShippingAddress("Shipping ${rand} address ${rand}");
            $order->setBillingAddress("Shipping ${rand} address ${rand}");
            $order->setDescription("Lorem Ipsum${rand} is simply dummy text of the p${rand}rinting and${rand} typesetting${rand} industry.");
            yield $order;
        }
    }

}