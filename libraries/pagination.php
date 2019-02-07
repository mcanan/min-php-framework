<?php
namespace mcanan\framework\libraries;

class Pagination
{
    private $currentPage;
    private $totalAmountPages;
    private $totalAmountItems;
    private $amountPerPage;
    private $link;

    public function init($amountPerPage, $currentPage, $totalAmountItems, $link)
    {
        $totalAmountPages = floor($totalAmountItems/$amountPerPage)+1;

        if ($currentPage<1) {
            $currentPage=1;
        }
        if ($currentPage>$totalAmountPages) {
            $currentPage=$totalAmountPages;
        }

        $this->amountPerPage=$amountPerPage;
        $this->currentPage=$currentPage;
        $this->totalAmountItems=$totalAmountItems;
        $this->totalAmountPages=$totalAmountPages;
        $this->link=$link;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function getTotalAmountOfItems()
    {
        return $this->totalAmountItems;
    }
    
    public function getTotalAmountOfPages()
    {
        return $this->totalAmountPages;
    }
    
    public function getLink()
    {
        return $this->link;
    }
    
    public function getQueryStart()
    {
        return ($this->currentPage - 1) * $this->amountPerPage;
    }
}
?>
