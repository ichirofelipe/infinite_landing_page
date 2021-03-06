<table class="table">
    <thead>
        <tr>
            <?php foreach($columns as $col){ ?>
                <th><?= str_replace($table."_", "", $col) ?></th>
            <?php } ?>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $d){ ?>
            <tr>
                <?php foreach($d as $value){ ?>
                    <td><?php 
                        switch($value){
                            case 'n':
                                echo 'No';
                                break;
                            case 'y':
                                echo 'Yes';
                                break;
                            default:
                                echo $value;
                                break;
                        }
                    ?></td>
                <?php } ?>
                <td class="d-flex">
                    <a href="/admin/<?= $table ?>/edit-form/<?= $d[$table.'_id'] ?>" class="text-plain title--sm text-default text-clickable">
                        <i class="icon-pencil"></i>
                    </a>
                    <form data-confirm="Are you sure you want to delete this <?= $action ?>?" method="POST" action="/<?= $action ?>-request">
                        <input type="hidden" name="redirect" value="<?= $url ?>">
                        <button type="submit" name="delete" value="<?= $d[$table.'_id'] ?>" class="text-plain title--sm text-default text-clickable"><i class="icon-trash-empty"></i></button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>