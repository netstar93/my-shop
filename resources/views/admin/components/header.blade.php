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
@if(session('success'))
    <div class="page-message alert alert-success">{{session('success')}}</div>
@endif
@if(session('error'))
    <div class="page-message alert alert-warning">{{session('error')}}</div>
@endif