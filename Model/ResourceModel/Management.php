<?php


namespace Cardoso\ViralLoops\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Management extends AbstractDb
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('viral_loops_management', 'entity_id');
    }

}
