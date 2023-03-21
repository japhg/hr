<!-- View Applicants -->
<div class="tab-pane" id="shortlisting">
              <!-- Button trigger modal -->

              <label for="filter-select">Filter by:</label>
              <select id="filter-select" class="form-select" style="box-shadow: none;">
                <option value="All">All</option>
                <option value="Short listed">Shortlisted</option>
                <option value="Not-Shortlisted">Not Shortlisted</option>

              </select>
              <table class="table table-sm table-borderless" id="example1" style="font-family: 'Roboto', sans-serif !important; text-align: center;">
                <thead class="bg-dark text-white">
                  <tr>
                    <th>Applicant ID</th>
                    <th>Applicant Name</th>
                    <th>Email Address</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Job Applied</th>
                    <th>Date Applied</th>
                    <th>Resume Attached</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <th>Actions</th>

                  </tr>
                </thead>
                <tbody>
                  <?php


                  $query = "SELECT job.*, applicant.*, resume.*, DATE_FORMAT(date_uploaded, '%M %d, %Y')as formatted_date FROM job_tbl job, applicant_tbl applicant, resume_tbl resume WHERE applicant.id = resume.a_id AND job.job_id = resume.j_id";
                  $result = mysqli_query($con, $query);
                  if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $resume =  $row['resume_attachment'];

                      if ($row['resume_status'] === "Shortlisting Rejected" || $row['resume_status'] !== "Shortlisted" && $row['resume_status'] !== "Not Shortlisted") {
                        continue;
                      }
                  ?>
                      <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['firstname'], ' ', $row['lastname']; ?></td>
                        <td><?php echo $row['email_address']; ?></td>
                        <td><?php echo $row['street'], " ", $row['barangay'], " ", $row['city'], " ", $row['states'], " ", $row['zip']; ?></td>
                        <td><?php echo $row['mobile_number']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['formatted_date']; ?></td>
                        <td><button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $row['r_id']; ?>" style="text-decoration: underline; box-shadow: none !important; outline: none !important;"><?php echo $row['resume_attachment']; ?></button></td>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal-<?php echo $row['r_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">RESUME ATTACHED</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <iframe <?php echo 'src="../../JobPortal/employer/resumeStorage/' . $row['resume_attachment'] . '"'; ?> height="1000" width="100%"></iframe>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        if ($row['resume_status'] === "Shortlisted") {
                        ?>

                          <td><span class="badge bg-success">Short listed</span></td>
                          <td><button type="button" name="shortlist" class="btn btn-primary" disabled>Shortlist</button></td>
                          <td><button type="button" name="reject" class="btn btn-dark" disabled>Reject</button></td>

                        <?php
                        } elseif ($row['resume_status'] === "Not Shortlisted") {
                        ?>
                          <td><span class="badge bg-secondary">Not-Shortlisted</span></td>

                          <td>
                            <input type="hidden" name="view" class="view" id="views" value="<?php echo $row['r_id']; ?>">
                            <a href="javascript:void(0)" class="shortlist_btn_ajax btn btn-primary">Shortlist</a>
                          </td>
                          <td>
                            <input type="hidden" name="rview" class="rview" id="rviews" value="<?php echo $row['r_id']; ?>">
                            <a href="javascript:void(0)" class="shortlist_reject_btn_ajax btn btn-dark">Reject</a>
                          </td>

                        <?php } ?>

                      </tr>
                  <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>




            <!-- Screening -->
            <div class="tab-pane" id="screening">

              <table class="table table-borderless" id="screening_dataTable" style="font-family: 'Roboto', sans-serif !important; text-align: center;">
                <thead class="bg-dark text-white">
                  <tr>
                    <th>ID</th>
                    <th>Candidate Name</th>
                    <th>Email Address</th>
                    <th>Contact Number</th>
                    <th>Resume file</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Action</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php


                  $query = "SELECT job.*, applicant.*, resume.*, DATE_FORMAT(date_uploaded, '%M %d, %Y')as formatted_date FROM job_tbl job, applicant_tbl applicant, resume_tbl resume WHERE applicant.id = resume.a_id AND job.job_id = resume.j_id";
                  $result = mysqli_query($con, $query);
                  if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $resume =  $row['resume_attachment'];

                      if ($row['resume_status'] === "Screening Rejected" || $row['resume_status'] !== "Shortlisted" && $row['resume_status'] !== "Appointed" && $row['resume_status'] !== "Screening Passed") {
                        continue;
                      }
                  ?>
                      <tr>
                        <td><?php echo $row['r_id']; ?></td>
                        <td><?php echo $row['firstname'], ' ', $row['lastname']; ?></td>
                        <td><?php echo $row['email_address']; ?></td>
                        <td><?php echo $row['mobile_number']; ?></td>
                        <td>
                          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $row['r_id']; ?>" style="text-decoration: underline; box-shadow: none !important; outline: none !important;">
                            <?php echo $row['resume_attachment']; ?>
                          </button>
                        </td>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal-<?php echo $row['r_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">RESUME ATTACHED</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <iframe <?php echo 'src="../../JobPortal/employer/resumeStorage/' . $row['resume_attachment'] . '"'; ?> height="1000" width="100%"></iframe>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        if ($row['resume_status'] === "Screening Passed") {
                        ?>

                          <td><span class="badge bg-success">Screening Passed</span></td>
                          <td><button type="button" name="appoint_passed" class="btn btn-primary" disabled>Appointed</button></td>
                          <td><button type="button" name="appoint_passed" class="btn btn-primary" disabled>Approved</button></td>
                          <td><button type="button" name="reject" class="btn btn-dark" disabled>Reject</button></td>

                        <?php
                        } elseif ($row['resume_status'] === "Shortlisted") {
                        ?>
                          <td><span class="badge bg-warning">Pending</span></td>
                          <td>
                            <button type="button" class="btn btn-primary appoint_screening">Appoint</button>
                          </td>
                          <td>

                          </td>
                          <td>
                            <input type="hidden" name="reject_appoint" class="reject_appoint" id="reject_appoint" value="<?php echo $row['r_id']; ?>">
                            <a href="javascript:void(0)" class="screening_reject_btn_ajax btn btn-dark">Reject</a>
                          </td>
                        <?php
                        } elseif ($row['resume_status'] === "Appointed") {
                        ?>
                          <td><span class="badge bg-secondary">Appointed</span></td>
                          <td>
                            <button type="button" class="btn btn-primary appoint_screening" disabled>Appointed</button>
                          </td>
                          <td>
                            <input type="hidden" name="approve_screening" class="approve_screening" id="approve_screening" value="<?php echo $row['r_id']; ?>">
                            <a href="javascript:void(0)" class="approve_screening_btn_ajax btn btn-success">Approve</a>
                          </td>
                          <td>
                            <a href="javascript:void(0)" class="screening_reject_btn_ajax btn btn-dark" disabled>Reject</a>
                          </td>

                        <?php } ?>
                    <?php }
                  } ?>
                </tbody>
              </table>

              <!-- Appoint Screening Modal Form ################################################################################################################################################# -->
              <div class="modal fade" id="appoint_screening" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Appoint Screening</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?php
                      $query = "SELECT * 
                        FROM resume_tbl";
                      $result = mysqli_query($con, $query);
                      if (mysqli_num_rows($result)) {
                        $row = mysqli_fetch_assoc($result);

                      ?>
                        <form action="actions.php" method="post" class="form-group needs-validation" novalidate>

                          <hr><br>
                          <input type="text" name="resume_id" id="resume_id" value="<?php echo $row['r_id']; ?>">
                          <div class="col-auto">
                            <label for="appointmentDateAndTime" class="form-label" style="color: #000;">Appoint Date and Time</label>
                            <input type="datetime-local" class="form-control" name="appointmentDateAndTime" id="appointmentDateAndTime" style="box-shadow: none;" required>
                            <div class="invalid-feedback">
                              This field is required.
                            </div>
                          </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" name="appoint_screening" class="btn btn-primary">Appoint</button>
                    </div>
                    </form>
                  <?php } ?>
                  </div>
                </div>
              </div>

            </div>

            <!-- Initial Interview -->
            <div class="tab-pane" id="initial-interview">



            </div>

            <!-- Final Interview -->
            <div class="tab-pane" id="final-interview">



            </div>


            <!-- Send Email -->
            <div class="tab-pane" id="send-email">



            </div>

            <!-- Send Email -->
            <div class="tab-pane" id="rejected-applicant">
              <table class="table table-borderless" id="example3">
                <thead class="bg-dark text-white">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Resume Attachment</th>
                    <th>Rejection Status</th>
                    <th>Rejection Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT resume.*, reject.*, DATE_FORMAT(rejection_date, '%M %d, %Y')as formatted_date FROM resume_tbl resume, rejected_applicant reject WHERE resume.r_id = reject.resume_id";
                  $result = mysqli_query($con, $query);
                  if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                      <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['resume_attachment']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['formatted_date']; ?></td>
                      </tr>
                  <?php }
                  }
                  ?>
                </tbody>
              </table>

            </div>