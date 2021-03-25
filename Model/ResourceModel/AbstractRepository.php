<?php


namespace Cardoso\ViralLoops\Model\ResourceModel;

use Magento\Framework\Api\Search\SearchResult;
use Magento\Framework\Api\Search\SearchResultFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

abstract class AbstractRepository
{
    /**
     * @return SearchResultFactory
     */
    abstract protected function getSearchResultFactory(): SearchResultFactory;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param AbstractCollection $collection
     */
    protected function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, AbstractCollection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param AbstractCollection $collection
     */
    protected function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, AbstractCollection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param AbstractCollection $collection
     */
    protected function addPagingToCollection(SearchCriteriaInterface $searchCriteria, AbstractCollection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param AbstractCollection $collection
     * @return mixed
     */
    protected function buildSearchResult(SearchCriteriaInterface $searchCriteria, AbstractCollection $collection): SearchResult
    {
        /** @var SearchResult $searchResults */
        $searchResults = $this->getSearchResultFactory()->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
