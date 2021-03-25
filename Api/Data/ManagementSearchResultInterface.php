<?php

namespace Cardoso\ViralLoops\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * @api
 */
interface ManagementSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return ManagementInterface[]
     */
    public function getItems();

    /**
     * @param ManagementInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
