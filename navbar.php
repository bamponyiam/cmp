<div class="navbar-container">
<div id="navbarSupportedContent" class="collapse navbar-collapse">
  <ul class="navbar-nav">

	<li class="dropdown nav-item"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle">Hi! <strong> <?php echo $_SESSION['user']; ?></strong> <i class="ft-user font-medium-3 blue-grey darken-4"></i>
	<p class="d-none">User Settings</p></a>
	  <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu dropdown-menu-right"><a href="setting-user" class="dropdown-item py-1"><i class="ft-settings mr-2"></i><span>Settings</span></a>
		<div class="dropdown-divider"></div><a href="sign-out" class="dropdown-item"><i class="ft-power mr-2"></i><span>Logout</span></a>
	  </div>
	</li>

  </ul>
</div>
</div>