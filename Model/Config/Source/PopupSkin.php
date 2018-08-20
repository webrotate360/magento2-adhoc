<?php

namespace WebRotate360\ProductViewerAdHoc\Model\Config\Source;

class PopupSkin implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'light_clean',
                'label' => 'Light Clean'
            ),

            array(
                'value' => 'dark_clean',
                'label' => 'Dark Clean'
            ),

            array(
                'value' => 'pp_default',
                'label' => 'PrettyPhoto Default'
            ),

            array(
                'value' => 'light_rounded',
                'label' => 'Light Rounded'
            ),

            array(
                'value' => 'dark_rounded',
                'label' => 'Dark Rounded'
            ),

            array(
                'value' => 'dark_square',
                'label' => 'Dark Square'
            ),

            array(
                'value' => 'light_square',
                'label' => 'Light Square'
            ),

            array(
                'value' => 'facebook',
                'label' => 'Facebook'
            ),
        );
    }
}