<?php


namespace Cardoso\ViralLoops\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Cardoso\ViralLoops\Api\Data\ManagementSearchResultInterface;

interface ManagementRepositoryInterface
{
    /**
     * @param Data\ManagementInterface $management
     * @return Data\ManagementInterface
     */
    public function save(Data\ManagementInterface $management);

    /**
     *
     * @param int $entityId
     * @return Data\ManagementInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $entityId);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return ManagementSearchResultInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param Data\ManagementInterface $management
     * @return bool
     */
    public function delete(Data\ManagementInterface $management);
}
