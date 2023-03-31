<?php
session_start();
if (isset($_SESSION['u_id'])) {
  include('frontend/header.php');
  include('frontend/sidebar.php');
?>

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation__shake" src="assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div> -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Chat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Chat</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">

          <div class="col-md-8">
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary">
              <div class="card-header">
                <h3 class="card-title">Chat
                </h3>

                <!-- <div class="card-tools">
              <span title="3 New Messages" class="badge badge-primary">3</span>
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages" id="direct-chat-messages" style="margin-bottom: 10px;">

                  <!-- Message. Default to the left -->
                  <!-- <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Alexander Pierce</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                    </div>
                    <!-- direct-chat-infos --
                    <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                    <!-- /.direct-chat-img --
                    <div class="direct-chat-text">
                      Is this template really for free? That's unbelievable!
                    </div>
                    <!-- /.direct-chat-text --
                  </div> -->
                  <!-- /.direct-chat-msg -->

                  <!-- Message to the right -->
                  <!-- <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                    </div>
                    <!-- /.direct-chat-infos --
                    <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
                    <!-- /.direct-chat-img --
                    <div class="direct-chat-text">
                      You better believe it!
                    </div>
                    <!-- /.direct-chat-text --
                  </div> -->
                  <!-- /.direct-chat-msg -->
                </div>
                <!--/.direct-chat-messages-->

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <!-- <form action="#" method="post"> -->
                <div class="input-group">
                  <input type="text" id="txt-msg" placeholder="Type Message ..." class="form-control">
                  <span class="input-group-append">
                    <button type="button" id="send-btn" class="btn btn-primary">Send</button>
                  </span>
                </div>
                <!-- </form> -->
              </div>
              <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
          </div>

          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Chat Users</h3>
              </div>
              <div class="card-body">
                <div class="nearby-user" id="nearby-user">

                  <!-- <div class="row">
                    <div class="col-md-3 col-sm-2">
                      <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user" style="width: 55px;" class="img-circle">
                    </div>
                    <div class="col-md-7 col-sm-7">
                      <b><a href="#" class="profile-link" style="font-size: 18px; margin: 0; padding: 0;">Sophia Page</a></b>
                      <p style="font-size: 15px; margin: 0; padding: 0;"><i class="fas fa-circle text-success"></i> Online</p>
                      <p class="text-muted" style="font-size: 13px; margin: 0; padding: 0;">500m away</p>
                    </div>
                  </div>
                  <hr> -->

                </div>
              </div>
            </div>

          </div>

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
  include('frontend/footer.php');
} else {
  header('Location: ../index.php');
}
?>

<script>
  $(document).ready(function() {
    getChat();
    getUserStatus();
    ScrollDown();

    $(document).on('click', '#send-btn', function() {

      var msg = $('#txt-msg').val();
      if (msg != "" || msg != '') {
        $.ajax({
          type: "POST",
          url: "../admin/admin-control/chat.php",
          data: {
            send_msg: true,
            msg: msg,
          },
          success: function(response) {
            if (response == 200) {
              getChat();
              $('#txt-msg').val('');
            } else {
              message('danger', 'System Error, Contact Creator of this Site!')
            }
          }
        });
      }
    });

  });

  function getUserStatus() {
    $.ajax({
      type: "POST",
      url: "../admin/admin-control/online_status_user.php",
      data: {
        get_user_status_for_chat: true
      },
      success: function(response) {
        $('#nearby-user').html(response);
      }
    });
  }

  function getChat() {
    $.ajax({
      type: "POST",
      url: "../admin/admin-control/chat.php",
      data: {
        get_msgs: true
      },
      success: function(response) {
        // console.log($('#msg_view_count').val());
        $('#direct-chat-messages').html(response);
        sessionStorage.setItem("view_msg_count", $('#msg_count').val());
        ScrollDown();
      }
    });
  }

  function ScrollDown() {
    var elmnt = document.getElementById("direct-chat-messages");
    var h = elmnt.scrollHeight + 100;
    $('#direct-chat-messages').animate({
      scrollTop: h
    }, 1000);
  }

  function key(event) {
    // console.log(event.which);
    if (event.which == 13) {
      $('#send-btn').click();
    }
  }

  setInterval(function() {
    getUserStatus();
  }, 7000);

  setInterval(function() {
    getChat();
  }, 3000);
</script>