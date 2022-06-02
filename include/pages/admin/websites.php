<div class="container container--full mb-2">
    <div class="heading d-flex justify-between align-items-center">
        <h1 class="title title--md">Websites</h1>

        <button data-table="websites" data-toggle="modal" data-target="upload" class="button button--default">
            <i class="icon-plus"></i>
            <span class="ml-1">Add Website</span>
        </button>
    </div>

    <div class="table__container">
        <?php
        if($websites){
            includeWithVariables(dirname(__FILE__).'/components/table.php', 
                array(
                    'columns' => $columns,
                    'data' => $websites,
                    'action' => 'post',
                    'url' => '/admin/websites',
                    'table' => 'websites',
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
                'url' => '/admin/websites'
            )
        );
    ?>
</div>