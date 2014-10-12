<?php
class pagination
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
        // TODO: HTML.
    ?>
        <ul class="pagination">
        <?php if ($this->paginaActual>3) {?>
        <li><a href="<?=$link?>&p=1">1</a></li>
        <li class="disabled"><a href=''>...</a></li>
        <?php } ?>
        <?php for ($i=($this->paginaActual>2 ? $this->paginaActual-2 : 1);$i<=($this->paginaActual<$this->cntTotalPaginas-2 ? $this->paginaActual+2 : $this->cntTotalPaginas);$i++) { ?>
        <li <?= ($this->paginaActual==$i ? "class='active'" : "") ?>><a href="<?=$link?>&p=<?=$i?>"><?=$i?></a></li>
        <?php } ?>
        <?php if ($this->paginaActual<$this->cntTotalPaginas-2) {?>
        <li class="disabled"><a href=''>...</a></li>
        <li><a href="<?=$link?>&p=<?=$this->cntTotalPaginas?>"><?=$this->cntTotalPaginas?></a></li>
        <?php } ?>
        </ul>
    <?php
}
}
?>
