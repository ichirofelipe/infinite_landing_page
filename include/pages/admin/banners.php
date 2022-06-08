<div class="container container--full mb-2">
    <div class="heading d-flex justify-between align-items-center">
        <h1 class="title title--md">Banners</h1>

        <a href="/admin/banners/create-form" class="button button--default">
            <i class="icon-plus"></i>
            <span class="ml-1">Add Banner</span>
        </a>
    </div>

    <div class="table__container">
        <?php
        if($banners){
            includeWithVariables(dirname(__FILE__).'/components/table.php', 
                array(
                    'columns' => $columns,
                    'data' => $banners,
                    'action' => 'banner',
                    'url' => '/admin/banners',
                    'table' => 'banners',
                )
            );
        }
        else{
            echo "<p class='title alert-default'>No data to display.</p>";
        }
        ?>
    </div>
    <?php
        includeWithVariables(dirname(__FILE__).'/components/pagination.php', 
            array(
                'currentPage' => $listPage,
                'pagination' => $pagination,
                'url' => '/admin/banners'
            )
        );
    ?>
</div>