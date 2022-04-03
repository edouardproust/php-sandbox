<?php
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;
require_once $root . 'PDO' . DIRECTORY_SEPARATOR . 'BlogPDO.php';
require_once $root . 'Modals' . DIRECTORY_SEPARATOR . 'Modal.php';

class PostTypeTable
{

    public function __construct(array $db_tables, string $rootPath)
    {
        $this->db_tables = $db_tables;
        $this->rootPath = $rootPath;
    }

    public function getPostTypeTable(bool $show_view_btn = true)
    {
        $error = null;
        $pdo = new BlogPDO($this->rootPath . 'data/blog.db');

        foreach ($this->db_tables as $table_name => $data) {
            $fields = implode(', ', $data['fields']);
            try {
                $query = $pdo->query("SELECT " . $fields . " FROM " . $table_name . " ORDER BY " . $data['order_by']);
                $tables[$table_name] = $query->fetchAll();
                if (isset($_GET['id']) && isset($_GET['info'])) {
                    if ($_GET['info'] === 'delete-cat') {
                        $query = $pdo->prepare("DELETE FROM " . $table_name . " WHERE id = :id");
                        var_dump($query);
                        $query->execute([
                            'id' => $_GET['id']
                        ]);
                    }
                }
            } catch (PDOException $e) {
                $errors[] = $data['singular'] . ' not deleted because of a query error:<br><small>' . $e->getMessage() . '<br><pre>' . var_dump($query) . '</pre></small>';
            }
            if (isset($_GET['info'])) {
                if ($_GET['info'] === 'del-success') {
                    $success = ucfirst($_GET['type']) . " deleted successfully";
                } elseif ($_GET['info'] === 'del-noid') {
                    $error = ucfirst($_GET['type']) . " was not deleted because no post ID were submited. Please delete posts from <a href='./index.php'>here</a>";
                } elseif ($_GET['info'] === 'del-error') {
                    $error = ucfirst($_GET['type']) . " not deleted because of a SQL error: " . $_GET['msg'];
                }
            }
            $sections[] = $table_name;
        }
        if (count($sections) > 1) {
            $title_str = ucwords(implode(', ', $sections));
            $title = substr_replace($title_str, ' & ', strrpos($title_str, ', '), 2);
        } else {
            $title = ucwords($sections[0]);
        }

        // Breadcrumb
        $bc_post = new BreadcrumbBlog(["Admin" => '/admin'], $title);

        require $this->rootPath . 'includes/header.php'; ?>

        <!-- breadcrumb -->
        <div class="small text-muted my-2"><?= $bc_post->show_breadcrumb() ?></div>
        <hr>

        <?php if (!empty($error)) {
            echo '<div class="alert alert-danger mb-3">' . $error . '</div>';
        } elseif (!empty($success)) {
            echo '<div class="alert alert-success mb-3">' . $success . '</div>';
        }

        $col_width = 12;
        if (count($this->db_tables) > 1) {
            $col_width = 6;
        }
        ?>
        <p class="lead mb-5">Choose an item to edit.</p>

        <div class="row mt-5">
            <?php foreach ($tables as $table_name => $table_items) :
                $table_name_singular = $this->db_tables[$table_name]['singular'];
                $main_field = (string)$data['main_field'] ?>
                <div class="col-md-<?= $col_width ?> mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <h2><?= ucfirst($table_name) ?></h2>
                        <a href="<?= $this->rootPath . 'admin/blog/edit-' . $table_name_singular . '.php?p=add' ?>">
                            <button class="btn btn-primary ml-3">Add new</button>
                        </a>
                    </div>
                    <div class="card">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Post</th>
                                    <th>Options</th>
                                    <th>ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($table_items as $item) :
                                    $modal_delete[$table_name] = new Modal($table_name . '-del-confirm');
                                    $modals_id[$table_name][] = $item->id ?>
                                    <tr>
                                        <td style="vertical-align: middle"><?= htmlentities($item->$main_field) ?></td>
                                        <td style="vertical-align: middle">
                                            <div class="my-1">
                                                <a href="<?= $this->rootPath . 'admin/blog/edit-' . $table_name_singular . '.php?id=' . $item->id ?>">
                                                    <button class="btn btn-primary btn-sm mr-2">Edit</button>
                                                </a>
                                                <?php if ($show_view_btn) : ?>
                                                    <a href="<?= $this->rootPath . 'blog/' . $table_name_singular . '.php?id=' . $item->id ?>">
                                                        <button class="btn btn-success btn-sm mr-2">View</button>
                                                    </a>
                                                <?php endif ?>
                                                <?php $modal_delete[$table_name]->showModalTrigger($item->id, 'Delete', 'button', 'btn-danger btn-sm') ?>
                                            </div>
                                        </td>
                                        <td class="small text-muted" style="vertical-align: middle">#<?= $item->id ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
<?php
        foreach ($this->db_tables as $table_name => $data) {
            foreach ($modals_id[$table_name] as $modal_id) {
                $modal_delete[$table_name]->showModal($modal_id, './delete.php?type=' . $data['singular'] . '&id=' . $modal_id);
            }
        }
    }
}
