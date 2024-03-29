<?php include('includes/header.php'); ?>
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb bg-white">
          <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
              <h4 class="page-title">Dashboard</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                  <li><a href="#" class="fw-normal">Dashboard</a></li>
                </ol>
              </div>
            </div>
          </div>
          <!-- /.col-lg-12 -->
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Three charts -->
          <!-- ============================================================== -->
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-12">
              <div class="white-box analytics-info">
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                  <li>
                  <h3 class="box-title">Total Contacts</h3>
                  </li>
                  <li class="ms-auto">
                    <span class="counter text-success">0</span>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-lg-4 col-md-12">
              <div class="white-box analytics-info">
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                  <li>
                  <h3 class="box-title">New Contacts</h3>
                  </li>
                  <li class="ms-auto">
                    <span class="counter text-purple">0</span>
                  </li>
                </ul>
              </div>
            </div>

          </div>
          <!-- ============================================================== -->
          <!-- RECENT CONTACTS -->
          <!-- ============================================================== -->
          <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
              <div class="white-box">
                <div class="d-md-flex mb-3">
                  <h3 class="box-title mb-0">Recently added contacts</h3>
                  <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                    Feel like I should add something here
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table no-wrap">
                    <thead>
                      <tr>
                        <th class="border-top-0">Name</th>
                        <th class="border-top-0">Email</th>
                        <th class="border-top-0">Phone</th>
                        <th class="border-top-0">Added</th>
                        <th class="border-top-0"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 

                      $CI =& get_instance();
                      $CI->load->library('customencryption');

                      foreach($contacts as $contact){
                        // I wnat April 14, 2021
                        $added_date = date('F d, Y ', $contact->created_at);
                        $key = $CI->customencryption->encrypt($contact->id);

                        echo "
                        <tr>
                          <td>{$contact->first_name} {$contact->last_name}</td>
                          <td><a href='mailto:$contact->email'>$contact->email</a></td>
                          <td><a href='tel:$contact->phone'>$contact->phone</a></td>
                          <td>{$added_date}</td>
                          <td>
                            <a href='/contacts/view/$key'>View</a> | 
                            <a href='/contacts/edit/$key'>Edit</a>
                          </td>
                        </tr>
                        ";
                      }

                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- ============================================================== -->
          <!-- Recent Comments -->
          <!-- ============================================================== -->
          <div class="row">
            <!-- .col -->
            <div class="col-md-12 col-lg-8 col-sm-12">
              <div class="card white-box p-0">
                <div class="card-body">
                  <h3 class="box-title mb-0">Recent Comments</h3>
                </div>
                <div class="comment-widgets">
                  <!-- Comment Row -->
                  <div class="d-flex flex-row comment-row p-3 mt-0">
                    <div class="p-2">
                      <img
                        src="plugins/images/users/varun.jpg"
                        alt="user"
                        width="50"
                        class="rounded-circle"
                      />
                    </div>
                    <div class="comment-text ps-2 ps-md-3 w-100">
                      <h5 class="font-medium">James Anderson</h5>
                      <span class="mb-3 d-block"
                        >Lorem Ipsum is simply dummy text of the printing and
                        type setting industry.It has survived not only five
                        centuries.
                      </span>
                      <div class="comment-footer d-md-flex align-items-center">
                        <span class="badge bg-primary rounded">Pending</span>

                        <div class="text-muted fs-2 ms-auto mt-2 mt-md-0">
                          April 14, 2021
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Comment Row -->
                  <div class="d-flex flex-row comment-row p-3">
                    <div class="p-2">
                      <img
                        src="plugins/images/users/genu.jpg"
                        alt="user"
                        width="50"
                        class="rounded-circle"
                      />
                    </div>
                    <div class="comment-text ps-2 ps-md-3 active w-100">
                      <h5 class="font-medium">Michael Jorden</h5>
                      <span class="mb-3 d-block"
                        >Lorem Ipsum is simply dummy text of the printing and
                        type setting industry.It has survived not only five
                        centuries.
                      </span>
                      <div class="comment-footer d-md-flex align-items-center">
                        <span class="badge bg-success rounded">Approved</span>

                        <div class="text-muted fs-2 ms-auto mt-2 mt-md-0">
                          April 14, 2021
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Comment Row -->
                  <div class="d-flex flex-row comment-row p-3">
                    <div class="p-2">
                      <img
                        src="plugins/images/users/ritesh.jpg"
                        alt="user"
                        width="50"
                        class="rounded-circle"
                      />
                    </div>
                    <div class="comment-text ps-2 ps-md-3 w-100">
                      <h5 class="font-medium">Johnathan Doeting</h5>
                      <span class="mb-3 d-block"
                        >Lorem Ipsum is simply dummy text of the printing and
                        type setting industry.It has survived not only five
                        centuries.
                      </span>
                      <div class="comment-footer d-md-flex align-items-center">
                        <span class="badge rounded bg-danger">Rejected</span>

                        <div class="text-muted fs-2 ms-auto mt-2 mt-md-0">
                          April 14, 2021
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
              <div class="card white-box p-0">
                <div class="card-heading">
                  <h3 class="box-title mb-0">Chat Listing</h3>
                </div>
                <div class="card-body">
                  <ul class="chatonline">
                    <li>
                      <div class="call-chat">
                        <button
                          class="btn btn-success text-white btn-circle btn"
                          type="button"
                        >
                          <i class="fas fa-phone"></i>
                        </button>
                        <button
                          class="btn btn-info btn-circle btn"
                          type="button"
                        >
                          <i class="far fa-comments text-white"></i>
                        </button>
                      </div>
                      <a
                        href="javascript:void(0)"
                        class="d-flex align-items-center"
                        ><img
                          src="plugins/images/users/varun.jpg"
                          alt="user-img"
                          class="img-circle"
                        />
                        <div class="ms-2">
                          <span class="text-dark"
                            >Varun Dhavan
                            <small class="d-block text-success d-block"
                              >online</small
                            ></span
                          >
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="call-chat">
                        <button
                          class="btn btn-success text-white btn-circle btn"
                          type="button"
                        >
                          <i class="fas fa-phone"></i>
                        </button>
                        <button
                          class="btn btn-info btn-circle btn"
                          type="button"
                        >
                          <i class="far fa-comments text-white"></i>
                        </button>
                      </div>
                      <a
                        href="javascript:void(0)"
                        class="d-flex align-items-center"
                        ><img
                          src="plugins/images/users/genu.jpg"
                          alt="user-img"
                          class="img-circle"
                        />
                        <div class="ms-2">
                          <span class="text-dark"
                            >Genelia Deshmukh
                            <small class="d-block text-warning"
                              >Away</small
                            ></span
                          >
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="call-chat">
                        <button
                          class="btn btn-success text-white btn-circle btn"
                          type="button"
                        >
                          <i class="fas fa-phone"></i>
                        </button>
                        <button
                          class="btn btn-info btn-circle btn"
                          type="button"
                        >
                          <i class="far fa-comments text-white"></i>
                        </button>
                      </div>
                      <a
                        href="javascript:void(0)"
                        class="d-flex align-items-center"
                        ><img
                          src="plugins/images/users/ritesh.jpg"
                          alt="user-img"
                          class="img-circle"
                        />
                        <div class="ms-2">
                          <span class="text-dark"
                            >Ritesh Deshmukh
                            <small class="d-block text-danger"
                              >Busy</small
                            ></span
                          >
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="call-chat">
                        <button
                          class="btn btn-success text-white btn-circle btn"
                          type="button"
                        >
                          <i class="fas fa-phone"></i>
                        </button>
                        <button
                          class="btn btn-info btn-circle btn"
                          type="button"
                        >
                          <i class="far fa-comments text-white"></i>
                        </button>
                      </div>
                      <a
                        href="javascript:void(0)"
                        class="d-flex align-items-center"
                        ><img
                          src="plugins/images/users/arijit.jpg"
                          alt="user-img"
                          class="img-circle"
                        />
                        <div class="ms-2">
                          <span class="text-dark"
                            >Arijit Sinh
                            <small class="d-block text-muted"
                              >Offline</small
                            ></span
                          >
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="call-chat">
                        <button
                          class="btn btn-success text-white btn-circle btn"
                          type="button"
                        >
                          <i class="fas fa-phone"></i>
                        </button>
                        <button
                          class="btn btn-info btn-circle btn"
                          type="button"
                        >
                          <i class="far fa-comments text-white"></i>
                        </button>
                      </div>
                      <a
                        href="javascript:void(0)"
                        class="d-flex align-items-center"
                        ><img
                          src="plugins/images/users/govinda.jpg"
                          alt="user-img"
                          class="img-circle"
                        />
                        <div class="ms-2">
                          <span class="text-dark"
                            >Govinda Star
                            <small class="d-block text-success"
                              >online</small
                            ></span
                          >
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="call-chat">
                        <button
                          class="btn btn-success text-white btn-circle btn"
                          type="button"
                        >
                          <i class="fas fa-phone"></i>
                        </button>
                        <button
                          class="btn btn-info btn-circle btn"
                          type="button"
                        >
                          <i class="far fa-comments text-white"></i>
                        </button>
                      </div>
                      <a
                        href="javascript:void(0)"
                        class="d-flex align-items-center"
                        ><img
                          src="plugins/images/users/hritik.jpg"
                          alt="user-img"
                          class="img-circle"
                        />
                        <div class="ms-2">
                          <span class="text-dark"
                            >John Abraham<small class="d-block text-success"
                              >online</small
                            ></span
                          >
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- /.col -->
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
<?php include('includes/footer.php'); ?>