<?php
include 'config.php';
?>
<div class="container">
  <div>
    <!-- Form Ubah Produk -->
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Product</h4>
        <form method="post" action="ubahdata.php" enctype="multipart/form-data">
          <div class="form_group">
            <label for="id">ID</label>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
          </div>
          <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $row->product_name; ?>" required>
          </div>
          <div class="form-group">
            <label for="product_code">Product Code</label>
            <input type="text" class="form-control" id="product_code" name="product_code" value="<?php echo $row->product_code; ?>" required>
          </div>
          <div class="form-group">
            <label for="product_desc">Description</label>
            <textarea class="form-control" id="product_desc" name="product_desc" rows="3" required><?php echo $row->product_desc; ?></textarea>
          </div>
          <div class="form-group">
            <label for="product_img_name">Product Image</label>
            <input type="file" class="form-control-file" id="product_img_name" name="product_img_name" accept="image/*" readonly>
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo $row->price; ?>" required>
          </div>
          <div class="form-group">
            <label for="qty">Units Available</label>
            <input type="number" class="form-control" id="qty" name="qty" value="<?php echo $row->qty; ?>" required>
          </div>
          <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
      </div>
    </div>
  </div>
</div>