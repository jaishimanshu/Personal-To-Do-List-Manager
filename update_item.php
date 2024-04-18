<?php
include 'connection.php';

if (isset($_POST['update_id']) && !empty($_POST['update_id'])) {
  $update_id = intval($_POST['update_id']);
  $title_input = trim($_POST['title_input']);
  $due_input = trim($_POST['due_val']);
  $email_input = trim($_POST['email_input']);
  $no_input = trim($_POST['no_input']);
  echo "<li>" . $gmail = trim($_POST['gmail']);
  echo "<li>" . $mobile = trim($_POST['mobile']);


  $stmt = $conn->prepare("SELECT COUNT(id) AS cnt FROM to_do_data WHERE id = :update_id");
  $stmt->bindParam(':update_id', $update_id);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $cnt = $row['cnt'];

  if ($cnt > 0) {
    $stmt_update = $conn->prepare("UPDATE to_do_data SET title = :title_input, due_date = :due_input, email_id = :email_input, mobile_no = :no_input, gmail_flag = :gmail, mobile_flag = :mobile WHERE id = :update_id");
    $stmt_update->bindParam(':title_input', $title_input);
    $stmt_update->bindParam(':due_input', $due_input);
    $stmt_update->bindParam(':email_input', $email_input);
    $stmt_update->bindParam(':no_input', $no_input);
    $stmt_update->bindParam(':update_id', $update_id);
    $stmt_update->bindParam(':gmail', $gmail);
    $stmt_update->bindParam(':mobile', $mobile);


    if ($stmt_update->execute()) {
      echo "Task Updated Successfully.";
      exit();
    }
  }
}
?>