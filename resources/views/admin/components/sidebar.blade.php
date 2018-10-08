<div class="left-side" style="width:200px">
<section class="left-section">
	<div class= "content" id="accordion">
        <ul class="horizontal-list icons">
            <li><a href="#"><i class="material-icons text-info fsize" title="Advanced tables">view_module</i></a></li>
            <li><a href="#"><i class="material-icons text-danger fsize" title="Advanced tables">view_list</i></a></li>
            <li><a href="#"><i class="material-icons text-success fsize" title="Advanced tables">photo_library</i></a></li>
            <li><a href="#"><i class="material-icons text-warning fsize" title="Advanced tables">group</i></a></li>
        </ul>
            <div class="card">
                <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#collapseOne">
                        <i class="material-icons text-success leftsize">shopping_basket</i> Catalog
                    </a>
                </div>
                <div id="collapseOne" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <ul>
                            <li><a href="/admin/product/index">Manage Products</a> </li>
                            <li><a href="/admin/category/index">Manage Category</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                        <i class="material-icons text-primary leftsize">home</i> Order
                    </a>
                </div>
                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <ul>
                            <li><a href="/admin/product/index">Manage Products</a> </li>
                            <li><a href="admin/product/index">Manage Category</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                        <i class="material-icons text-warning fsize" title="Advanced tables">group</i> Brands
                    </a>
                </div>
                <div id="collapseThree" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <ul>
                            <li><a href="admin/product/index">Manage Products</a> </li>
                            <li><a href="admin/product/index">Manage Category</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
                    <i class="material-icons text-warning fsize" title="Advanced tables">group</i> Attribute
                </a>
            </div>
            <div id="collapseFour" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    <ul>
                        <li><a href="/admin/attribute/index">Manage Attributes</a> </li>
                        <li><a href="/admin/attributeset/index">Manage Attribute Sets</a> </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card">
                <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#collapseFive">
                        <i class="material-icons text-success leftsize">shopping_basket</i> Home Manager
                    </a>
                </div>
                <div id="collapseFive" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <ul>
                            <li><a href="/admin/home/banner">Manage Banners</a> </li>
                            <li><a href="/admin/category/index">Manage Others</a> </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
</section>
</div>

<style>
    .card{
        background-color: unset;
    }
</style>