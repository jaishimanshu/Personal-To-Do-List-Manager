<?php
include 'connection.php';

if (isset($_POST['edit_id']) && !empty($_POST['edit_id'])) {
  $edit_id = $_POST['edit_id'];

  if (!empty($edit_id)) {
    $stmt = $conn->prepare("SELECT * FROM to_do_data WHERE id = :edit_id");
    $stmt->bindParam(':edit_id', $edit_id);
    $stmt->execute();
    $show_data = $stmt->fetchAll(PDO::FETCH_OBJ);
    if (count($show_data) > 0) {
      $html = '<table class="table table-bordered table-striped no-footer datatable" id="example2">';
      $html .= '<thead><tr style="background-color: #cbdfd1;">';
      $html .= '<th class="first-head">Sno</th>';
      $html .= '<th class="second-head">Task</th>';
      $html .= '<th class="third-head">Added Date</th>';
      $html .= '<th class="fourth-head">Due Date</th>';
      $html .= '<th class="fifth-head">Email Id</th>';
      $html .= '<th class="sixth-head">Phone No</th>';
      $html .= '<th class="seventh-head">Action</th>';
      $html .= '</tr></thead><tbody>';
      $i = 1;
      foreach ($show_data as $row) {
        $dueDate = date('Y-m-d', strtotime($row->due_date));
        $html .= '<tr class="tbl_row">';
        $html .= '<td class="first-col">' . $i . '</td>';
        $html .= '<td class="second-col"><input id="title_input" type="text" value="' . $row->title . '"/></td>';
        $html .= '<td class="third-col">' . $row->added_date . '</td>';
        $html .= '<td class="fourth-col"><input type="date" id="due_input" value="' . htmlspecialchars($dueDate) . '"></td>';
        $html .= '<td class="fifth-col"><input id="email_input" type="text" value="' . $row->email_id . '"/><input type="checkbox" id="gmail_' . $row->id . '" value="' . $row->gmail_flag . '"';
        if ($row->gmail_flag == 1) {
          $html .= ' checked';
        }
        $html .= ' title="Gmail Notification">';

        $html .= '<td class="sixth-col"><input id="no_input" type="text" value="' . $row->mobile_no . '"/> <input type="checkbox" id="mobile_' . $row->id . '" value="' . $row->mobile_flag . '" ';
        if ($row->mobile_flag == 1) {
          $html .= ' checked';
        }
        $html .= ' title="Mobile Notification" style="margin: 5px;"></td>';
        $html .= '<td class="seventh-col"><a title="Delete" style="cursor:pointer;" onclick="delete_data(' . $edit_id . ')"><i class="fa fa-trash"></i></a><a style="float:right;cursor:pointer"; title="Save" onclick="update_data(' . $edit_id . ')"><i class="fa fa-check"></i></a>
        </td>';
        $html .= '</tr>';
        $i++;
      }
      $html .= '</tbody></table>';

      $html .= '<script>
                        $(document).ready(function() {
                            $("#example2").DataTable({
                                "paging": false,
                                "order": [[1, "asc"]],
                                "info": true,
                                "columnDefs": [{
                                    "targets": 0,
                                    "searchable": false,
                                    "orderable": false
                                }]
                            }).on("order.dt search.dt", function() {
                                $("#example2").DataTable().column(0, {search: "applied", order: "applied"}).nodes().each(function(cell, i) {
                                    cell.innerHTML = i + 1;
                                });
                            }).draw();
                        });
                     </script>';

      echo $html;
      exit();
    } else {
      echo "No data found for this ID.";
      exit();
    }
  }
}

echo "Invalid edit ID.";
?>