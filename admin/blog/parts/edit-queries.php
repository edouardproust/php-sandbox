<?php

$isEdit = true;
if (!empty($_GET['p']) && $_GET['p'] === "add") {
    $isEdit = false;
}
$pdo = new BlogPDO($rootPath . 'data/blog.db');
$error = null;
$success = null;

try {
    // ADD NEW
    if (!$isEdit) {
        if (!empty($_POST[$main_field])) {
            if ($has_upload) {
                $prepare_vars .= ', ' . $picture_field_name;
            }
            $prepare_vars_ids = ":" . str_replace(',', ', :', str_replace(' ', '', $prepare_vars));
            isset($_FILES['fileToUpload']['name']) ? $picture_name = $_FILES['fileToUpload']['name'] : $picture_name = null;
            $query = $pdo->prepare("INSERT INTO " . $pt_plural . " (" . $prepare_vars . ") VALUES (" . $prepare_vars_ids . ")");
            if ($has_upload) { // Add 1 variable
                $execute_command[$picture_field_name] = $picture_name;
            }
            $query->execute($execute_command);
            header("location:./edit-" . strtolower($pt_singular) . ".php?id=" . $pdo->lastInsertId() . "&i=new");
        }
        // EDIT
    } else {
        // Fill "value" fields attribute for this post
        $query = $pdo->prepare("SELECT * FROM " . $pt_plural . " WHERE id = :id");
        $query->execute(['id' => $_GET['id']]);
        $postType = $query->fetch(); // $postType is used to prefill the form inside edit-*.php
        // Update data
        if (!empty($_POST[$main_field])) {
            // File upload conditions
            if ($has_upload) {
                $picture_name = $_FILES['fileToUpload']['name'];
                // To not replace $picture_name by '' while updating post without choising a new image:
                if ($picture_name === '' && !isset($_POST['file-delete'])) {
                    $query = $pdo->prepare("SELECT " . $picture_field_name . " FROM " . $pt_plural . " WHERE id = :id");
                    $query->execute(['id' => $_GET['id']]);
                    $picture = $query->fetch();
                    $picture_name = $picture->$picture_field_name;
                } elseif (isset($_POST['file-delete']) && $_POST['file-delete'] === 'on') { // If "Remove file" is checked
                    $picture_name = null;
                }
            }
            // Update query
            // Generate vars list ($ptResult) from $prepare_vars
            if ($has_upload) { // Add 1 variable
                $prepare_vars .= ", " . $picture_field_name;
            }
            $ptInput = (array)explode(',', str_replace(' ', '', $prepare_vars));
            foreach ($ptInput as $ptItem) {
                $ptItem = $ptItem . ' = :' . $ptItem;
                $ptResult[] = $ptItem;
            }
            $ptResult = implode(', ', $ptResult);
            $query = $pdo->prepare("UPDATE " . $pt_plural . " SET " . $ptResult . " WHERE id = :id");
            if ($has_upload) { // Add 2 variables
                $execute_command[$picture_field_name] = $picture_name;
            }
            $execute_command['id'] = $_GET['id'];
            $query->execute($execute_command);
            // Redirect
            header("location:./edit-" . strtolower($pt_singular) . ".php?id=" . $_GET['id'] . "&i=edit");
        }
    }
} catch (PDOException $e) {
    $error = ucfirst($pt_singular) . ' was not saved because of an error:<br><small>' . $e->getMessage() . '</small>';
}
if (!empty($_GET['i'])) {
    $success = ucfirst($pt_singular) . ' published successfully. Go back to <a href="' . $rootPath . 'admin/blog/' . $index_redirection . '">list</a>';
}

$isEdit ? $title = "Edit " . strtolower($pt_singular) : $title = "Add a new " . strtolower($pt_singular);

// Breadcrumb
$bc_post = new BreadcrumbBlog(
    [
        "Admin" => '/admin',
        ucfirst($pt_plural) => $index_redirection
    ],
    $title
);

require $rootPath . 'includes/header.php';
?>
<!-- breadcrumb -->
<div class="small text-muted my-2"><?= $bc_post->show_breadcrumb() ?></div>
<hr>

<?php
if (!empty($error)) : ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php elseif (isset($success)) : ?>
    <div class="alert alert-success"><?= $success ?></div>
<?php endif;
