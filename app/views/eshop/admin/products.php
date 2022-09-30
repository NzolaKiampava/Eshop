<?php $this->view("admin/header", $data); ?>
  
<?php $this->view("admin/sidebar", $data); ?>

  <style type="text/css">
    
    .add_edit_panel{

      width: 500px;
      height: 700px;
      background-color: #eae8e8;
      box-shadow: 0px 0px 10px #aaa;
      position: absolute;
      padding: 6px;
      z-index: 10;
    }

    .show{
      display: block;
    } 

    .hide{
      display: none;
    }

    .edit_product_img{
      display: flex;
      width: 90%;
      position: relative;
      margin: 0 30px;
    }
    .edit_product_img img{
      flex: 1;
      width: 10px;
      margin: 2px;
    }

    
  </style>

  <div class="row mt">
      <div class="col-md-12">
          <div class="content-panel table-responsive">
            <h4><i class="fa fa-angle-right"></i> Advanced Search</h4>
            <!-- Searchbox -->
            <style>
              .my-table {
                background-color: #eceee0;
              }
            </style>
            <form class="form-horizontal style-form" method="get">
              <table class="my-table table table-striped table-advance">
                  <tr>
                    <th>Description</th>
                    <td><input value="<?=Search::get_sticky('textbox','description')?>" autofocus="true" type="text" name="description" class="form-control" placeholder="Type what to search for"></td>

                    <th>Category</th>
                    <td>
                      <select class="form-control" name="category">
                        <option>--Select Category--</option>
                        <?=Search::get_categories('category')?>
                      </select>
                    </td>
                  </tr>
                  
                  
                  <tr>
                    <th>Brand</th>
                    <td colspan="3">
                      <?=Search::get_brands()?>
                    </td>
                  </tr>
                  
                  <tr>
                    <th>Price</th>
                    <td>
                      <div class="form-inline">
                        <label>Min</label>
                        <input value="<?=Search::get_sticky('number','min-price')?>" class="form-control" type="number" size="12" min="0" step="0.01" name="min-price">
                        <label>Max</label>
                        <input value="<?=Search::get_sticky('number','max-price')?>" class="form-control" type="number" size="12" min="0" step="0.01" name="max-price">
                      </div>
                    </td>

                    <th>Quantity</th>
                    <td>
                      <div class="form-inline">
                        <label>Min</label>
                        <input class="form-control" type="number" value="<?=Search::get_sticky('number','min-qty')?>" size="12" min="0" step="1" name="min-qty">
                        <label>Max</label>
                        <input class="form-control" type="number" value="<?=Search::get_sticky('number','max-qty')?>" size="12" min="0" step="1" name="max-qty">
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <th>Year</th>
                    <td>
                      <select class="form-control" name="year">
                        <option>--Select Year--</option>
                        <?=Search::get_years('year')?>
                      </select>
                    </td>
                  </tr>
                  <tr><td colspan="4"><input type="submit" value="Search" class="btn btn-success pull-right" name="search"></td></tr>
              </table>
            </form>
            <!-- endSearchbox -->

              <table class="table table-striped table-advance table-hover">
                <h4><i class="fa fa-angle-right"></i> Products <button class="btn btn-primary btn-xs" onclick="show_add_new(event)"  data-toggle="modal" data-target="#addproduct"><i class="fa fa-plus"></i> Add New</button></h4>

                <!-- Add New Product -->
                <div class="add_new add_edit_panel hide">
                  <div class="row">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Add New Product</h4>
                    <div class="form-group">
                      <form class="form-horizontal style-form" method="post">
                        <label class="ol-sm-2 col-sm-2 control-label">Product Name:</label>
                        <div class="col-sm-10">
                            <input id="description" name="description" type="text" class="form-control" autofocus>
                        </div>

                        <br><br><br style="clear: both;">                       
                        <label class="col-sm-2 col-sm-2 control-label">Quantity:</label>
                        <div class="col-sm-10">
                            <input id="quantity" name="quantity" type="number" min="1" value="1" class="form-control" required>
                        </div>

                        <br><br><br style="clear: both;">                       
                        <label class="col-sm-2 col-sm-2 control-label">Category:</label>
                        <div class="col-sm-10">
                          <select id="category" name="category" class="form-control" required>
                            <option></option>
                            <?php if(is_array($categories)): ?>
                              <?php foreach ($categories as $categ): ?>
                                <option value="<?=$categ->id?>"><?=$categ->category?></option>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        

                        <br><br><br style="clear: both;">                       
                        <label class="col-sm-2 col-sm-2 control-label">Brand:</label>
                        <div class="col-sm-10">
                          <select id="brand" name="brand" class="form-control" required>
                            <option></option>
                            <?php if(is_array($brands)): ?>
                              <?php foreach ($brands as $brand): ?>
                                <option value="<?=$brand->id?>"><?=$brand->brand?></option>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        

                        <br><br><br style="clear: both;">                       
                        <label class="col-sm-2 col-sm-2 control-label">Price:</label>
                        <div class="col-sm-10">
                            <input id="price" name="price" type="number" placeholder="0.00" min="0.01" step="0.01" class="form-control" required>
                        </div>
                        
                        <br><br><br style="clear: both;">                       
                        <label class="col-sm-2 col-sm-2 control-label">Image:</label>
                        <div class="col-sm-10">
                            <input id="image" name="image" type="file" onchange="display_image(this.files[0],this.name,'js-product-images-add')" class="form-control" required>
                        </div>

                        <br><br><br style="clear: both;">                       
                        <label class="col-sm-2 col-sm-2 control-label">Image2 (optional):</label>
                        <div class="col-sm-10">
                            <input id="image2" name="image2" type="file" onchange="display_image(this.files[0],this.name,'js-product-images-add')" class="form-control">
                        </div>

                        <br><br><br style="clear: both;">                       
                        <label class="col-sm-2 col-sm-2 control-label">Image3 (optional):</label>
                        <div class="col-sm-10">
                            <input id="image3" name="image3" type="file" onchange="display_image(this.files[0],this.name,'js-product-images-add')" class="form-control">
                        </div>

                        <br><br><br style="clear: both;">                       
                        <label class="col-sm-2 col-sm-2 control-label">Image4 (optional):</label>
                        <div class="col-sm-10">
                            <input id="image4" name="image4" type="file" onchange="display_image(this.files[0],this.name,'js-product-images-add')" class="form-control">
                        </div>

                        <div class="js-product-images-add edit_product_img">
                          <img src="">
                          <img src="">
                          <img src="">
                          <img src="">
                        </div>
                        

                        <button type="button" class="btn btn-warning" onclick="show_add_new(event)" style="position: absolute;bottom: 10px;left: 10px;">Close</button>
                        <button type="button" class="btn btn-primary" onclick="collect_data(event)" style="position: absolute;bottom: 10px;right: 10px;">Save</button>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Add New product end-->     

                <!-- Edit Product -->
                <div class="edit_product add_edit_panel hide">
                  <div class="row">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Edit Product</h4>
                    <div class="form-group">
                      <form class="form-horizontal style-form" method="post">
                        <label class="ol-sm-2 col-sm-2 control-label">Product Name:</label>
                        <div class="col-sm-10">
                            <input id="edit_description" name="description" type="text" class="form-control" autofocus>
                        </div>

                        <br><br><br style="clear: both;">                       
                        <label class="col-sm-2 col-sm-2 control-label">Quantity:</label>
                        <div class="col-sm-10">
                            <input id="edit_quantity" name="quantity" min="1" type="number" value="1" class="form-control" required>
                        </div>

                        <br><br><br style="clear: both;">                       
                        <label class="col-sm-2 col-sm-2 control-label">Category:</label>
                        <div class="col-sm-10">
                          <select id="edit_category" name="category" class="form-control" required>
                            <option></option>
                            <?php if(is_array($categories)): ?>
                              <?php foreach ($categories as $categ): ?>
                                <option value="<?=$categ->id?>"><?=$categ->category?></option>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>

                        
                        <br><br><br style="clear: both;">   
                        <label class="col-sm-2 col-sm-2 control-label">Brand:</label>
                        <div class="col-sm-10">
                          <select id="edit_brand" name="brand" class="form-control" required>
                            <option></option>
                            <?php if(is_array($brands)): ?>
                              <?php foreach ($brands as $brand): ?>
                                <option value="<?=$brand->id?>"><?=$brand->brand?></option>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        

                        <br><br><br style="clear: both;">                       
                        <label class="col-sm-2 col-sm-2 control-label">Price:</label>
                        <div class="col-sm-10">
                            <input id="edit_price" name="price" type="number" placeholder="0.00" min="0.01" step="0.01" class="form-control" required>
                        </div>
                        
                        <br><br><br style="clear: both;">                       
                        <label class="col-sm-2 col-sm-2 control-label">Image:</label>
                        <div class="col-sm-10">
                            <input id="edit_image" name="image" type="file" onchange="display_image(this.files[0],this.name,'js-product-images-edit')" class="form-control" required>
                        </div>

                        <br><br><br style="clear: both;">                       
                        <label class="col-sm-2 col-sm-2 control-label">Image2 (optional):</label>
                        <div class="col-sm-10">
                            <input id="edit_image2" name="image2" type="file" onchange="display_image(this.files[0],this.name,'js-product-images-edit')" class="form-control">
                        </div>

                        <br><br><br style="clear: both;">                       
                        <label class="col-sm-2 col-sm-2 control-label">Image3 (optional):</label>
                        <div class="col-sm-10">
                            <input id="edit_image3" name="image3" type="file" onchange="display_image(this.files[0],this.name,'js-product-images-edit')" class="form-control">
                        </div>

                        <br><br><br style="clear: both;">                       
                        <label class="col-sm-2 col-sm-2 control-label">Image4 (optional):</label>
                        <div class="col-sm-10">
                            <input id="edit_image4" name="image4" type="file" onchange="display_image(this.files[0],this.name,'js-product-images-edit')" class="form-control">
                        </div>
                        <br>

                        <div class="js-product-images-edit edit_product_img">
                          
                        </div>

                        <button type="button" class="btn btn-warning" onclick="show_edit_product(0,'',false)" style="position: absolute;bottom: 10px;left: 10px;">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="collect_edit_data(event)" style="position: absolute;bottom: 10px;right: 10px;">Save</button>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Edit Product end-->

                <hr>
                  <thead>
                  <tr>
                      <th>Product id</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Price</th>
                      <th>Date</th>
                      <th>Image</th>
                      <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="table_body">

                  <?= $tbl_rows ?>

                  <tr><td colspan="8"><?php Page::show_links()?></td></tr>
                  </tbody>
              </table>
          </div><!-- /content-panel -->
      </div><!-- /col-md-12 -->
  </div><!-- /row -->

<script type="text/javascript">

  var EDIT_ID = 0;

  function show_add_new(){
    
    var show_add_box = document.querySelector(".add_new");
    var product_input = document.querySelector("#description");

    if(show_add_box.classList.contains("hide")){
        show_add_box.classList.remove("hide");
        product_input.focus();
    }else{
        show_add_box.classList.add("hide");
        product_input.value = "";
    }
  }

  function show_edit_product(id,product,e){
    
    var show_edit_box = document.querySelector(".edit_product");
    if(e){
      var a = e.currentTarget.getAttribute("info");
      var info = JSON.parse(a.replaceAll("'",'"'));
      
      //console.log($info)
      EDIT_ID = info.id;

      //show_edit_box.style.left = (e.clientX - 600) + "px";
      //show_edit_box.style.top = (e.clientY - 100) + "px";

      var edit_description_input = document.querySelector("#edit_description");
      edit_description.value = info.description;

      var edit_quantity_input = document.querySelector("#edit_quantity");
      edit_quantity.value = info.quantity;

      var edit_category_input = document.querySelector("#edit_category");
      edit_category.value = info.category;

      var edit_brand_input = document.querySelector("#edit_brand");
      edit_brand.value = info.brand;
      

      var edit_price_input = document.querySelector("#edit_price");
      edit_price.value = info.price;

      var product_images_input = document.querySelector(".js-product-images-edit");
      product_images_input.innerHTML = `<img src="<?=ROOT?>${info.image}" />`;
      product_images_input.innerHTML += `<img src="<?=ROOT?>${info.image2}" />`;
      product_images_input.innerHTML += `<img src="<?=ROOT?>${info.image3}" />`;
      product_images_input.innerHTML += `<img src="<?=ROOT?>${info.image4}" />`;
    }  

    if(show_edit_box.classList.contains("hide")){
        show_edit_box.classList.remove("hide");
        edit_description.focus();
    }else{
        show_edit_box.classList.add("hide");
        edit_description.value = "";
    }
  }

  function collect_data(e)
  {
    var product_input = document.querySelector("#description");
    if (product_input.value.trim() == "" || !isNaN(product_input.value.trim())) 
    {
        alert("Please enter a valid product name");
        return;
    }

    var quantity_input = document.querySelector("#quantity");
    if (quantity_input.value.trim() == "" || isNaN(quantity_input.value.trim())) 
    {
        alert("Please enter a valid quantity");
        return;
    }

    var category_input = document.querySelector("#category");
    if (category_input.value.trim() == "" || isNaN(category_input.value.trim())) 
    {
        alert("Please enter a valid category");
        return;
    }



    var brand_input = document.querySelector("#brand");
    if (brand_input.value.trim() == "" || isNaN(brand_input.value.trim())) 
    {
        alert("Please enter a valid brand");
        return;
    }

    var price_input = document.querySelector("#price");
    if (price_input.value.trim() == "" || isNaN(price_input.value.trim())) 
    {
        alert("Please enter a valid price");
        return;
    }

    var image_input = document.querySelector("#image");
    if (image_input.files.length == 0) 
    {
        alert("Please enter a valid main image");
        return;
    }

//create a form
    var data = new FormData();

    var image2_input = document.querySelector("#image2");
    if (image2_input.files.length > 0) 
    {
        data.append('image2',image2_input.files[0]);
    }

    var image3_input = document.querySelector("#image3");
    if (image3_input.files.length > 0) 
    {
        data.append('image3',image3_input.files[0]);
    }

    var image4_input = document.querySelector("#image4");
    if (image4_input.files.length > 0) 
    {
        data.append('image4',image4_input.files[0]);
    }


    data.append('description',product_input.value.trim());
    data.append('quantity',quantity_input.value.trim());
    data.append('category',category_input.value.trim());
    data.append('brand',brand_input.value.trim());
    data.append(' price',price_input.value.trim());
    data.append('data_type','add_product');
    data.append('image',image_input.files[0]);

    send_data_files(data);

  }
  function collect_edit_data(e)
  {
    var product_input = document.querySelector("#edit_description");
    if (product_input.value.trim() == "" || !isNaN(product_input.value.trim())) 
    {
        alert("Please enter a valid product name");
        return;
    }

    var quantity_input = document.querySelector("#edit_quantity");
    if (quantity_input.value.trim() == "" || isNaN(quantity_input.value.trim())) 
    {
        alert("Please enter a valid quantity");
        return;
    }

    var category_input = document.querySelector("#edit_category");
    if (category_input.value.trim() == "" || isNaN(category_input.value.trim())) 
    {
        alert("Please enter a valid category");
        return;
    }

    var brand_input = document.querySelector("#edit_brand");
    /*if (brand_input.value.trim() == "" || isNaN(brand_input.value.trim())) 
    {
        alert("Please enter a valid brand");
        return;
    }*/

    var price_input = document.querySelector("#edit_price");
    if (price_input.value.trim() == "" || isNaN(price_input.value.trim())) 
    {
        alert("Please enter a valid price");
        return;
    }

//create a form
    var data = new FormData();

    var image_input = document.querySelector("#edit_image");
    if (image_input.files.length > 0) 
    {
        data.append('image',image_input.files[0]);
    }

    var image2_input = document.querySelector("#edit_image2");
    if (image2_input.files.length > 0) 
    {
        data.append('image2',image2_input.files[0]);
    }

    var image3_input = document.querySelector("#edit_image3");
    if (image3_input.files.length > 0) 
    {
        data.append('image3',image3_input.files[0]);
    }

    var image4_input = document.querySelector("#edit_image4");
    if (image4_input.files.length > 0) 
    {
        data.append('image4',image4_input.files[0]);
    }


    data.append('description',product_input.value.trim());
    data.append('quantity',quantity_input.value.trim());
    data.append('category',category_input.value.trim());
    data.append('brand',brand_input.value.trim());
    data.append(' price',price_input.value.trim());
    data.append('data_type','edit_product');
    data.append('id',EDIT_ID);

    send_data_files(data);
  }

  function send_data(data = {})
  {
    var ajax = new XMLHttpRequest();

    ajax.addEventListener('readystatechange', function(){

        if(ajax.readyState == 4 && ajax.status == 200)
        {
            handle_result(ajax.responseText);
        }
    });

    ajax.open("POST","<?=ROOT?>ajax_product",true);
    ajax.send(JSON.stringify(data));
  }

  function send_data_files(formdata)
  {
    var ajax = new XMLHttpRequest();

    ajax.addEventListener('readystatechange', function(){

        if(ajax.readyState == 4 && ajax.status == 200)
        {
            handle_result(ajax.responseText);
        }
    });

    ajax.open("POST","<?=ROOT?>ajax_product",true);
    ajax.send(formdata);
  }


  function handle_result(result)
  {   
    console.log(result);
    alert(result);
    if(result != "")
    {
      var obj = JSON.parse(result);                           //converting to object

      //verifying if message_type exists
      if(typeof obj.data_type != 'undefined')
      {   
        if(obj.data_type == "add_new")
        {
          if(obj.message_type == "info")
          {
            alert(obj.message);
            show_add_new();

            var table_body = document.querySelector("#table_body");
            table_body.innerHTML = obj.data;
              
          }else 
          {
            alert(obj.message);
          }
        }else
        if(obj.data_type == "edit_product")
        {
          show_edit_product(0,'',false);

          var table_body = document.querySelector("#table_body");
          table_body.innerHTML = obj.data;
          alert(obj.message);

        }else
        if(obj.data_type == "disable_row")
        {
          var table_body = document.querySelector("#table_body");
          table_body.innerHTML = obj.data;

        }else
        if(obj.data_type == "delete_row")
        {

          var table_body = document.querySelector("#table_body");
          table_body.innerHTML = obj.data;
          alert(obj.message);
        }
      }
    }  
  }

  function display_image(file,name,element)
  {
    var index = 0;
    if (name == "image2"){
        index = 1;
    }else
    if(name == "image3"){
        index = 2;
    }else
    if(name == "image4"){
        index = 3;
    }

    var image_holder = document.querySelector("."+element);
    var images = image_holder.querySelectorAll("IMG");     //getting the tag img

    images[index].src = URL.createObjectURL(file);

  }

  function delete_row(id)
  {
    if(!confirm("Are you sure you want to delete this row?"))
    {
      return;
    }

    send_data({
      data_type:"delete_row",
      id:id
    });
  }

  function disable_row(id,state)
  {
    send_data({
      data_type:"disable_row",
      id:id,
      current_state:state
    });
  }

</script>
<?php $this->view("admin/footer", $data); ?>
