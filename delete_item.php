<?php
include 'connection.php';
if (isset($_POST['del_id']) && !empty($_POST['del_id'])) {
  $del_id = trim($_POST['del_id']);

  if (!empty($del_id)) {
    $stmt = $conn->prepare("SELECT COUNT(id) AS cnt FROM to_do_data WHERE id = :del_id");
    $stmt->bindParam(':del_id', $del_id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $cnt = $row['cnt'];

    if ($cnt > 0) {
      $stmt = $conn->prepare("DELETE FROM to_do_data WHERE id = :del_id");
      $stmt->bindParam(':del_id', $del_id);

      if ($stmt->execute()) {
        echo "Task Deleted Successfully..";
        exit();
      }
    }
  }
}
?>