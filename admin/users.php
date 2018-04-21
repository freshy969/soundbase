<?php

  session_start();

  include "includes/head.php";
  require "../conf.inc.php";
  require "../functions.php";

  if (!isConnected() || !isAdmin()) {
    header("Location: ../login.php");
  }

?>

<body>
  <div id="wrapper">
    <?php include "includes/nav.php"; ?>
    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Users</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              Users list
            </div>
            <div class="panel-body">
              <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="dataTables_length" id="dataTables-example_length">
                      <label>Show <select name="dataTables-example_length" aria-controls="dataTables-example" class="form-control input-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select> entries</label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div id="dataTables-example_filter" class="dataTables_filter">
                      <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="dataTables-example"></label>
                    </div>
                  </div>
                </div>
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $connection = connectDB();
                      $sql = $connection->prepare("SELECT username,name,email FROM MEMBER");
                      $sql->execute();
                      $result = $sql->fetchAll(\PDO::FETCH_ASSOC);

                      foreach ($result as $user) {
                        echo '<tr class="odd gradeX">';
                        echo '<td>' . $user['username'];
                        echo '<td>' . $user['name'];
                        echo '<td>' . $user['email'];
                        echo '<td><a href="user_edit.php?email=' . $user['email'] . '">Edit</a>';
                        echo "</tr>";
                      }
                    ?>
                  </tbody>
                </table>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">
                      Showing 1 to 10 of 57 entries
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                      <ul class="pagination">
                        <li class="paginate_button previous disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="#">Previous</a></li>
                        <li class="paginate_button active" aria-controls="dataTables-example" tabindex="0"><a href="#">1</a></li>
                        <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">2</a></li>
                        <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">3</a></li>
                        <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">4</a></li>
                        <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">5</a></li>
                        <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">6</a></li>
                        <li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="#">Next</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<?php
  include "includes/footer.php";
?>
