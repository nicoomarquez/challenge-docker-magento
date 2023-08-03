<?php

namespace Tiendamia\Challenge\Block\Adminhtml\Order\View\Items\Renderer;

use Magento\Sales\Model\Order\Item;

class DefaultRenderer extends \Magento\Sales\Block\Adminhtml\Order\View\Items\Renderer\DefaultRenderer
{
    /**
     * Retrieve rendered column html content
     *
     * @param \Magento\Framework\DataObject|Item $item
     * @param string $column
     * @param string $field
     * @return string
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @since 100.1.0
     */
    public function getColumnHtml(\Magento\Framework\DataObject $item, $column, $field = null)
    {
        $html = '';
        if ($column == 'offer_id') {
            $html = $item->getOfferId();
        }
        else {
            $html = parent::getColumnHtml($item, $column, $field);
        }

        return $html;
    }
}
