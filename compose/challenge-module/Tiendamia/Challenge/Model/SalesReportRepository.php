<?php
namespace Tiendamia\Challenge\Model;

use Magento\Ui\Api\Data\BookmarkSearchResultsInterface;
use Tiendamia\Challenge\Model\SalesReport as SalesReportEntity;
use Tiendamia\Challenge\Model\SalesReportFactory as SalesReportEntityFactory;
use Tiendamia\Challenge\Model\ResourceModel\SalesReport as SalesReportResource;
use Tiendamia\Challenge\Model\ResourceModel\SalesReport\Collection;
use Tiendamia\Challenge\Model\ResourceModel\SalesReport\CollectionFactory;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Ui\Api\Data\BookmarkSearchResultsInterfaceFactory;

class SalesReportRepository
{
    public function __construct(
        private BookmarkSearchResultsInterfaceFactory $searchResultsFactory,
        private SalesReportEntityFactory $salesReportFactory,
        private SalesReportResource $salesReportResource,
        private CollectionFactory $collectionFactory
    ) {}

    /**
     * @param SalesReport $report
     * @return SalesReport
     * @throws CouldNotSaveException
     */
    public function save(SalesReportEntity $report)
    {
        try {
            if ($report->getId()) {
                $report = $this->getById($report->getId())->addData($report->getData());
            }
            $this->salesReportResource->save($report);
        } catch (\Exception $e) {
            if ($report->getId()) {
                throw new CouldNotSaveException(
                    __(
                        'Unable to save report with ID %1. Error: %2',
                        [$report->getId(), $e->getMessage()]
                    )
                );
            }
            throw new CouldNotSaveException(__('Unable to save new order. Error: %1', $e->getMessage()));
        }

        return $report;
    }

    /**
     * @param $id
     * @return SalesReport
     * @throws NoSuchEntityException
     */
    public function getById($id): SalesReport
    {
        /** @var SalesReportEntity $report */
        $report = $this->salesReportFactory->create();
        $this->salesReportResource->load($report, $id);
        if (!$report->getId()) {
            throw new NoSuchEntityException(__('Order with specified ID "%1" not found.', $id));
        }
        return $report;
    }

    /**
     * @return SalesReportEntity
     */
    public function getEmptyModel()
    {
        return $this->salesReportFactory->create();
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return BookmarkSearchResultsInterface
     * @throws NoSuchEntityException
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        /** @var Collection $reportCollection */
        $reportCollection = $this->collectionFactory->create();

        // Add filters from root filter group to the collection
        foreach ($searchCriteria->getFilterGroups() as $group) {
            $this->addFilterGroupToCollection($group, $reportCollection);
        }

        $searchResults->setTotalCount($reportCollection->getSize());
        $sortOrders = $searchCriteria->getSortOrders();

        if ($sortOrders) {
            $this->addOrderToCollection($sortOrders, $reportCollection);
        }

        $reportCollection->setCurPage($searchCriteria->getCurrentPage());
        $reportCollection->setPageSize($searchCriteria->getPageSize());

        $orders = [];
        /** @var SalesReportEntity $order */
        foreach ($reportCollection->getItems() as $order) {
            $orders[] = $this->getById($order->getEntityId());
        }

        $searchResults->setItems($orders);

        return $searchResults;
    }

    /**
     * Helper function that adds a FilterGroup to the collection.
     *
     * @param FilterGroup $filterGroup
     * @param Collection  $reportCollection
     *
     * @return void
     */
    private function addFilterGroupToCollection(FilterGroup $filterGroup, Collection $reportCollection)
    {
        foreach ($filterGroup->getFilters() as $filter) {
            $condition = $filter->getConditionType() ?: 'eq';
            $reportCollection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
        }
    }

    /**
     * Helper function that adds a SortOrder to the collection.
     *
     * @param SortOrder[] $sortOrders
     * @param Collection  $reportCollection
     *
     * @return void
     */
    private function addOrderToCollection($sortOrders, Collection $reportCollection)
    {
        /** @var SortOrder $sortOrder */
        foreach ($sortOrders as $sortOrder) {
            $field = $sortOrder->getField();
            $reportCollection->addOrder(
                $field,
                ($sortOrder->getDirection() == SortOrder::SORT_DESC) ? SortOrder::SORT_DESC : SortOrder::SORT_ASC
            );
        }
    }
}
