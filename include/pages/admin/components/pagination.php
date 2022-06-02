<?php
if($pagination){
?>
<nav>
    <ul class="pagination d-flex">
        <li class="pagination__item <?= ($pagination['start'] == 1 ? 'disabled':'') ?>">
            <a class="pagination__link" href="<?= $url.'/page/'.$pagination['start']-1?>">
                <div class="d-flex align-items-center">
                    <i class="icon-left-open mr-sm-1"></i>
                    <span class="d-none d-sm-block">Prev</span>
                </div>
            </a>
        </li>

        <?php for($i=$pagination['start'];$i<=$pagination['end'];$i++){ ?>
            <li class="pagination__item <?= ($currentPage == $i ? 'active static':'') ?>">
                <a class="pagination__link" href="<?= $url.'/page/'.$i?>"><?= $i ?></a>
            </li>
        <?php } ?>
    
        <li class="pagination__item <?= ($pagination['end'] == $pagination['limit'] ? 'disabled':'') ?>">
            <a class="pagination__link" href="<?= $url.'/page/'.$pagination['end']+1?>">
                <div class="d-flex align-items-center">
                    <span class="d-none d-sm-block">Next</span>
                    <i class="icon-right-open ml-sm-1"></i>
                </div>
            </a>
        </li>
    </ul>
</nav>
<?php 
}
?>