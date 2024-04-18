<?php
include 'connection.php';
if (isset($_POST['dataInput']) && !empty($_POST['dataInput'])) {
  $dataInput = trim($_POST['dataInput']);
  $due_date = $_POST['due_date'];
  if (!empty($dataInput && $due_date)) {
    $sql = "insert into to_do_data (title, added_date, due_date) values ('$dataInput', NOW(), '$due_date')";
    if ($conn->query($sql) === TRUE) {
      echo "Task Added Successfully...";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    exit();
  }
}
?>