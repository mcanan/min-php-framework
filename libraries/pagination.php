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

    public function render()
    {
        // TODO: Hacerlo con una vista.
        $retorno = "<ul class='pagination'>";
        if ($this->currentPage>3) {
            $retorno .= "<li><a href='$this->link&p=1'>1</a></li>";
            $retorno .= "<li class='disabled'><a href=''>...</a></li>";
        }
        for ($i=($this->currentPage>2 ? $this->currentPage-2 : 1);$i<=($this->currentPage<$this->totalAmountPages-2 ? $this->currentPage+2 : $this->totalAmountPages);$i++) {
            $retorno .= "<li ".($this->currentPage==$i ? "class='active'" : "")."><a href='$this->link&p=$i'>$i</a></li>";
        }
        if ($this->currentPage<$this->totalAmountPages-2) {
            $retorno .= "<li class='disabled'><a href=''>...</a></li>";
            $retorno .= "<li><a href='$this->link&p=".$this->totalAmountPages."'>".$this->totalAmountPages."</a></li>";
        }
        return $retorno;
    }
}
?>
