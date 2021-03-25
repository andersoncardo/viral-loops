<?php

namespace Cardoso\ViralLoops\Model\ResourceModel\Management;

use Cardoso\ViralLoops\Model\Management;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Cardoso\ViralLoops\Model\ResourceModel\Management as ManagementResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'viral_loops_management_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'viral_loops_management_collection';

    /**
     * {@inheritDoc}
     */
    protected function _construct()
    {
        $this->_init(Management::class, ManagementResourceModel::class);
    }
}
