<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Y2B\StopSpamRegistration\Block\Adminhtml\Form\Field;

class Customcmstabs extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray
{
    /**
     * Prepare to render
     *
     * @return void
     */
    protected function _prepareToRender()
    {
        $this->addColumn('tab_keywords', ['label' => __('Keyword')]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add Keyword');
    }
}
