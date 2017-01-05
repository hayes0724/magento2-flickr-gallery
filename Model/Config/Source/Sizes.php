<?php
/**
 * Dropdown selection for max size to get from Flickr API
 *
 */
namespace HayesMarketing\Gallery\Model\Config\Source;
class Sizes implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => '1', 'label' => __('Square')],
            ['value' => '2', 'label' => __('Large Square')],
            ['value' => '3', 'label' => __('Thumbnail')],
            ['value' => '4', 'label' => __('Small')],
            ['value' => '5', 'label' => __('Small 320')],
            ['value' => '6', 'label' => __('Medium')],
            ['value' => '7', 'label' => __('Medium 640')],
            ['value' => '8', 'label' => __('Medium 800')],
            ['value' => '9', 'label' => __('Large')],
            ['value' => '10', 'label' => __('Original')]
        ];
    }
}

?>