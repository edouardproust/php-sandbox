<?php 

class Modal { 

    function __construct(string $id)
    {
        $this->modal_group_name = $id;
    }
    public function showModalTrigger(string $post_type_id, string $title, string $link_type = "button", string $class = "btn-primary"): void
    {
        if ($link_type === "button") { ?>
            <button type="button" class="btn <?= $class ?>" data-toggle="modal" data-target="#<?= $this->modal_group_name . '-' . $post_type_id ?>">
                <?= $title ?>
            </button><?php
        } else { ?>
            <a href="#" class="<?= $class ?>">
                <?= $title ?>
            </a><?php 
        }
    }
    public function showModal(string $post_type_id, string $confirm_link, string $title = 'Are you sure?', string $content = 'The content will be deleted permanently, with no way to recover.'): void
    {
        ?>
        <div class="modal fade" id="<?= $this->modal_group_name . '-' . $post_type_id ?>" tabindex="-1" role="dialog" >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= $title ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= $content ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="<?= $confirm_link ?>"><button type="button" class="btn btn-primary">Confirm</button></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}