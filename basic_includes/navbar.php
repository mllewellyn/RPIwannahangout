<?php
  
  if (isset($_SESSION['uid'])) {
    //get user from uid
    $q = new UserQuery();
    $user = $q->findPk($_SESSION['uid']);
  }
?>

<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <!-- these three spans are decoration for the expand button -->
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/index.php">RPIWannaHangOut</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/explore.php">Explore</a></li>
        <?php if (isset($_SESSION['uid']) && $_SESSION['uid'] != '') { ?>
          <li id="createLink"><a href="/events/create.php">Create Event</a></li>
          <li id="myEventsLink"><a href="/my_events.php">My Events</a></li>
        <?php } else { ?>
          <li id="createLink"><a href="/login.php">Create Event</a></li>
          <li id="myEventsLink"><a href="/login.php">My Events</a></li>
        <?php } ?>

        <li id="findLink"><a href="/events/list.php">Find Event</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <?php if (isset($_SESSION['uid']) && $_SESSION['uid'] != '') { ?>
          <p class="navbar-text">Welcome, <?php echo $user->getFirstName(); ?></p>
          <li><a href="/logout.php">Log Out</a></li>
        <?php } else { ?>
        <li><a href="/login.php">Log In</a></li>
        <?php } ?> 
      </ul>  
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
