$(document).ready(function () {
  $(function () {
    $("#my_date_picker").datepicker();
  });
});

function add_data() {
  var dataInput = $("#todoInput").val();
  var due_date = $("#my_date_picker").val();
  if (dataInput.trim() === "") {
    alert("Please enter a task");
    return;
  }
  if (due_date.trim() === "") {
    alert("Please pick a date");
    return;
  }
  $.ajax({
    type: "POST",
    url: "add_item.php",
    data: {
      dataInput: dataInput,
      due_date: due_date,
    },
    success: function (response) {
      location.reload();
      console.log("Data added successfully:", response);
    },
    error: function (xhr, status, error) {
      console.error("Error adding data:", error);
      alert("Error adding data. Please try again.");
    },
  });
}

function delete_data(id) {
  $.ajax({
    type: "POST",
    url: "delete_item.php",
    data: {
      del_id: id,
    },
    success: function (data) {
      location.reload();
      console.log("Data deleted successfully:", data);
    },
    error: function (xhr, status, error) {
      console.error("Error deleting data:", error);
      alert("Error adding data. Please try again.");
    },
  });
}
function edit_data(id) {
  $.ajax({
    type: "POST",
    url: "edit_item.php",
    data: { edit_id: id },
    success: function (response) {
      $("#mymodal_comp2").modal("show");
      $("#data_show").html(response);
    },
    error: function (xhr, status, error) {
      console.error("AJAX Request Error:", status, error);
      alert("An error occurred while fetching data.");
    },
  });
}

function update_data(id) {
  var title_input = $("#title_input").val();
  var due_val = $("#due_input").val();
  var email_input = $("#email_input").val();
  var no_input = $("#no_input").val();

  let gmail_val = $("#gmail_" + id).prop("checked");
  alert(gmail_val);
  if (gmail_val) {
    gmail_val = 1;
  }
  

  let mobile_val = $("#mobile_" + id).prop("checked");
  if (mobile_val) {
    mobile_val = 1;
  }

  $.ajax({
    type: "POST",
    url: "update_item.php",
    data: {
      update_id: id,
      title_input: title_input,
      due_val: due_val,
      email_input: email_input,
      no_input: no_input,
      gmail: gmail_val,
      mobile: mobile_val,
    },
    success: function (response) {
      location.reload();
    },
    error: function (xhr, status, error) {
      console.error("AJAX Request Error:", status, error);
      alert("An error occurred while updating data.");
    },
  });
}

$(document).ready(function () {
  $("#search-button").click(function () {
    var searchTerm = $("#search-input").val().trim().toLowerCase();
    $(".todo-list .li").each(function () {
      var titleText = $(this).find(".todo-text:first").text().toLowerCase();
      if (titleText.includes(searchTerm)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });
  $("#search-input").keyup(function () {
    if ($(this).val().trim() === "") {
      $(".todo-list .li").show();
    }
  });
});

function doneTask(todoId) {
  var todoItem = $("#todo-list-" + todoId);
  todoItem.css("background-color", "green");

  $.ajax({
    type: "POST",
    url: "checked.php",
    data: { checked_id: todoId },
    success: function (response) {
      console.log("Task marked as done successfully.");
    },
    error: function (xhr, status, error) {
      console.error("AJAX Request Error:", status, error);
      alert("An error occurred while marking the task as done.");
    },
  });
}


function send_mail(id) {
  $.ajax({
    type: "POST",
    url: "send_mail.php",
    data: {
      send_mail_id: id,
      send_id : id
    },
    success: function (data) {
      alert(data);
      // location.reload();
      // console.log("Data deleted successfully:", data);
    },
    error: function (xhr, status, error) {
      console.error("Error deleting data:", error);
      alert("Error adding data. Please try again.");
    },
  });
}