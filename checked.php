<?php
include 'connection.php';

if (isset($_POST['checked_id']) && !empty($_POST['checked_id'])) {
  $checked_id = intval($_POST['checked_id']);
  $checked_input = 1;

  $stmt = $conn->prepare("SELECT COUNT(id) AS cnt FROM to_do_data WHERE id = :checked_id");
  $stmt->bindParam(':checked_id', $checked_id, PDO::PARAM_INT);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $cnt = $row['cnt'];

  if ($cnt > 0) {
    $stmt_update = $conn->prepare("UPDATE to_do_data SET checked = :checked_input WHERE id = :checked_id");
    $stmt_update->bindParam(':checked_input', $checked_input, PDO::PARAM_INT);
    $stmt_update->bindParam(':checked_id', $checked_id, PDO::PARAM_INT);

    if ($stmt_update->execute()) {
      echo "Task Updated Successfully.";
    }
  }
}
?>