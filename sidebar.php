<!-- main menu content-->
	<div class="sidebar-content">
	  <div class="nav-container">
		<ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">

		   <li class=" nav-item"><a href="#"><i class="ft-bar-chart-2"></i><span data-i18n="" class="menu-title">Dashboard</span></a></li>

		  <li class="has-sub nav-item"><a href="#"><i class="ft-award"></i><span data-i18n="Clients" class="menu-title">Clients</span></a>
			<ul class="menu-content">
			  <li <?php if (strpos($_SERVER['REQUEST_URI'], "all-clients") !== false){ echo 'class="active"';} ?>><a href="all-clients" class="menu-item">All Clients</a></li>
			  <li><a href="#" class="menu-item">OQP List</a></li>
			  <li><a href="new-clients" class="menu-item">Add new client</a></li>
			</ul>
		  </li> 
		  <li class="has-sub nav-item"><a href="#"><i class="ft-clipboard"></i><span data-i18n="" class="menu-title">Policy</span></a>
			<ul class="menu-content">
			  <li <?php if (strpos($_SERVER['REQUEST_URI'], "all-policy") !== false){ echo 'class="active"';} ?>><a href="all-policy?branch=all&year=2018" class="menu-item">All Policy</a></li>
			  <li><a href="#" class="menu-item">Add new Policy</a></li>
			</ul>
		  </li> 
			<li class="has-sub nav-item"><a href="#"><i class="ft-file-text"></i><span data-i18n="" class="menu-title">Invoices</span></a>
			<ul class="menu-content">
			  <li><a href="#" class="menu-item">All Invoices</a>
			  </li>
			  <li><a href="#" class="menu-item">Add new insurer</a></li>
			</ul>
		  </li> 
			<li class="has-sub nav-item"><a href="#"><i class="ft-command"></i><span data-i18n="" class="menu-title">Biz Introducer</span></a>
			<ul class="menu-content">
			  <li><a href="#" class="menu-item">All BI</a>
			  </li>
			  <li><a href="#" class="menu-item">Add new BI</a></li>
			</ul>
		  </li> 
			<li class="has-sub nav-item"><a href="#"><i class="ft-briefcase"></i><span data-i18n="" class="menu-title">Insurers</span></a>
			<ul class="menu-content">
			  <li><a href="#" class="menu-item">All Insurers</a>
			  </li>
			  <li><a href="#" class="menu-item">Add new insurer</a></li>
			</ul>
		  </li> 
			<li class="has-sub nav-item"><a href="#"><i class="ft-users"></i><span data-i18n="" class="menu-title">Users</span></a>
			<ul class="menu-content">
			  <li <?php if (strpos($_SERVER['REQUEST_URI'], "all-users") !== false){ echo 'class="active"';} ?> ><a href="all-users" class="menu-item">All Users</a>
			  </li>
			  <li><a href="#" class="menu-item">Add new user</a></li>
			</ul>
		  </li> 
		</ul>
	  </div>
	</div>
	<!-- main menu content-->

	<!-- main menu footer-->
	<!-- include includes/menu-footer-->
	<!-- main menu footer-->
  </div>
  <!-- / main menu-->