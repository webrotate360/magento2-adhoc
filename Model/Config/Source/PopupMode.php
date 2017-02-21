<?php

namespace WebRotate360\ProductViewerAdHoc\Model\Config\Source;

class PopupMode implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'lightbox',
                'label' => 'Lightbox'
            ),

            array(
                'value' => 'fullScreen',
                'label' => 'Full-screen'
            ),

            array(
                'value' => 'browserWindow',
                'label' => 'Browser window'
            ),
        );
    }
}