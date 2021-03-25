<?php


namespace Cardoso\ViralLoops\Model\ResourceModel;


use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Cardoso\ViralLoops\Api\Data\ManagementInterface;
use Cardoso\ViralLoops\Api\Data\ManagementSearchResultInterface;
use Cardoso\ViralLoops\Api\Data\ManagementSearchResultInterfaceFactory;
use Cardoso\ViralLoops\Model\ResourceModel\Management as ManagementResource;
use Cardoso\ViralLoops\Model\ResourceModel\Management\CollectionFactory as ManagementCollectionFactory;
use Cardoso\ViralLoops\Api\ManagementRepositoryInterface;

class ManagementRepository  implements ManagementRepositoryInterface
{
    /**
     * @var Management
     */
    private $managementFactory;

    /**
     * @var ManagementResource
     */
    private $managementResource;

    /**
     * @var ManagementCollectionFactory
     */
    private $managementCollectionFactory;

    /**
     * @var ManagementSearchResultInterfaceFactory
     */
    private $searchResultFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    public function __construct(
        Management $managementFactory,
        ManagementResource $managementResource,
        ManagementCollectionFactory $managementCollectionFactory,
        ManagementSearchResultInterfaceFactory $studentSearchResultInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->managementFactory = $managementFactory;
        $this->managementResource = $managementResource;
        $this->managementCollectionFactory = $managementCollectionFactory;
        $this->searchResultFactory = $studentSearchResultInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }


    /**
     * @param int $id
     * @return ManagementInterface
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $student = $this->managementFactory->create();
        $this->managementResource->load($student, $id);
        if (!$student->getId()) {
            throw new NoSuchEntityException(__('Unable to find Management with ID "%1"', $id));
        }
        return $student;
    }

    /**
     * @param ManagementInterface $management
     * @return ManagementInterface
     * @throws AlreadyExistsException
     */
    public function save(ManagementInterface $management)
    {
        $this->managementResource->save($management);
        return $management;
    }

    /**
     * @param ManagementInterface $management
     * @return bool true on success
     * @throws CouldNotDeleteException
     */
    public function delete(ManagementInterface $management)
    {
        try {
            $this->managementResource->delete($management);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the entry: %1', $exception->getMessage())
            );
        }

        return true;

    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return ManagementSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->managementCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }
}
