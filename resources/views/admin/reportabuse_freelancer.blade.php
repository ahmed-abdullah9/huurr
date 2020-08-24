@include ('include/header_admin')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Freelance Report Abuse</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Freelancer</th>
              <th>Reported By</th>
              <th>Reason</th>
              <th>Reported At</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $freelancerToArray = json_decode(json_encode($freelancer), true);
            if (!empty($freelancerToArray)) {
                foreach ($freelancerToArray as $user) {
                    echo '<tr>';
                    echo '<td>'.$user['freelancer'].'</td>';
                    echo '<td>'.$user['client'].'</td>';
                    echo '<td>'.$user['description'].'</td>';
                    echo '<td>'.date('M d, Y', strtotime($user['created_at'])).'</td>';
                    echo '</tr>';
                }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

@include ('include/footer_admin')
