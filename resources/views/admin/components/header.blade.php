<header>
	<nav class="navbar navbar-default navbar-expand-lg">
		<div class="container-fluid">
			<div class="navbar-header">
		      <a class="navbar-brand" href="#">WebSiteName</a>
		    </div>
		    <div class="navbar-right">
		    	<ul class="nav navbar-nav">
					<li>
						<div class="dropdown">
						    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Messages
						    <span class="badge"></span></a>
						    <ul class="dropdown-menu">
						      <li><a href="#">HTML</a></li>
						      <li><a href="#">CSS</a></li>
						      <li><a href="#">JavaScript</a></li>
						    </ul>
						</div>
					</li>
					
				</ul>
			</div>
		</div>
	</nav>
</header>

<div class = "messages">
@if(session('success'))
    <div class="page-message alert alert-success alert-dismissable text-center"><i class="fa fa-check-square-o" style="font-size: 25px;"></i> {{session('success')}}</div>
@endif
@if(session('error'))
    <div class="page-message alert alert-warning alert-dismissable text-center"><i class="fa fa-close" style="color:red;font-size: 25px;"></i>{{session('error')}}</div>
@endif
</div>