
   <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <a class="navbar-brand pt-0" href="../index.html">
        <img src="../assets/img/brand/logo_blue.png" class="navbar-brand-img" alt="...">
      </a>
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
     
  
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.html">
                <img src="../../assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="fas fa-tv text-primary"></i> Dashboard
            </a>
          </li>
          <?php if($user_role_id == 3){?>
          <li class="nav-item">
            <a class="nav-link" href="test.php">
              <i class="ni ni-planet text-blue"></i>Test
            </a>
          </li>
 <?php
}
			?>
        <li class="nav-item">
           <?php
			if($user_role_id==3){
			?>
            <a class="nav-link" href="graphsForTeacher.php"><i class="fas fa-chart-pie text-primary"></i> Graphs</a>
             <?php
			}else if($user_role_id==5){
			?>
			<a class="nav-link" href="graphsForStudent.php"><i class="fas fa-chart-pie text-primary"></i> Graphs
				</a>
			<?php
			}
				?>
              
            
          </li>
                 <li class="nav-item">
           <?php
			if($user_role_id==3){
			?>
            <a class="nav-link" href="resultsForTeacher.php"><i class="fas fa-file-alt text-primary"></i> Results</a>
             <?php
			}else if($user_role_id==5){
			?>
			<a class="nav-link" href="resultsForStudent.php"><i class="fas fa-file-alt text-primary"></i> Results
				</a>
			<?php
			}
				?>
              
            
          </li>
        </ul>
         
        <!-- Divider -->
        <hr class="my-3">
      
      </	div>
    </div>
  </nav>
  