<?php
namespace mcanan\framework\libraries;

class Pagination
{
    private $paginaActual;
    private $cntTotalPaginas;
    private $cntTotalItems;
    private $cntPorPagina;

    public function init($cntPorPagina, $paginaActual, $cntTotalItems)
    {
        $cntTotalPaginas = floor($cntTotalItems/$cntPorPagina)+1;

        if ($paginaActual<1) {
            $paginaActual=1;
        }
        if ($paginaActual>$cntTotalPaginas) {
            $paginaActual=$cntTotalPaginas;
        }

        $this->cntPorPagina=$cntPorPagina;
        $this->paginaActual=$paginaActual;
        $this->cntTotalItems=$cntTotalItems;
        $this->cntTotalPaginas=$cntTotalPaginas;
    }

    public function getPaginaActual()
    {
        return $this->paginaActual;
    }

    public function getCantidadTotalItems()
    {
        return $this->cntTotalItems;
    }

    public function render($link)
    {
        // TODO: Hacerlo con una vista.
        $retorno = "<ul class='pagination'>";
        if ($this->paginaActual>3) {
            $retorno .= "<li><a href='$link&p=1'>1</a></li>";
            $retorno .= "<li class='disabled'><a href=''>...</a></li>";
        }
        for ($i=($this->paginaActual>2 ? $this->paginaActual-2 : 1);$i<=($this->paginaActual<$this->cntTotalPaginas-2 ? $this->paginaActual+2 : $this->cntTotalPaginas);$i++) {
            $retorno .= "<li ".($this->paginaActual==$i ? "class='active'" : "")."><a href='$link&p=$i'>$i</a></li>";
        }
        if ($this->paginaActual<$this->cntTotalPaginas-2) {
            $retorno .= "<li class='disabled'><a href=''>...</a></li>";
            $retorno .= "<li><a href='$link&p=".$this->cntTotalPaginas."'>".$this->cntTotalPaginas."</a></li>";
        }
        return $retorno;
    }
}
?>
