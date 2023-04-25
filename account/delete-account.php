<head>
    <meta charset="UTF-8">
    <title>Delete Account</title>
    <link rel="stylesheet" href="../css/custome.css">
    <link rel="stylesheet" href="../css/styles1.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/icons/all.css">
    <script src="../js/login.js"></script>
    <style>
        .delete-account-form {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 500px;
            padding: 40px;
            transform: translate(-50%, -50%);
            background: #2c2f34;
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
            border-radius: 10px;
        }

        h3 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #fff;
        }

        p {
            margin-bottom: 20px;
            color: #fff;
        }

        ul {
            margin-bottom: 20px;
            margin-left: 20px;
            color: #fff;
        }

        li {
            margin-bottom: 5px;
            margin-left: 20px;
            color: #fff;
        }

        .delete-button {
            background-color: #d9534f;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<?php
include_once("../connectDB.php");
if (isset($_SESSION['us'])) {
    $account = $_SESSION['us'];
    $query = mysqli_query($Connect, "SELECT password from customer where username='$account' ");
    $row = mysqli_fetch_array($query);

?>
    <div class="container">
        <form method="post">
            <div class="delete-account-form">
                <h3>Delete Account</h3>
                <p>Deleting your account will also permanently delete the following information:</p>
                <ul>
                    <li>My previous orders</li>
                    <li>My favorite order</li>
                    <li>Saved shipping address</li>
                </ul>
                <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                <button type="submit" class="delete-button" name="delete-account">Delete</button>
            </div>
        </form>
    </div>
<?php
}
?>
<script>
  $(document).ready(function() {
    $('form').submit(function(event) {
      event.preventDefault();
      swal({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        buttons: {
          cancel: "Cancel",
          confirm: "Delete"
        },
      }).then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: "delete_account.php",
            type: "POST",
            data: {
              username: "<?php echo $account; ?>"
            },
            success: function(response) {
              swal({
                title: "Success!",
                text: "Your account has been deleted.",
                icon: "success",
                buttons: {
                  confirm: "OK"
                },
              }).then(function() {
                window.location.href = "../index.php";
              });
            },
            error: function() {
              swal({
                title: "Error!",
                text: "An error occurred while deleting your account.",
                icon: "error",
                buttons: {
                  confirm: "OK"
                },
              });
            }
          });
        }
      });
    });
  });
</script>