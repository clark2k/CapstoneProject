<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">UPDATE ACCOUNT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="updateForm" action="update.php" method="post">
                  <input type="hidden" name="userId" id="userId">
                  <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Firstname" required>
                  </div>
                  <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Lastname" required>
                  </div>
                  <div class="form-group">
                    <label for="lname">Department</label>
                    <input type="text" class="form-control" id="department" name="department"   placeholder="Enter Department" required>
                  </div>
                  <div class="form-group">
                    <label for="lname">Student ID number</label>
                    <input type="text" class="form-control" id="id" name="id"  placeholder="Enter Student ID Number" required>
                  </div>
                  <div class="form-group">
                    <label for="lname">Email</label>
                    <input type="text" class="form-control" id="email" name="email"  placeholder="Enter Email" required>
                  </div>
                  <div class="form-group">
                    <label for="lname">Password</label>
                    <input type="text" class="form-control" id="password" name="password"  placeholder="Enter Password" required>
                  </div>
                  <!-- Add other fields as needed -->
                  <button type="submit" class="btn">Update</button>
                </form>
              </div>
            </div>
          </div>
        </div>
