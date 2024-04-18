<?php
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personal To-Do List Manager</title>
  <link rel="stylesheet" href="style.css">
  <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

</head>

<body>

  <div class="modal fade" id="mymodal_comp2" style="display: none;">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #bfd8ee;">
          <h4 class="modal-title">Edit Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #c00000;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="data_show"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"
            style="background-color: #3c8dbc; color: #fff; font-weight: 800;">Close</button>
        </div>
      </div>
    </div>
  </div>


  <div class="todo-app">
    <div class="col-md-12" style="padding-bottom: 12px;">
      <h1 class="box-title"
        style="background-color: #b8c0c6;color: #41454b;font-weight: 700;margin-left: 129px;border-radius: 19px;margin-right: 137px;padding-bottom: 11px;">
        Personal To-Do List
        Manager</h1>
    </div>
    <form class="input-section">
      <input id="todoInput" type="text" placeholder="Add item..." />
      <div style="display: flex;">
        <input type="text" id="my_date_picker" placeholder="Add Due Date..." style="margin-left: 9px;">
      </div>
      <button id="addBtn" class="add" onclick="add_data()">Add</button>
      <button type="button" class="add" id="update-button" style="display: none">Update</button>
      <input type="text" id="search-input" placeholder="Search" />
      <button type="button" id="search-button">Search</button>

    </form>
    <?php
    $todos = $conn->query("SELECT * FROM to_do_data ORDER BY id DESC");
    ?>
    <div class="todos">
      <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
        <ul class="todo-list">
          <li class="li" id="todo-list-<?php echo $todo['id']; ?>" <?php if ($todo['checked'] == 1) { ?>
              style="background-color: green;" title="Task Completed" <?php } ?>>
            <input class="form-check-input" type="checkbox" onclick="doneTask(<?php echo $todo['id'] ?>)">
            <label class="form-check-label" for="inlineCheckbox1"></label>
            <span class="todo-text"><?php echo $todo['title'] ?></span>
            <span class="todo-text" title="Added Date"><?php echo $todo['added_date'] ?></span>
            <span class="todo-text" title="Due Date"><?php echo $todo['due_date'] ?></span>
            <span class="span-button" title="Delete" onclick="delete_data(<?php echo $todo['id'] ?>)"><i
                class="fa fa-trash"></i></span>
            <span class="span-button" title="Edit" onclick="edit_data(<?php echo $todo['id'] ?>)"><i
                class="fa fa-pen"></i></span>
          </li>
        </ul>
      <?php } ?>
      <?php if ($todos->rowCount() <= 0) { ?>
        <h1 class="not-found"> No Data Found</h1>
      <?php } ?>
    </div>
  </div>


  <script src="script.js"></script>

</body>

</html>

</html>