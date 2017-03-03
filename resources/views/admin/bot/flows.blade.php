<?php $counter = 1; ?>
<?php foreach ($flows as $flow) { ?>
    <tr>
        <td data-title="S/N"><?php echo $counter; ?></td>
        <td data-title="Chat Flow">
            <?php echo $flow->flow_name; ?>
        </td>
        <td>
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                    <span style="color: #005B21; font-size: 16px;" class="fa fa-cog"></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" style="min-width: 10px; max-width: 200px;">
                    <li>
                        <a href="<?php echo url('admin/bot/boxes/?id=') . $flow->id; ?>">
                            <span class="fa fa-folder"></span> Flow Boxes
                        </a>
                    </li>
                </ul>
            </div>
        </td>
    </tr>
    <?php $counter++; ?>
<?php } ?>