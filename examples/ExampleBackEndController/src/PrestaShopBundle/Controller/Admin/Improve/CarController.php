<?php

namespace PrestaShopBundle\Controller\Admin\Improve;

use PrestaShopBundle\Controller\Admin\Improve\Modules\ModuleAbstractController;
/**
 * Responsible of "Improve > Modules > Modules & Services > Catalog / Manage" page display.
 */
class CarController extends ModuleAbstractController
{
    /**
     * Brumm Action
     * How call:  /admin-dev/improve/shipping/car_crush
     */
    public function crushAction(){
      
      // Show with layout
      return $this->render('@PrestaShop/Admin/Improve/Shipping/crush.html.twig',[
            'move' => 'brumm'
      ]);

      // Show only content
      // return $this->render('@PrestaShop/Admin/Improve/Shipping/crush0.html.twig',[
      //         'move' => 'brumm'
      // ]);
    }

}
