<?php require_once('../Connections/cnn_teamdnt.php'); ?><?php
// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make unified connection variable
$conn_cnn_teamdnt = new KT_connection($cnn_teamdnt, $database_cnn_teamdnt);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_cnn_teamdnt, "../");
//Grand Levels: Level
$restrict->addLevel("2");
$restrict->Execute();
//End Restrict Access To Page
?><ul class="menuside">
          <li><a href="list_project.php" target="_self"><i class="fa fa-suitcase" aria-hidden="true"></i>&nbsp;&nbsp;Project</a></li>
          <li><a href="list_hosting.php" target="_self"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;Hosting</a></li>
          <li><a href="list_emailhosting.php" target="_self"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Email Hosting</a></li>
          <li><a href="list_domain.php" target="_self"><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;&nbsp;Domain</a></li>
          <li><a href="list_domainaccount.php" target="_self"><i class="fa fa-ticket" aria-hidden="true"></i>&nbsp;&nbsp;Domain Account</a></li>
          <li><a href="list_server.php" target="_self"><i class="fa fa-database" aria-hidden="true"></i>&nbsp;&nbsp;Server</a></li><br><br>
          <li><a href="list_customer.php" target="_self"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;Customer</a></li>
          <li><a href="list_agency.php" target="_self"><i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;&nbsp;Agency</a></li>
          <li><a href="list_supplier.php" target="_self"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;Supplier</a></li><br><br>
          <li><a href="list_service.php" target="_self"><i class="fa fa-folder-open" aria-hidden="true"></i>&nbsp;&nbsp;Service</a></li>
          <li><a href="list_contact.php" target="_self"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;&nbsp;Contact</a></li>
          <li><a href="list_news.php" target="_self"><i class="fa fa-newspaper-o" aria-hidden="true"></i>&nbsp;&nbsp;News</a></li>
          <li><a href="list_newscategory.php" target="_self"><i class="fa fa-tags" aria-hidden="true"></i>&nbsp;&nbsp;News Category</a></li>
          <li><a href="list_account.php" target="_self"><i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;Account</a></li>
          <li><a href="list_copyright.php" target="_self"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;Copyright - Settings</a></li>  
</ul>