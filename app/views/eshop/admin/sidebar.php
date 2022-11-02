<!-- **********************************************************************************************************************************************************
MAIN SIDEBAR MENU
*********************************************************************************************************************************************************** -->
<!--sidebar start-->
<?php
   $image = ROOT . 'uploads/default-user.jpg';
   if (file_exists($user_data->image)) //looking for if exist some file int the collumn image
   {
        $image = $user_data->image;
   }
?>
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
        
              <p class="centered"><a href="<?=ROOT?>admin/admin_profile"><img src="<?=ROOT.$image?>" class="img-circle" width="60"></a></p>
              <h5 class="centered"><?=$data['user_data']->name;?></h5>
              <h5 class="centered" style="font-size:11px;"><?=$data['user_data']->email;?></h5>

            <li class="sub-menu">
                <a <?=(isset($current_page) && $current_page == 'dashboard') ? ' class="active" ' : ''?> href="<?=ROOT?>admin" >
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sub-menu">
                <a <?=(isset($current_page) && $current_page == 'products') ? ' class="active" ' : ''?> href="<?=ROOT?>admin/products" >
                    <i class="fa fa-barcode fa-fw"></i>
                    <span>Products</span>
                </a>
            </li>

            <li class="sub-menu">
                <a <?=(isset($current_page) && $current_page == 'categories') ? ' class="active" ' : ''?> href="<?=ROOT?>admin/categories" >
                    <i class="fa fa-list-alt fa-fw"></i>
                    <span>Categories</span>
                </a>
            </li>

            <li class="sub-menu">
                <a <?=(isset($current_page) && $current_page == 'orders') ? ' class="active" ' : ''?> href="<?=ROOT?>admin/orders" >
                    <i class="fa fa-reorder"></i>
                    <span>Orders</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='badge'><?=count($count_order)?></span>
                </a>
            </li>

            <li class="sub-menu">
                <a <?=(isset($current_page) && $current_page == 'messages') ? ' class="active" ' : ''?> href="<?=ROOT?>admin/messages" >
                    <i class="fa fa-comment"></i>
                    <span>Messages</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='badge bg-info'><?=count($count_message)?></span>
                </a>
            </li>

            <li class="sub-menu">
                <a <?=(isset($current_page) && $current_page == 'blogs') ? ' class="active" ' : ''?> href="<?=ROOT?>admin/blogs" >
                    <i class="fa fa-bullhorn"></i>
                    <span>Blog Posts</span>
                </a>
            </li>

            <li class="sub-menu">
                <a <?=(isset($current_page) && $current_page == 'settings') ? ' class="active" ' : ''?> href="<?=ROOT?>admin/settings" >
                    <i class="fa fa-cogs"></i>
                    <span>Settings</span>
                </a>
                <ul class="sub">
                    <li><a  href="<?=ROOT?>admin/settings/slider_images">Slider Images</a></li>
                </ul>
                 <ul class="sub">
                    <li><a  href="<?=ROOT?>admin/settings/socials">Social Links / Contacts</a></li>
                </ul>
                

            </li>

            <li class="sub-menu">
                <a <?=(isset($current_page) && $current_page == 'users') ? ' class="active" ' : ''?> href="">
                    <i class="fa fa-user"></i>
                    <span>Users</span>
                </a>
                <ul class="sub">
                    <li><a  href="<?=ROOT?>admin/users/customers">Customers</a></li>
                    <li><a  href="<?=ROOT?>admin/users/admins">Admins</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="<?=ROOT?>admin/admin_profile" >
                    <i class="fa fa-desktop"></i>
                    <span>Profile</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="<?=ROOT?>admin/backups" >
                    <i class="fa fa-hdd-o"></i>
                    <span>Website Backup</span>
                </a>
            </li>


        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->

<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i><?=ucwords($data['page_title'])?></h3>
    <div class="row mt">
      <div class="col-lg-12">
